<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_merge;
use function array_values;
use function call_user_func;
use function count;
use function implode;
use function strtr;

/**
 * The Bulma menu is a vertical navigation component.
 *
 * @link https://bulma.io/documentation/components/menu/
 */
final class Menu extends Widget
{
    private string $activeCssClass = 'is-active';
    private bool $activateItems = true;
    private bool $activateParents = false;
    private string $brand = '';
    private string $currentPath = '';
    private string $firstItemCssClass = '';
    private array $items = [];
    private array $itemOptions = [];
    private array $itemsOptions = [];
    private string $lastItemCssClass = '';
    private string $linkTemplate = '<a href={url}>{icon}{label}</a>';
    private string $labelTemplate = '{label}';
    private bool $encodeLabels = true;
    private bool $hideEmptyItems = true;
    private array $options = [];
    private string $subMenuTemplate = "<ul class = menu-list>\n{items}\n</ul>";

    /**
     * Renders the menu.
     *
     * @return string the result of Widget execution to be outputted.
     */
    protected function run(): string
    {
        $this->items = $this->normalizeItems($this->items, $hasActiveChild);

        if (empty($this->items)) {
            return '';
        }

        $this->buildOptions();

        return $this->buildMenu();
    }

    /**
     * Whether to automatically activate items according to whether their route setting matches the currently requested
     * route.
     *
     * @var bool
     *
     * @return self
     *
     * {@see isItemActive()}
     */
    public function activateItems(bool $value): self
    {
        $new = clone $this;
        $new->activateItems = $value;
        return $new;
    }

    /**
     * Whether to activate parent menu items when one of the corresponding child menu items is active. The activated
     * parent menu items will also have its CSS classes appended with {@see activeCssClass}.
     *
     * @param bool $value
     *
     * @return self
     */
    public function activateParents(bool $value): self
    {
        $new = clone $this;
        $new->activateParents = $value;
        return $new;
    }

    /**
     * The CSS class to be appended to the active menu item.
     *
     * @var string
     *
     * @return self
     */
    public function activeCssClass(string $value): self
    {
        $new = clone $this;
        $new->activeCssClass = $value;
        return $new;
    }

    /**
     * Set render brand custom.
     *
     * @param string $value
     *
     * @return self
     */
    public function brand(string $value): self
    {
        $new = clone $this;
        $new->brand = $value;
        return $new;
    }

    /**
     * Allows you to assign the current path of the url from request controller.
     *
     * @param string $value
     *
     * @return self
     */
    public function currentPath(string $value): self
    {
        $new = clone $this;
        $new->currentPath = $value;
        return $new;
    }

    /**
     * Whether the labels for menu items should be HTML-encoded.
     *
     * @param bool $value
     *
     * @return self
     */
    public function encodeLabels(bool $value): self
    {
        $new = clone $this;
        $new->encodeLabels = $value;
        return $new;
    }

