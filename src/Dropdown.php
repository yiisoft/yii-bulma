<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

final class Dropdown extends Widget
{
    private string $cssOptions = 'dropdown-menu';
    private string $cssDivider = 'dropdown-divider';
    private string $cssItem = 'dropdown-item';
    private bool $encodeLabels = true;
    private array $items = [];
    private array $options = [];
    private array $optionsLink = ['aria-haspopup' => 'true', 'aria-expanded' => 'false'];

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-dropdown";
        }

        $this->options = $this->addOptions($this->options, $this->cssOptions);

        return $this->renderItems($this->items, $this->options);
    }

    public function cssDivider(string $value): self
    {
        $this->cssDivider  = $value;
        return $this;
    }

    public function cssItem(string $value): self
    {
        $this->cssItem  = $value;
        return $this;
    }

    public function cssOptions(string $value): self
    {
        $this->cssOptions  = $value;
        return $this;
    }

    /**
     * Whether the labels for header items should be HTML-encoded.
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
     * List of menu items in the dropdown. Each array element can be either an HTML string, or an array representing a
     * single menu with the following structure:
     *
     * - label: string, required, the label of the item link.
     * - encode: bool, optional, whether to HTML-encode item label.
     * - url: string|array, optional, the URL of the item link. This will be processed by {@see currentPath}.
     *   If not set, the item will be treated as a menu header when the item has no sub-menu.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item link.
     * - options: array, optional, the HTML attributes of the item.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *
     * To insert divider use `-`.
     */
    public function items(array $value): self
    {
        $this->items = $value;
        return $this;
    }

    /**
     * @param array $value the HTML attributes for the widget container tag. The following special options are
     * recognized.
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
     * Renders menu items.
     *
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     *
     * @return string the rendering result.
     *
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    private function renderItems(array $items, array $options = []): string
    {
        $lines = [];

        foreach ($items as $item) {
            if ($item === '-') {
                $lines[] = Html::tag('div', '', ['class' => $this->cssDivider]);
                continue;
            }

            if (!isset($item['label']) && $item !== '-') {
                throw new InvalidConfigException("The 'label' option is required.");
            }

            $this->encodeLabels = $item['encode'] ?? $this->encodeLabels;

            if ($this->encodeLabels) {
                $label = Html::encode($item['label']);
            } else {
                $label = $item['label'];
            }

            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $active = ArrayHelper::getValue($item, 'active', false);
            $disabled = ArrayHelper::getValue($item, 'disabled', false);

            Html::addCssClass($linkOptions, $this->cssItem);

            if ($disabled) {
                Html::addCssStyle($linkOptions, 'opacity:.65; pointer-events:none;');
            }

            if ($active) {
                Html::addCssClass($linkOptions, 'is-active');
            }

            $url = $item['url'] ?? null;

            if (empty($item['items'])) {
                $lines[] = Html::a($label, $url, $linkOptions);
            } else {
                $lines[] = Html::a($label, $url, array_merge($this->optionsLink, $linkOptions));

                $lines[] = Dropdown::widget()
                    ->cssDivider($this->cssDivider)
                    ->cssItem($this->cssItem)
                    ->cssOptions($this->cssOptions)
                    ->items($item['items'])
                    ->encodeLabels($this->encodeLabels)
                    ->render();
            }
        }

        return Html::tag('div', implode("\n", $lines), $options);
    }
}
