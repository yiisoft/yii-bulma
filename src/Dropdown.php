<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

final class Dropdown extends Widget
{
    private string $buttonLabel = '';
    private array $buttonLabelOptions = [];
    private array $buttonIcon = ['class' => 'fas fa-angle-down', 'aria-hidden' => 'true'];
    private array $buttonIconOptions = [];
    private string $dividerClass = 'dropdown-divider';
    private string $itemsClass = 'dropdown-menu';
    private string $itemClass = 'dropdown-item';
    private bool $encodeLabels = true;
    private bool $enclosedByContainer = true;
    private array $items = [];
    private array $options = [];
    private array $optionsButton = [];
    private array $optionsItems = [];
    private array $optionsLink = ['aria-haspopup' => 'true', 'aria-expanded' => 'false'];
    private array $optionsTrigger = [];

    protected function run(): string
    {
        $this->buildOptions();

        return $this->buildDropdown();
    }

    /**
     * Set label button dropdown.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLabel(string $value): self
    {
        $this->buttonLabel = $value;
        return $this;
    }

    /**
     * The HTML attributes for the button dropdown. The following special options are recognized.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonLabelOptions(array $value): self
    {
        $this->buttonLabelOptions = $value;
        return $this;
    }

    /**
     * Set css class divider dropdown.
     *
     * @param $value
     *
     * @return self
     */
    public function cssDivider(string $value): self
    {
        $this->dividerClass  = $value;
        return $this;
    }

    /**
     * Set css class item dropdown.
     *
     * @param $value
     *
     * @return self
     */
    public function cssItem(string $value): self
    {
        $this->itemClass  = $value;
        return $this;
    }

    /**
     * Set css class items container dropdown.
     *
     * @param $value
     *
     * @return self
     */
    public function cssItems(string $value): self
    {
        $this->itemsClass  = $value;
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
     * Set enclosed by container dropdown.
     *
     * @param $value
     *
     * @return self
     */
    public function enclosedByContainer(bool $value): self
    {
        $this->enclosedByContainer = $value;
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
     * - optionsItems: array, optional, the HTML attributes of the item.
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
     * The HTML attributes for the widget container tag. The following special options are recognized.
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
     * The HTML attributes for the widget button tag. The following special options are recognized.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsButton(array $value): self
    {
        $this->optionsButton = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget items. The following special options are recognized.
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
     * The HTML attributes for the widget container trigger. The following special options are recognized.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsTrigger(array $value): self
    {
        $this->optionsTrigger = $value;
        return $this;
    }

    private function buildDropdown(): string
    {
        if ($this->enclosedByContainer) {
            $html = Html::beginTag('div', $this->options) . "\n";
            $html .= $this->buildDropdownTrigger();
            $html .= $this->renderItems($this->items, $this->optionsItems) . "\n";
            $html .= Html::endTag('div');
        } else {
            $html = $this->renderItems($this->items, $this->optionsItems);
        }

        return $html;
    }

    private function buildDropdownTrigger(): string
    {
        return
            Html::beginTag('div', $this->optionsTrigger) . "\n" .
                Html::beginTag('button', $this->optionsButton) . "\n" .
                    Html::tag('span', $this->buttonLabel, $this->buttonLabelOptions) . "\n" .
                    Html::beginTag('span', $this->buttonIconOptions) . "\n" .
                        Html::tag('i', '', $this->buttonIcon) . "\n" .
                    Html::endTag('span') . "\n" .
                Html::endTag('button') . "\n" .
            Html::endTag('div') . "\n";
    }

    private function buildOptions(): void
    {
        if ($this->enclosedByContainer && (!isset($this->options['id']))) {
            $this->options['id'] = "{$this->getId()}-dropdown";
            $this->options = $this->addOptions($this->options, 'dropdown');
            $this->optionsTrigger = $this->addOptions($this->optionsTrigger, 'dropdown-trigger');
            $this->optionsButton = $this->addOptions($this->optionsButton, 'button');
            $this->optionsButton = array_merge(
                ['aria-haspopup' => 'true', 'aria-controls' => 'dropdown-menu'],
                $this->optionsButton
            );
            $this->buttonIconOptions = $this->addOptions($this->buttonIconOptions, 'icon is-small');
        } elseif (!isset($this->optionsItems['id'])) {
            $this->optionsItems['id'] = "{$this->getId()}-dropdown";
        }

        $this->optionsItems = $this->addOptions($this->optionsItems, $this->itemsClass);
    }

    /**
     * Renders menu items.
     *
     * @param array $items the menu items to be rendered
     * @param array $optionsItems the container HTML attributes
     *
     * @return string the rendering result.
     *
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    private function renderItems(array $items, array $optionsItems = []): string
    {
        $lines = [];

        foreach ($items as $item) {
            if ($item === '-') {
                $lines[] = Html::tag('div', '', ['class' => $this->dividerClass]);
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

            Html::addCssClass($linkOptions, $this->itemClass);

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
                    ->cssDivider($this->dividerClass)
                    ->cssItem($this->itemClass)
                    ->cssItems($this->itemsClass)
                    ->enclosedByContainer($this->enclosedByContainer)
                    ->encodeLabels($this->encodeLabels)
                    ->items($item['items'])
                    ->render();
            }
        }

        return
            Html::beginTag('div', $optionsItems) . "\n" .
                implode("\n", $lines) . "\n" .
            Html::endTag('div');
    }
}
