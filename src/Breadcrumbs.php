<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_key_exists;
use function array_merge;
use function is_array;
use function strtr;

/**
 * The Bulma breadcrumb is a simple navigation component.
 *
 * ```php
 * echo Breadcrumbs::widget()->items([
 *     ['label' => 'Info'],
 *     ['label' => 'Contacts'],
 * ]);
 * ```
 *
 * @link https://bulma.io/documentation/components/breadcrumb/
 */
class Breadcrumbs extends Widget
{
    private bool $encodeLabels = true;
    private bool $encodeTags = false;
    private array $homeItem = [];
    private bool $withoutHomeItem = false;
    private string $itemTemplate = "<li>{icon}{link}</li>\n";
    private string $activeItemTemplate = "<li class=\"is-active\"><a aria-current=\"page\">{icon}{label}</li>\n";
    private array $items = [];
    private array $options = [];
    private array $itemsOptions = [];

    protected function run(): string
    {
        if (empty($this->items)) {
            return '';
        }

        $this->buildOptions();

        return
            Html::beginTag('nav', $this->options) . "\n" .
                Html::beginTag('ul', $this->itemsOptions) . "\n" .
                    implode('', $this->renderItems()) .
                Html::endTag('ul') . "\n" .
            Html::endTag('nav');
    }

    /**
     * When tags Labels HTML should not be encoded.
     *
     * @return $this
     */
    public function withoutEncodeLabels(): self
    {
        $new = clone $this;
        $new->encodeLabels = false;
        return $new;
    }

    /**
     * Do not render home item.
     *
     * @return self
     */
    public function withoutHomeItem(): self
    {
        $new = clone $this;
        $new->withoutHomeItem = true;
        return $new;
    }

    /**
     * The first item in the breadcrumbs (called home link).
     *
     * Please refer to {@see $items} on the format.
     *
     * @param array $value
     *
     * @return self
     */
    public function withHomeItem(array $value): self
    {
        $new = clone $this;
        $new->homeItem = $value;
        return $new;
    }

    /**
     * The template used to render each inactive item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each inactive item.
     *
     * @param string $value
     *
     * @return self
     */
    public function withItemTemplate(string $value): self
    {
        $new = clone $this;
        $new->itemTemplate = $value;
        return $new;
    }

    /**
     * The template used to render each active item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each active item.
     *
     * @param string $value
     *
     * @return self
     */
    public function withActiveItemTemplate(string $value): self
    {
        $new = clone $this;
        $new->activeItemTemplate = $value;
        return $new;
    }

    /**
     * List of items to appear in the breadcrumb. If this property is empty, the widget will not render anything. Each
     * array element represents a single link in the breadcrumb with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     * @param array $value
     *
     * @return self
     */
    public function withItems(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * The HTML attributes for the widget container nav tag.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function withOptions(array $value): self
    {
        $new = clone $this;
        $new->options = $value;
        return $new;
    }

    /**
     * The HTML attributes for the items widget.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function withItemsOptions(array $value): self
    {
        $new = clone $this;
        $new->itemsOptions = $value;
        return $new;
    }

    /**
     * Allows you to enable the encoding tags html.
     *
     * @return self
     */
    public function withEncodeTags(): self
    {
        $new = clone $this;
        $new->encodeTags = true;

        return $new;
    }

    private function buildOptions(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-breadcrumbs";
        }

        $this->options = $this->addOptions(
            array_merge(
                $this->options,
                ['aria-label' => 'breadcrumbs']
            ),
            'breadcrumb'
        );
    }

    private function renderIcon(string $icon, array $iconOptions): string
    {
        $html = '';

        if ($icon !== '') {
            $html = Html::beginTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon]) .
                Html::endTag('span');
        }

        return $html;
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the
     * link.
     *
     * @throws InvalidArgumentException|JsonException if `$link` does not have "label" element.
     *
     * @return string the rendering result
     */
    private function renderItem(array $link, string $template): string
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);

        $icon = '';
        $iconOptions = [];

        if (isset($link['icon'])) {
            $icon = $link['icon'];
        }

        if (isset($link['iconOptions']) && is_array($link['iconOptions'])) {
            $iconOptions = $this->addOptions($iconOptions, 'icon');
        }

        unset($link['icon'], $link['iconOptions']);

        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidArgumentException('The "label" element is required for each link.');
        }

        if (isset($link['template'])) {
            $template = $link['template'];
        }

        if ($this->encodeTags === false) {
            $link['encode'] = false;
        }

        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url'], $options['icon']);
            $linkHtml = Html::a($label, $link['url'], $options);
        } else {
            $linkHtml = $label;
        }

        return strtr(
            $template,
            ['{label}' => $label, '{link}' => $linkHtml, '{icon}' => $this->renderIcon($icon, $iconOptions)]
        );
    }

    private function renderItems(): array
    {
        $links = [];

        if ($this->withoutHomeItem === false) {
            $links[] = $this->renderHomeLink();
        }

        foreach ($this->items as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }

            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }

        return $links;
    }

    private function renderHomeLink(): string
    {
        if ($this->homeItem === []) {
            $this->homeItem = ['label' => 'Home', 'url' => '/'];
        }

        return $this->renderItem($this->homeItem, $this->itemTemplate);
    }
}
