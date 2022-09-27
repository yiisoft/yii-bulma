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
use function is_array;

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
    private string $cssClass = 'dropdown';
    private string $contentCssClass = 'dropdown-content';
    private string $dividerCssClass = 'dropdown-divider';
    private bool $encloseByContainer = true;
    private string $itemActiveCssClass = 'is-active';
    private string $itemCssClass = 'dropdown-item';
    private string $itemDisabledStyleCss = 'opacity:.65;pointer-events:none;';
    private string $itemHeaderCssClass = 'dropdown-header';
    private array $items = [];
    private string $menuCssClass = 'dropdown-menu';
    private bool $submenu = false;
    private array $submenuAttributes = [];
    private string $triggerCssClass = 'dropdown-trigger';

    /**
     * Returns a new instance with the specified HTML attributes for widget.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} For details on how attributes are being rendered.
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
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the dropdown button.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function buttonAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the dropdown button icon.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function buttonIconAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonIconAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified icon CSS class for the dropdown button.
     *
     * @param string $value The CSS class.
     */
    public function buttonIconCssClass(string $value): self
    {
        $new = clone $this;
        $new->buttonIconCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified icon text for the dropdown button.
     *
     * @param string $value The text.
     */
    public function buttonIconText(string $value): self
    {
        $new = clone $this;
        $new->buttonIconText = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified label for the dropdown button.
     *
     * @param string $value The label.
     */
    public function buttonLabel(string $value): self
    {
        $new = clone $this;
        $new->buttonLabel = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the dropdown button label.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function buttonLabelAttributes(array $values): self
    {
        $new = clone $this;
        $new->buttonLabelAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown content.
     *
     * @param string $value The CSS class.
     *
     * @link https://bulma.io/documentation/components/dropdown/#dropdown-content
     */
    public function contentCssClass(string $value): self
    {
        $new = clone $this;
        $new->contentCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for the dropdown container.
     *
     * @param string $value The CSS class.
     */
    public function cssClass(string $value): self
    {
        $new = clone $this;
        $new->cssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for horizontal line separating dropdown items.
     *
     * @param string $value The CSS class.
     */
    public function dividerCssClass(string $value): self
    {
        $new = clone $this;
        $new->dividerCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified if the widget should be enclosed by container.
     *
     * @param bool $value Whether the widget should be enclosed by container. Defaults to true.
     */
    public function enclosedByContainer(bool $value = false): self
    {
        $new = clone $this;
        $new->encloseByContainer = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string $value The ID of the widget.
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for active dropdown item.
     *
     * @param string $value The CSS class.
     */
    public function itemActiveCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemActiveCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown item.
     *
     * @param string $value The CSS class.
     */
    public function itemCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified style attributes for disabled dropdown item.
     *
     * @param string $value The CSS class.
     */
    public function itemDisabledStyleCss(string $value): self
    {
        $new = clone $this;
        $new->itemDisabledStyleCss = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified CSS class for dropdown item header.
     *
     * @param string $value The CSS class.
     */
    public function itemHeaderCssClass(string $value): self
    {
        $new = clone $this;
        $new->itemHeaderCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified list of items.
     *
     * Each array element can be either an HTML string, or an array representing a single menu with the following
     * structure:
     *
     * - label: string, required, the label of the item link.
     * - encode: bool, optional, whether to HTML-encode item label.
     * - url: string|array, optional, the URL of the item link. This will be processed by {@see currentPath}.
     *   If not set, the item will be treated as a menu header when the item has no sub-menu.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - urlAttributes: array, optional, the HTML attributes of the item link.
     * - items: array, optional, the submenu items. The structure is the same as this property.
     *   Note that Bootstrap doesn't support dropdown submenu. You have to add your own CSS styles to support it.
     * - submenuAttributes: array, optional, the HTML attributes for sub-menu container tag. If specified it will be
     *   merged with {@see submenuAttributes}.
     *
     * To insert divider use `-`.
     *
     * @param array $value The menu items.
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified dropdown menu CSS class.
     *
     * @param string $value The CSS class.
     */
    public function menuCssClass(string $value): self
    {
        $new = clone $this;
        $new->menuCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified dropdown trigger CSS class.
     *
     * @param string $value The CSS class.
     */
    public function triggerCssClass(string $value): self
    {
        $new = clone $this;
        $new->triggerCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified if it is a submenu or sub-dropdown.
     *
     * @param bool $value Whether it is a submenu or sub-dropdown. Defaults to false.
     */
    public function submenu(bool $value): self
    {
        $new = clone $this;
        $new->submenu = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for sub-menu container tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function submenuAttributes(array $values): self
    {
        $new = clone $this;
        $new->submenuAttributes = $values;
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
            Html::addCssClass($attributes, $this->cssClass);
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
                ->class($this->itemCssClass)
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
            ->class($this->contentCssClass)
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
            ->class($this->menuCssClass)
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
                ->class($this->triggerCssClass)
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
                $lines[] = CustomTag::name('hr')
                    ->class($this->dividerCssClass)
                    ->render();
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

                Html::addCssClass($urlAttributes, $this->itemCssClass);

                if ($disabled) {
                    Html::addCssStyle($urlAttributes, $this->itemDisabledStyleCss);
                } elseif ($active) {
                    Html::addCssClass($urlAttributes, $this->itemActiveCssClass);
                }

                if ($items === []) {
                    if ($itemLabel === '-') {
                        $content = CustomTag::name('hr')
                            ->class($this->dividerCssClass)
                            ->render();
                    } elseif ($enclose === false) {
                        $content = $itemLabel;
                    } elseif ($url === '') {
                        $content = CustomTag::name('h6')
                            ->class($this->itemHeaderCssClass)
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
                    $submenuAttributes = isset($item['submenuAttributes']) && is_array($item['submenuAttributes'])
                        ? array_merge($this->submenuAttributes, $item['submenuAttributes']) : $this->submenuAttributes;

                    $lines[] = self::widget()
                        ->attributes($this->attributes)
                        ->dividerCssClass($this->dividerCssClass)
                        ->itemCssClass($this->itemCssClass)
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
                    ->content(CustomTag::name('i')
                        ->class($iconCssClass)
                        ->content($iconText)
                        ->encode(false)
                        ->render())
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
                ->content(CustomTag::name('i')
                    ->class($iconCssClass)
                    ->content($iconText)
                    ->encode(false)
                    ->render())
                ->encode(false)
                ->render();
        }

        if ($label !== '') {
            $html .= $label;
        }

        return $html;
    }
}
