<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function array_merge;
use function implode;

/**
 * The dropdown component is a container for a dropdown button and a dropdown menu.
 *
 * @link https://bulma.io/documentation/components/dropdown/
 */
final class Dropdown extends Widget
{
    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private array $buttonAttributes = [];
    private array $buttonIconAttributes = ['class' => 'icon is-small'];
    private string $buttonIconCssClass = '';
    private string $buttonIconText = '&#8595;';
    private string $buttonLabel = 'Click Me';
    private array $buttonLabelAttributes = [];
    private string $dividerCssClass = 'dropdown-divider';
    private string $dropdownCssClass = 'dropdown';
    private string $dropdownContentCssClass = 'dropdown-content';
    private string $dropdownItemActiveCssClass = 'is-active';
    private string $dropdownItemCssClass = 'dropdown-item';
    private string $dropdownItemDisabledStyleCss = 'opacity:.65;pointer-events:none;';
    private string $dropdownItemHeaderCssClass = 'dropdown-header';
    private string $dropdownMenuCssClass = 'dropdown-menu';
    private string $dropdownTriggerCssClass = 'dropdown-trigger';
    private bool $encloseByContainer = true;
    private array $items = [];
    private bool $submenu = false;
    private array $submenuAttributes = [];

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * See {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified prefix to the automatically generated widget IDs.
     *
     * @param string $value The prefix to the automatically generated widget IDs.
     *
     * @return self
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;
        return $new;
    }

