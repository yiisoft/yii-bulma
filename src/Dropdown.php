<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

use function array_merge;
use function implode;

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
    private bool $encloseByContainer = true;
    private array $items = [];
    private array $itemsOptions = [];
    private array $options = [];
    private array $buttonOptions = [];
    private array $linkOptions = ['aria-haspopup' => 'true', 'aria-expanded' => 'false'];
    private array $triggerOptions = [];

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
     * The HTML attributes for the button dropdown.
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
    public function dividerClass(string $value): self
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
    public function itemClass(string $value): self
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
    public function itemsClass(string $value): self
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
    public function encloseByContainer(bool $value): self
    {
        $this->encloseByContainer = $value;
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
     * - itemsOptions: array, optional, the HTML attributes of the item.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *
     * To insert divider use `-`.
     *
     * @param array $value
     *
     * @return self
     */
    public function items(array $value): self
    {
        $this->items = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget container tag.
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
     * The HTML attributes for the widget button tag.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonOptions(array $value): self
    {
        $this->buttonOptions = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget items.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function itemsOptions(array $value): self
    {
        $this->itemsOptions = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget container trigger.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function triggerOptions(array $value): self
    {
        $this->triggerOptions = $value;
        return $this;
    }

    private function buildDropdown(): string
    {
        if ($this->encloseByContainer) {
            $html = Html::beginTag('div', $this->options) . "\n";
            $html .= $this->buildDropdownTrigger();
            $html .= $this->renderItems($this->items, $this->itemsOptions) . "\n";
            $html .= Html::endTag('div');
        } else {
            $html = $this->renderItems($this->items, $this->itemsOptions);
        }

        return $html;
    }

    private function buildDropdownTrigger(): string
    {
        return
            Html::beginTag('div', $this->triggerOptions) . "\n" .
                Html::beginTag('button', $this->buttonOptions) . "\n" .
                    Html::tag('span', $this->buttonLabel, $this->buttonLabelOptions) . "\n" .
                    Html::beginTag('span', $this->buttonIconOptions) . "\n" .
                        Html::tag('i', '', $this->buttonIcon) . "\n" .
                    Html::endTag('span') . "\n" .
                Html::endTag('button') . "\n" .
            Html::endTag('div') . "\n";
    }

    private function buildOptions(): void
    {
        if ($this->encloseByContainer && (!isset($this->options['id']))) {
            $this->options['id'] = "{$this->getId()}-dropdown";
            $this->options = $this->addOptions($this->options, 'dropdown');
            $this->triggerOptions = $this->addOptions($this->triggerOptions, 'dropdown-trigger');
            $this->buttonOptions = $this->addOptions(
                array_merge(
                    $this->buttonOptions,
                    [ 'aria-haspopup' => 'true', 'aria-controls' => 'dropdown-menu']
                ),
                'button'
            );

            $this->buttonIconOptions = $this->addOptions($this->buttonIconOptions, 'icon is-small');
        } elseif (!isset($this->itemsOptions['id'])) {
            $this->itemsOptions['id'] = "{$this->getId()}-dropdown";
        }

        $this->itemsOptions = $this->addOptions($this->itemsOptions, $this->itemsClass);
    }

    /**
     * Renders menu items.
     *
     * @param array $items the menu items to be rendered
     * @param array $itemsOptions the container HTML attributes
     *
     * @return string the rendering result.
     *
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    private function renderItems(array $items, array $itemsOptions = []): string
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

            $icon = '';
            $iconOptions = [];

            if (isset($item['icon'])) {
                $icon = $item['icon'];
            }

            if (isset($item['iconOptions']) && is_array($item['iconOptions'])) {
                $iconOptions = $this->addOptions($iconOptions, 'icon');
            }

            $label = $this->renderIcon($label, $icon, $iconOptions);

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
                $lines[] = Html::a($label, $url, array_merge($this->linkOptions, $linkOptions));

                $lines[] = Dropdown::widget()
                    ->dividerClass($this->dividerClass)
                    ->itemClass($this->itemClass)
                    ->itemsClass($this->itemsClass)
                    ->encloseByContainer($this->encloseByContainer)
                    ->encodeLabels($this->encodeLabels)
                    ->items($item['items'])
                    ->render();
            }
        }

        return
            Html::beginTag('div', $itemsOptions) . "\n" .
                implode("\n", $lines) . "\n" .
            Html::endTag('div');
    }

    private function renderIcon(string $label, string $icon, array $iconOptions): string
    {
        if ($icon !== '') {
            $label = Html::beginTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon]) .
                Html::endTag('span') .
                Html::tag('span', $label);
        }

        return $label;
    }
}