    /**
     * The CSS class that will be assigned to the first item in the main menu or each submenu. Defaults to null,
     * meaning no such CSS class will be assigned.
     *
     * @var string
     *
     * @return self
     */
    public function firstItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->firstItemCssClass = $value;
        return $new;
    }

    /**
     * Whether to hide empty menu items. An empty menu item is one whose `url` option is not set and which has no
     * visible child menu items.
     *
     * @var bool
     *
     * @return self
     */
    public function hideEmptyItems(bool $value): self
    {
        $new = clone $this;
        $new->hideEmptyItems = $value;
        return $new;
    }

    /**
     * List of menu items.
     *
     * Each menu item should be an array of the following structure:
     *
     * - label: string, optional, specifies the menu item label. When {@see encodeLabels} is true, the label will be
     *   HTML-encoded. If the label is not specified, an empty string will be used.
     * - encode: bool, optional, whether this item`s label should be HTML-encoded. This param will override global
     *   {@see encodeLabels} param.
     * - url: string or array, optional, specifies the URL of the menu item. When this is set, the actual menu item
     *   content will be generated using {@see linkTemplate}; otherwise, {@see labelTemplate} will be used.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - items: array, optional, specifies the sub-menu items. Its format is the same as the parent items.
     * - active: bool or Closure, optional, whether this menu item is in active state (currently selected). When
     *   using a closure, its signature should be `function ($item, $hasActiveChild, $isItemActive, $Widget)`. Closure
     *   must return `true` if item should be marked as `active`, otherwise - `false`. If a menu item is active, its CSS
     *   class will be appended with {@see activeCssClass}. If this option is not set, the menu item will be set active
     *   automatically when the current request is triggered by `url`. For more details, please refer to
     *   {@see isItemActive()}.
     * - template: string, optional, the template used to render the content of this menu item. The token `{url}` will
     *   be replaced by the URL associated with this menu item, and the token `{label}` will be replaced by the label
     *   of the menu item. If this option is not set, {@see linkTemplate} or {@see labelTemplate} will be used instead.
     * - subMenuTemplate: string, optional, the template used to render the list of sub-menus. The token `{items}` will
     *   be replaced with the rendered sub-menu items. If this option is not set, {@see subMenuTemplate} will be used
     *   instead.
     * - options: array, optional, the HTML attributes for the menu container tag.
     * - icon: string, optional, class icon.
     * - iconOptions: array, optional, the HTML attributes for the container icon.
     *
     * @param array $value
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
     * List of HTML attributes shared by all menu {@see items}.
     *
     * If any individual menu item specifies its  `options`, it will be merged with this property before being used to
     * generate the HTML attributes for the menu item tag. The following special options are recognized:
     *
     * - tag: string, defaults to "li", the tag name of the item container tags. Set to false to disable container tag.
     *   See also {@see \Yiisoft\Html\Html::tag()}
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes() for details on how attributes are being rendered}
     */
    public function itemOptions(array $value): self
    {
        $new = clone $this;
        $new->itemOptions = $value;
        return $new;
    }

    /**
     * The template used to render the body of a menu which is NOT a link.
     *
     * In this template, the token `{label}` will be replaced with the label of the menu item.
     *
     * This property will be overridden by the `template` option set in individual menu items via {@see items}.
     *
     * @param string $value
     *
     * @return self
     */
    public function labelTemplate(string $value): self
    {
        $new = clone $this;
        $new->labelTemplate = $value;
        return $new;
    }

    /**
     * The CSS class that will be assigned to the last item in the main menu or each submenu. Defaults to null, meaning
     * no such CSS class will be assigned.
     *
     * @param string $value
     *
     * @return self
     */
    public function lastItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->lastItemCssClass = $value;
        return $new;
    }

    /**
     * The template used to render the body of a menu which is a link. In this template, the token `{url}` will be
     * replaced with the corresponding link URL; while `{label}` will be replaced with the link text.
     *
     * This property will be overridden by the `template` option set in individual menu items via {@see items}.
     *
     * @param string $value
     *
     * @return self
     */
    public function linkTemplate(string $value): self
    {
        $new = clone $this;
        $new->linkTemplate = $value;
        return $new;
    }

    /**
     * The HTML attributes for the menu's container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "ul", the tag name of the item container tags. Set to false to disable container tag.
     *   See also {@see \Yiisoft\Html\Html::tag()}.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;
        return $new;
    }

    /**
     * The template used to render a list of sub-menus.
     *
     * In this template, the token `{items}` will be replaced with the rendered sub-menu items.
     *
     * @param string $value
     *
     * @return self
     */
    public function subMenuTemplate(string $value): self
    {
        $new = clone $this;
        $new->subMenuTemplate = $value;
        return $new;
    }

    private function renderItems(array $items): string
    {
        $n = count($items);
        $lines = [];

        foreach ($items as $i => $item) {
            $class = [];
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');


            if ($item['active']) {
                $linkOptions = $this->addOptions($linkOptions, $this->activeCssClass);
            }

            if ($i === 0 && $this->firstItemCssClass !== '') {
                $class[] = $this->firstItemCssClass;
            }

            if ($i === $n - 1 && $this->lastItemCssClass !== '') {
                $class[] = $this->lastItemCssClass;
            }

            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item, $linkOptions);

            if (!empty($item['items'])) {
                $subMenuTemplate = ArrayHelper::getValue($item, 'subMenuTemplate', $this->subMenuTemplate);
                $menu .= strtr($subMenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }

            if (isset($item['label']) && !isset($item['url'])) {
                if (!empty($menu)) {
                    $lines[] = $menu;
                } else {
                    $lines[] = $item['label'];
                }
            } else {
                $lines[] = Html::tag($tag, $menu, $options);
            }
        }

        return implode("\n", $lines);
    }

    private function renderItem(array $item, array $linkOptions): string
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            $htmlIcon = '';

            if (isset($item['icon'])) {
                $htmlIcon = $this->renderIcon($item['icon'], $item['iconOptions']);
            }

            if (Html::renderTagAttributes($linkOptions) !== '') {
                $url = '"' . Html::encode($item['url']) . '"' . Html::renderTagAttributes($linkOptions);
            } else {
                $url = '"' . Html::encode($item['url']) . '"';
            }
            return strtr($template, [
                '{url}' => $url,
                '{label}' => $item['label'],
                '{icon}' => $htmlIcon,
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => Html::tag('p', $item['label'], ['class' => 'menu-label']) . "\n",
        ]);
    }

    private function normalizeItems(array $items, ?bool &$active): array
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
            } else {
                $item['label'] = $item['label'] ?? '';
                $encodeLabel = $item['encode'] ?? $this->encodeLabels;
                $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
                $hasActiveChild = false;

                if (isset($item['items'])) {
                    $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                    if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                        unset($items[$i]['items']);
                        if (!isset($item['url'])) {
                            unset($items[$i]);
                            continue;
                        }
                    }
                }

                if (!isset($item['active'])) {
                    if (($this->activateParents && $hasActiveChild) || ($this->activateItems && $this->isItemActive($item))) {
                        $active = $items[$i]['active'] = true;
                    } else {
                        $items[$i]['active'] = false;
                    }
                } elseif (is_callable($item['active'])) {
                    $active = $items[$i]['active'] = call_user_func($item['active'], $item, $hasActiveChild, $this->isItemActive($item), $this);
                } elseif ($item['active']) {
                    $active = $item['active'];
                }
            }
        }

        return array_values($items);
    }

    private function isItemActive(array $item): bool
    {
        return isset($item['url']) && $item['url'] === $this->currentPath && $this->activateItems;
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

    private function buildOptions(): void
    {
        $this->options = $this->addOptions($this->options, 'menu');
        $this->itemsOptions = $this->addOptions($this->itemsOptions, 'menu-list');
    }

    private function buildMenu(): string
    {
        $tag = ArrayHelper::remove($this->options, 'tag', 'ul');
        $html = Html::beginTag('aside', $this->options) . "\n";

        if ($this->brand !== '') {
            $html .= $this->brand . "\n";
        }

        $html .= Html::beginTag($tag, $this->itemsOptions) . "\n";
        $html .=  $this->renderItems($this->items) . "\n";
        $html .= Html::endTag($tag) . "\n";
        $html .= Html::endTag('aside');

        return $html;
    }
}
