<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Img;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the {@see begin()} and {@see end()} calls of NavBar is treated as the content of the
 * navbar. You may use widgets such as {@see Nav} to build up such content. For example,
 *
 * @link https://bulma.io/documentation/components/navbar/
 */
final class NavBar extends Widget
{
    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private array $brandAttributes = [];
    private string $brandImage = '';
    private array $brandImageAttributes = [];
    private string $brandText = '';
    private array $brandTextAttributes = [];
    private string $brandUrl = '/';
    private string $buttonLinkAriaExpanded = 'false';
    private string $buttonLinkAriaLabelText = 'menu';
    private string $buttonLinkContent = '';
    private string $buttonLinkRole = 'button';
    private string $navBarAriaLabel = 'main navigation';
    private string $navBarBrandCssClass = 'navbar-brand';
    private array $navBarBurgerAttributes = [];
    private string $navBarBurgerCssClass = 'navbar-burger';
    private string $navBarCssClass = 'navbar';
    private string $navBarItemCssClass = 'navbar-item';
    private string $navBarRole = 'navigation';

    public function begin(): string
    {
        parent::begin();
        return $this->renderNavBar();
    }

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
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
     * The HTML attributes of the navbar brand.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandAttributes(array $values): self
    {
        $new = clone $this;
        $new->brandAttributes = $values;
        return $new;
    }

    /**
     * Src of the brand image or empty if it's not used. Note that this param will override `$this->brandText` param.
     *
     * @param string $value The src of the brand image.
     *
     * @return self
     */
    public function brandImage(string $value): self
    {
        $new = clone $this;
        $new->brandImage = $value;
        return $new;
    }

    /**
     * The HTML attributes of the brand image.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandImageAttributes(array $values): self
    {
        $new = clone $this;
        $new->brandImageAttributes = $values;
        return $new;
    }

    /**
     * The text of the brand or empty if it's not used. Note that this is not HTML-encoded.
     *
     * @param string $value The text of the brand.
     *
     * @return self
     */
    public function brandText(string $value): self
    {
        $new = clone $this;
        $new->brandText = $value;
        return $new;
    }

    /**
     * The HTML attributes of the brand text.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandTextAttributes(array $values): self
    {
        $new = clone $this;
        $new->brandTextAttributes = $values;
        return $new;
    }

    /**
     * The URL for the brand's hyperlink tag and will be used for the "href" attribute of the brand link. Default value
     * is "/". You may set it to empty string if you want no link at all.
     *
     * @param string $value
     *
     * @return self
     */
    public function brandUrl(string $value): self
    {
        $new = clone $this;
        $new->brandUrl = $value;
        return $new;
    }

    /**
     * The ARIA expanded attribute of the button link.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLinkAriaExpanded(string $value): self
    {
        $new = clone $this;
        $new->buttonLinkAriaExpanded = $value;
        return $new;
    }

    /**
     * The ARIA label text of the button link.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLinkAriaLabelText(string $value): self
    {
        $new = clone $this;
        $new->buttonLinkAriaLabelText = $value;
        return $new;
    }

    /**
     * The content of the button link.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLinkContent(string $value): self
    {
        $new = clone $this;
        $new->buttonLinkContent = $value;
        return $new;
    }

    /**
     * The role of the button link.
     *
     * @param string $value
     *
     * @return self
     */
    public function buttonLinkRole(string $value): self
    {
        $new = clone $this;
        $new->buttonLinkRole = $value;
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
     * The ARIA label of the navbar.
     *
     * @param string $value
     *
     * @return self
     */
    public function navBarAriaLabel(string $value): self
    {
        $new = clone $this;
        $new->navBarAriaLabel = $value;
        return $new;
    }

    /**
     * The CSS class of the brand.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function navBarBrandCssClass(string $value): self
    {
        $new = clone $this;
        $new->navBarBrandCssClass = $value;
        return $new;
    }

    /**
     * The HTML attributes of the burger.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function navBarBurgerAttributes(array $values): self
    {
        $new = clone $this;
        $new->navBarBurgerAttributes = $values;
        return $new;
    }

    /**
     * The CSS class of the burger.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function navBarBurgerCssClass(string $value): self
    {
        $new = clone $this;
        $new->navBarBurgerCssClass = $value;
        return $new;
    }

    /**
     * The CSS class of the navbar.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function navBarCssClass(string $value): self
    {
        $new = clone $this;
        $new->navBarCssClass = $value;
        return $new;
    }

    /**
     * The CSS class of the items navbar.
     *
     * @param string $value The CSS class.
     *
     * @return self
     */
    public function navBarItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->navBarItemCssClass = $value;
        return $new;
    }

