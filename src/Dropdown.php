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

/**
 * The dropdown component is a container for a dropdown button and a dropdown menu.
 *
 * @link https://bulma.io/documentation/components/dropdown/
 */
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
     * Returns a new instance with the specified label for the dropdown button.
     *
     * @param string $value The label for the dropdown button.
     *
     * @return self
     */
    public function buttonLabel(string $value): self
    {
        $new = clone $this;
        $new->buttonLabel = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the dropdown button.
     *
     * @param array $value The HTML attributes for the dropdown button.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonLabelOptions(array $value): self
    {
        $new = clone $this;
        $new->buttonLabelOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown divider.
     *
     * @param string $value The CSS class for dropdown divider.
     *
     * @return self
     */
    public function dividerClass(string $value): self
    {
        $new = clone $this;
        $new->dividerClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown item.
     *
     * @param string $value The CSS class for dropdown item.
     *
     * @return self
     */
    public function itemClass(string $value): self
    {
        $new = clone $this;
        $new->itemClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown items container.
     *
     * @param string $value The CSS class for dropdown items container.
     *
     * @return self
     */
    public function itemsClass(string $value): self
    {
        $new = clone $this;
        $new->itemsClass = $value;
        return $new;
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
     * Disables enclosed by container dropdown and returns a new instance.
     *
     * @return self
     */
    public function withoutEncloseByContainer(): self
    {
        $new = clone $this;
        $new->encloseByContainer = false;
        return $new;
    }

    /**
     * Returns a new instance with the specified list of items.
     *
     * @param array $value List of menu items in the dropdown. Each array element can be either an HTML string,
     * or an array representing a single menu with the following structure:
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
     * @return self
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the widget container tag.
     *
     * @param array $value The HTML attributes for the widget container tag.
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
     * Returns a new instance with the specified HTML attributes for the widget button tag.
     *
     * @param array $value The HTML attributes for the widget button tag.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function buttonOptions(array $value): self
    {
        $new = clone $this;
        $new->buttonOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the widget items.
     *
     * @param array $value The HTML attributes for the widget items.
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

    /**
     * Returns a new instance with the specified HTML attributes for the widget container trigger.
     *
     * @param array $value The HTML attributes for the widget container trigger.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function triggerOptions(array $value): self
    {
        $new = clone $this;
        $new->triggerOptions = $value;
        return $new;
    }

    private function buildDropdown(): string
    {
        if ($this->encloseByContainer) {
            $html = Html::openTag('div', $this->options) . "\n";
            $html .= $this->buildDropdownTrigger();
            $html .= $this->renderItems($this->items, $this->itemsOptions) . "\n";
            $html .= Html::closeTag('div');
        } else {
            $html = $this->renderItems($this->items, $this->itemsOptions);
        }

        return $html;
    }

    private function buildDropdownTrigger(): string
    {
        return
            Html::openTag('div', $this->triggerOptions) . "\n" .
                Html::openTag('button', $this->buttonOptions) . "\n" .
                    Html::tag('span', $this->buttonLabel, $this->buttonLabelOptions) . "\n" .
                    Html::openTag('span', $this->buttonIconOptions) . "\n" .
                        Html::tag('i', '', $this->buttonIcon) . "\n" .
                    Html::closeTag('span') . "\n" .
                Html::closeTag('button') . "\n" .
            Html::closeTag('div') . "\n";
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
     * @param array $items The menu items to be rendered
     * @param array $itemsOptions The container HTML attributes
     *
     * @throws InvalidArgumentException|JsonException If the label option is not specified in one of the items.
     *
     * @return string The rendering result.
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
                throw new InvalidArgumentException('The "label" option is required.');
            }

            $this->encodeLabels = $item['encode'] ?? $this->encodeLabels;

            if ($this->encodeLabels) {
                $label = Html::encode($item['label']);
            } else {
                $label = $item['label'];
            }

            $iconOptions = [];

            $icon = $item['icon'] ?? '';

            if (array_key_exists('iconOptions', $item) && is_array($item['iconOptions'])) {
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
                Html::addCssClass($linkOptions, ['active' => 'is-active']);
            }

            $url = $item['url'] ?? null;

            if (empty($item['items'])) {
                $lines[] = Html::a($label, $url, $linkOptions)
                    ->encode(false)
                    ->render();
            } else {
                $lines[] = Html::a($label, $url, array_merge($this->linkOptions, $linkOptions))
                    ->encode(false)
                    ->render();

                $dropdownWidget = self::widget()
                    ->dividerClass($this->dividerClass)
                    ->itemClass($this->itemClass)
                    ->itemsClass($this->itemsClass)
                    ->items($item['items']);

                if ($this->encloseByContainer === false) {
                    $dropdownWidget = $dropdownWidget->withoutEncloseByContainer();
                }

                if ($this->encodeLabels === false) {
                    $dropdownWidget = $dropdownWidget->withoutEncodeLabels();
                }

                $lines[] = $dropdownWidget->render();
            }
        }

        return
            Html::openTag('div', $itemsOptions) . "\n" .
                implode("\n", $lines) . "\n" .
            Html::closeTag('div');
    }

    private function renderIcon(string $label, string $icon, array $iconOptions): string
    {
        if ($icon !== '') {
            $label = Html::openTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon])->encode(false) .
                Html::closeTag('span') .
                Html::span($label)->encode(false);
        }

        return $label;
    }
}
