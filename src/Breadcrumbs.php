<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

/**
 * The Bulma breadcrumb is a simple navigation component that only requires
 *
 * For example,
 *
 * ```php
 * echo Breadcrumbs::widget()
 *     ->links(['label' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);
 * ```
 */
class Breadcrumbs extends Widget
{
    private bool $encodeLabels = true;
    private array $homeLink = [];
    private string $itemTemplate = "<li>{link}</li>\n";
    private string $itemTemplateActive = "<li class=\"is-active\"><a aria-current=\"page\">{label}</li>\n";
    private array $links = [];
    private array $options = [];
    private array $optionsItems = [];

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-breadcrumbs";
        }

        $this->options = $this->addOptions($this->options, 'breadcrumb');
        $this->options = array_merge(['aria-label' => 'breadcrumbs'], $this->options);

        if (empty($this->links)) {
            return '';
        }

        $links = [];

        if ($this->homeLink === array()) {
            $links[] = $this->renderItem([
                'label' => 'Home',
                'url' => '/',
            ], $this->itemTemplate);
        } else {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }

        foreach ($this->links as $link) {
            if (!\is_array($link)) {
                $link = ['label' => $link];
            }

            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->itemTemplateActive);
        }

        return Html::tag('nav', Html::tag('ul', implode('', $links), $this->optionsItems), $this->options);
    }

    /**
     * Whether to HTML-encode the link labels.
     *
     * @param bool $value
     *
     * @return self
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;
        return $this;
    }

    /**
     * The first hyperlink in the breadcrumbs (called home link).
     *
     * Please refer to {@see links} on the format of the link.
     *
     * If this property is not set, it will default to a link pointing with the label 'Home'. If this property is false,
     * the home link will not be rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function homeLink(array $value): self
    {
        $this->homeLink = $value;
        return $this;
    }

    /**
     * The template used to render each inactive item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each inactive item.
     *
     * @param string $value
     *
     * @return self
     */
    public function itemTemplate(string $value): self
    {
        $this->itemTemplate = $value;
        return $this;
    }

    /**
     * The template used to render each active item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each active item.
     *
     * @param string $value
     *
     * @return self
     */
    public function itemTemplateActive(string $value): self
    {
        $this->itemTemplateActive = $value;
        return $this;
    }

    /**
     * List of links to appear in the breadcrumbs. If this property is empty, the widget will not render anything. Each
     * array element represents a single link in the breadcrumbs with the following structure:
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
    public function links(array $value): self
    {
        $this->links = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget container nav tag. The following special options are recognized.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $value): self
    {
        $this->options = $value;
        return $this;
    }

    /**
     * The HTML attributes for the items widget. The following special options are recognized.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsItems(array $value): self
    {
        $this->optionsItems = $value;
        return $this;
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the
     * link.
     *
     * @return string the rendering result
     *
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    private function renderItem(array $link, string $template): string
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);

        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }

        if (isset($link['template'])) {
            $template = $link['template'];
        }

        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url'], $options['icon']);
            $linkHtml = Html::a($label, $link['url'], $options);
        } else {
            $linkHtml = $label;
        }

        return strtr($template, ['{label}' => $label, '{link}' => $linkHtml]);
    }
}