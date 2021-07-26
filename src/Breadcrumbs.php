<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_key_exists;
use function array_merge;
use function implode;
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
final class Breadcrumbs extends Widget
{
    private bool $encodeLabels = true;
    private ?array $homeItem = ['label' => 'Home', 'url' => '/'];
    private string $itemTemplate = "<li>{icon}{link}</li>\n";
    private string $activeItemTemplate = "<li class=\"is-active\"><a aria-current=\"page\">{icon}{label}</a></li>\n";
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
            Html::openTag('nav', $this->options) . "\n" .
                Html::openTag('ul', $this->itemsOptions) . "\n" .
                    implode('', $this->renderItems()) .
                Html::closeTag('ul') . "\n" .
            Html::closeTag('nav');
    }

    /**
     * Disables encoding for labels and returns a new instance.
     *
     * @return self
     */
    public function withoutEncodeLabels(): self
    {
        $new = clone $this;
        $new->encodeLabels = false;
        return $new;
    }

    /**
     * Returns a new instance with the specified first item in the breadcrumbs (called home link).
     *
     * If a null is specified, the home item will not be rendered.
     *
     * @param array|null $value Please refer to {@see items()} on the format.
     *
     * @throws InvalidArgumentException If an empty array is specified.
     *
     * @return self
     */
    public function homeItem(?array $value): self
    {
        if ($value === []) {
            throw new InvalidArgumentException(
                'The home item cannot be an empty array. To disable rendering of the home item, specify null.',
            );
        }

        $new = clone $this;
        $new->homeItem = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified item template.
     *
     * @param string $value The template used to render each inactive item in the breadcrumbs.
     * The token `{link}` will be replaced with the actual HTML link for each inactive item.
     *
     * @return self
     */
    public function itemTemplate(string $value): self
    {
        $new = clone $this;
        $new->itemTemplate = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified active item template.
     *
     * @param string $value The template used to render each active item in the breadcrumbs.
     * The token `{link}` will be replaced with the actual HTML link for each active item.
     *
     * @return self
     */
    public function activeItemTemplate(string $value): self
    {
        $new = clone $this;
        $new->activeItemTemplate = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified list of items.
     *
     * @param array $value List of items to appear in the breadcrumbs. If this property is empty, the widget will not
     * render anything. Each array element represents a single item in the breadcrumbs with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     * @return self
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options.
     *
     * @param array $value The HTML attributes for the widget container nav tag.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified item template.
     *
     * @param array $value The HTML attributes for the items widget.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function itemsOptions(array $value): self
    {
        $new = clone $this;
        $new->itemsOptions = $value;
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
            $html = Html::openTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon]) .
                Html::closeTag('span');
        }

        return $html;
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param array $item The item to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template The template to be used to rendered the link. The token "{link}" will be replaced by the
     * link.
     *
     * @throws InvalidArgumentException|JsonException If `$item` does not have "label" element.
     *
     * @return string The rendering result.
     */
    private function renderItem(array $item, string $template): string
    {
        $encodeLabel = ArrayHelper::remove($item, 'encode', $this->encodeLabels);

        $icon = '';
        $iconOptions = [];

        if (isset($item['icon'])) {
            $icon = $item['icon'];
        }

        if (isset($item['iconOptions']) && is_array($item['iconOptions'])) {
            $iconOptions = $this->addOptions($iconOptions, 'icon');
        }

        unset($item['icon'], $item['iconOptions']);

        if (array_key_exists('label', $item)) {
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        } else {
            throw new InvalidArgumentException('The "label" element is required for each link.');
        }

        if (isset($item['template'])) {
            $template = $item['template'];
        }

        if (isset($item['url'])) {
            $options = $item;
            unset($options['template'], $options['label'], $options['url'], $options['icon']);
            $link = Html::a($label, $item['url'], $options)->encode(false)->render();
        } else {
            $link = $label;
        }

        return strtr(
            $template,
            ['{label}' => $label, '{link}' => $link, '{icon}' => $this->renderIcon($icon, $iconOptions)],
        );
    }

    private function renderItems(): array
    {
        $items = [];

        if ($this->homeItem !== null) {
            $items[] = $this->renderItem($this->homeItem, $this->itemTemplate);
        }

        foreach ($this->items as $item) {
            if (!is_array($item)) {
                $item = ['label' => $item];
            }

            $items[] = $this->renderItem($item, isset($item['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }

        return $items;
    }
}