    /**
     * The role of the navbar.
     *
     * @param string $value
     *
     * @return self
     */
    public function navBarRole(string $value): self
    {
        $new = clone $this;
        $new->navBarRole = $value;
        return $new;
    }

    protected function run(): string
    {
        return Html::closeTag('nav');
    }

    private function renderNavBar(): string
    {
        $attributes = $this->attributes;
        Html::addCssClass($attributes, $this->navBarCssClass);

        if (!isset($attributes['id'])) {
            $attributes['id'] = Html::generateId($this->autoIdPrefix) . '-navbar';
        }

        $attributes['aria-label'] = $this->navBarAriaLabel;
        $attributes['role'] = $this->navBarRole;

        return Html::openTag('nav', $attributes) . PHP_EOL . $this->renderNavBarBrand() . PHP_EOL;
    }

    private function renderNavBarBrand(): string
    {
        $brand = '';
        $brandImage = '';

        if ($this->brandImage !== '') {
            $brandImage = Img::tag()->attributes($this->brandImageAttributes)->url($this->brandImage)->render();
            $brand = PHP_EOL . A::tag()
                ->class($this->navBarItemCssClass)
                ->content($brandImage)
                ->encode(false)
                ->url($this->brandUrl)
                ->render();
        }

        if ($this->brandText !== '') {
            $brandText = $this->brandText;

            if ($brandImage !== '') {
                $brandText = $brandImage . $this->brandText;
            }

            if (empty($this->brandUrl)) {
                $brand = PHP_EOL . Span::tag()
                    ->attributes($this->brandTextAttributes)
                    ->class($this->navBarItemCssClass)
                    ->content($brandText)
                    ->render();
            } else {
                $brand = PHP_EOL . A::tag()
                    ->class($this->navBarItemCssClass)
                    ->content($brandText)
                    ->encode(false)
                    ->url($this->brandUrl)
                    ->render();
            }
        }

        $brand .= $this->renderNavBarBurger();

        return Div::tag()
            ->attributes($this->brandAttributes)
            ->class($this->navBarBrandCssClass)
            ->content($brand)
            ->encode(false)
            ->render();
    }

    /**
     * Renders collapsible toggle button.
     *
     * @return string the rendering navbar burger link button.
     *
     * @link https://bulma.io/documentation/components/navbar/#navbar-burger
     */
    private function renderNavBarBurger(): string
    {
        $navBarBurgerAttributes = $this->navBarBurgerAttributes;
        if ($this->buttonLinkContent === '') {
            $this->buttonLinkContent = PHP_EOL .
                Span::tag()->attributes(['aria-hidden' => 'true'])->render() . PHP_EOL .
                Span::tag()->attributes(['aria-hidden' => 'true'])->render() . PHP_EOL .
                Span::tag()->attributes(['aria-hidden' => 'true'])->render() . PHP_EOL;
        }

        $navBarBurgerAttributes['aria-expanded'] = $this->buttonLinkAriaExpanded;
        $navBarBurgerAttributes['aria-label'] = $this->buttonLinkAriaLabelText;
        $navBarBurgerAttributes['role'] = $this->buttonLinkRole;

        return PHP_EOL . A::tag()
            ->attributes($navBarBurgerAttributes)
            ->class($this->navBarBurgerCssClass)
            ->content($this->buttonLinkContent)
            ->encode(false)
            ->render() . PHP_EOL;
    }
}