    /**
     * The HTML attributes for the dropdown button.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     */
    public function buttonAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonAttributes = $values;
        return $new;
    }

    /**
     * The HTML attributes for the dropdown button icon.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     */
    public function buttonIconAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonIconAttributes = $values;
        return $new;
    }

    /**
     * Set icon CSS class for the dropdown button.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function buttonIconCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonIconCssClass = $value;
        return $new;
    }

    /**
     * Set icon text for the dropdown button.
     *
     * @param string $value The text.
     *
     * @return self
     */
    public function buttonIconText(string $value): self
    {
        $new = clone $this;
        $new->buttonIconText = $value;
        return $new;
    }

    /**
     * Set label for the dropdown button.
     *
     * @param string $value The label.
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
     * The HTML attributes for the dropdown button label.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     */
    public function buttonLabelAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonLabelAttributes = $values;
        return $new;
    }

    /**
     * Set CSS class for horizontal line separating dropdown items.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dividerCssClass(string $value): self
    {
        $new = clone $this;
        $new->dividerCssClass = $value;
        return $new;
    }

    /**
     * Set CSS class for the dropdown container.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownCssClass = $value;
        return $new;
    }

    /**
     * Set CSS class for dropdown content.
     *
     * @param string $value The CSS class.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/dropdown/#dropdown-content
     */
    public function dropdownContentCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownContentCssClass = $value;
        return $new;
    }

    /**
     * Set CSS class for active dropdown item.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownItemActiveCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemActiveCssClass = $value;
        return $new;
    }

    /**
     * Set CSS class for dropdown item.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemCssClass = $value;
        return $new;
    }

    /**
     * Set Style attributes for disabled dropdown item.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownItemDisabledStyleCss(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemDisabledStyleCss = $value;
        return $new;
    }

    /**
     * Set CSS class for dropdown item header.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownItemHeaderCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownItemHeaderCssClass = $value;
        return $new;
    }

    /**
     * Set Dropdown menu CSS class.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownMenuCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownMenuCssClass = $value;
        return $new;
    }

    /**
     * Set Dropdown trigger CSS class.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function dropdownTriggerCssClass(string $value): self
    {
        $new = clone $this;
        $new->dropdownTriggerCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string $value The ID of the widget.
     *
     * @return self
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
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
     * - urlAttributes: array, optional, the HTML attributes of the item link.
     * - attributes: array, optional, the HTML attributes of the item.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *   Note that Bootstrap doesn't support dropdown submenu. You have to add your own CSS styles to support it.
     * - submenuOptions: array, optional, the HTML attributes for sub-menu container tag. If specified it will be
     *   merged with {@see submenuOptions}.
     *
     * To insert divider use `-`.
     *
     * @param array $value The menu items.
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
     * Set if it is a submenu or sub-dropdown.
     *
     * @param bool $value Whether it is a submenu or sub-dropdown. Defaults to false.
     *
     * @return self
     */
    public function submenu(bool $value): self
    {
        $new = clone $this;
        $new->submenu = $value;
        return $new;
    }

    /**
     * The HTML attributes for sub-menu container tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     */
    public function submenuAttributes(array $values): self
    {
        $new = clone $this;
        $new->submenuAttributes = $values;
        return $new;
    }

    /**
     * If the widget should be enclosed by container.
     *
     * @param bool $value Whether the widget should be enclosed by container. Defaults to true.
     *
     * @return self
     */
    public function enclosedByContainer(bool $value = false): self
    {
        $new = clone $this;
        $new->encloseByContainer = $value;
        return $new;
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    protected function run(): string
    {
        return $this->renderDropdown();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    private function renderDropdown(): string
    {
        $attributes = $this->attributes;

        /** @var string */
        $id = $attributes['id'] ?? (Html::generateId($this->autoIdPrefix) . '-dropdown');
        unset($attributes['id']);

        if ($this->encloseByContainer) {
            Html::addCssClass($attributes, $this->dropdownCssClass);
            $html = Div::tag()
                ->attributes($attributes)
                ->content(PHP_EOL . $this->renderDropdownTrigger($id) . PHP_EOL)
                ->encode(false)
                ->render();
        } else {
            $html = $this->renderItems();
        }

        return $html;
    }

    /**
     * Render dropdown button.
     *
     * @return string The rendering result.
     *
     * @link https://bulma.io/documentation/components/dropdown/#hoverable-or-toggable
     */
    private function renderDropdownButton(string $id): string
    {
        $buttonAttributes = $this->buttonAttributes;

        Html::addCssClass($buttonAttributes, 'button');

        $buttonAttributes['aria-haspopup'] = 'true';
        $buttonAttributes['aria-controls'] = $id;

        return Button::tag()
            ->attributes($buttonAttributes)
            ->content(
                $this->renderLabelButton(
                    $this->buttonLabel,
                    $this->buttonLabelAttributes,
                    $this->buttonIconText,
                    $this->buttonIconCssClass,
                    $this->buttonIconAttributes,
                )
            )
            ->encode(false)
            ->render() . PHP_EOL;
    }

    private function renderDropdownButtonLink(): string
    {
        return A::tag()
            ->class($this->dropdownItemCssClass)
            ->content(
                $this->renderLabelButton(
                    $this->buttonLabel,
                    $this->buttonLabelAttributes,
                    $this->buttonIconText,
                    $this->buttonIconCssClass,
                    $this->buttonIconAttributes,
                )
            )
            ->encode(false)
            ->render() . PHP_EOL;
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    private function renderDropdownContent(): string
    {
        return Div::tag()
            ->class($this->dropdownContentCssClass)
            ->content(PHP_EOL . $this->renderItems() . PHP_EOL)
            ->encode(false)
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    private function renderDropdownMenu(string $id): string
    {
        return Div::tag()
            ->class($this->dropdownMenuCssClass)
            ->content(PHP_EOL . $this->renderDropdownContent() . PHP_EOL)
            ->encode(false)
            ->id($id)
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    private function renderDropdownTrigger(string $id): string
    {
        if (!$this->submenu) {
            $button = $this->renderDropdownButton($id);
        } else {
            $button = $this->renderDropdownButtonLink();
        }

        return Div::tag()
            ->class($this->dropdownTriggerCssClass)
            ->content(PHP_EOL . $button)
            ->encode(false)
            ->render() . PHP_EOL . $this->renderDropdownMenu($id);
    }

    /**
     * Renders menu items.
     *
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     * @return string the rendering result.
     */
    private function renderItems(): string
    {
        $lines = [];

        /** @var array|string $item */
        foreach ($this->items as $item) {
            if ($item === '-') {
                $lines[] = CustomTag::name('hr')->class($this->dividerCssClass)->render();
            } else {
                if (!isset($item['label'])) {
                    throw new InvalidArgumentException('The "label" option is required.');
                }

                /** @var string */
                $itemLabel = $item['label'] ?? '';

                if (isset($item['encode']) && $item['encode'] === true) {
                    $itemLabel = Html::encode($itemLabel);
                }

                /** @var array */
                $items = $item['items'] ?? [];

                /** @var array */
                $urlAttributes = $item['urlAttributes'] ?? [];

                /** @var string */
                $iconText = $item['iconText'] ?? '';

                /** @var string */
                $iconCssClass = $item['iconCssClass'] ?? '';

                /** @var array */
                $iconAttributes = $item['iconAttributes'] ?? [];

                /** @var string */
                $url = $item['url'] ?? '';

                /** @var bool */
                $active = $item['active'] ?? false;

                /** @var bool */
                $disabled = $item['disable'] ?? false;

                /** @var bool */
                $enclose = $item['enclose'] ?? true;

                /** @var bool */
                $submenu = $item['submenu'] ?? false;

                $itemLabel = $this->renderLabelItem($itemLabel, $iconText, $iconCssClass, $iconAttributes);

                Html::addCssClass($urlAttributes, $this->dropdownItemCssClass);

                if ($disabled) {
                    Html::addCssStyle($urlAttributes, $this->dropdownItemDisabledStyleCss);
                } elseif ($active) {
                    Html::addCssClass($urlAttributes, $this->dropdownItemActiveCssClass);
                }

                if ($items === []) {
                    if ($itemLabel === '-') {
                        $content = CustomTag::name('hr')->class($this->dividerCssClass)->render();
                    } elseif ($enclose === false) {
                        $content = $itemLabel;
                    } elseif ($url === '') {
                        $content = CustomTag::name('h6')
                            ->class($this->dropdownItemHeaderCssClass)
                            ->content($itemLabel)
                            ->encode(null)
                            ->render();
                    } else {
                        $content = A::tag()
                            ->attributes($urlAttributes)
                            ->content($itemLabel)
                            ->encode(false)
                            ->url($url)
                            ->render();
                    }

                    $lines[] = $content;
                } else {
                    /** @var array */
                    $submenuAttributes = array_merge($this->submenuAttributes, $item['submenuAttributes'] ?? []);

                    $lines[] = self::widget()
                        ->attributes($this->attributes)
                        ->dividerCssClass($this->dividerCssClass)
                        ->dropdownItemCssClass($this->dropdownItemCssClass)
                        ->items($items)
                        ->submenu($submenu)
                        ->submenuAttributes($submenuAttributes)
                        ->render();
                }
            }
        }

        return implode(PHP_EOL, $lines);
    }

    private function renderLabelButton(
        string $label,
        array $labelAttributes,
        string $iconText,
        string $iconCssClass,
        array $iconAttributes = []
    ): string {
        $html = '';

        if ($label !== '') {
            $html = PHP_EOL . Span::tag()
                ->attributes($labelAttributes)
                ->content($label)
                ->encode(false)
                ->render();
        }

        if ($iconText !== '' || $iconCssClass !== '') {
            $html .= PHP_EOL .
                Span::tag()
                    ->attributes($iconAttributes)
                    ->content(CustomTag::name('i')->class($iconCssClass)->content($iconText)->encode(false)->render())
                    ->encode(false)
                    ->render();
        }

        return $html . PHP_EOL;
    }

    private function renderLabelItem(
        string $label,
        string $iconText,
        string $iconCssClass,
        array $iconAttributes = []
    ): string {
        $html = '';

        if ($iconText !== '' || $iconCssClass !== '') {
            $html = Span::tag()
                ->attributes($iconAttributes)
                ->content(CustomTag::name('i')->class($iconCssClass)->content($iconText)->encode(false)->render())
                ->encode(false)
                ->render();
        }

        if ($label !== '') {
            $html .= $label;
        }

        return $html;
    }
}
