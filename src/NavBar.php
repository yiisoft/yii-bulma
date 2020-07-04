<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class NavBar extends Widget
{
    private string $brand = '';
    private string $brandLabel = '';
    private string $brandImage = '';
    private string $brandUrl = '/';
    private string $iconToggle = '';
    private array $options = [];
    private array $optionsBrand = [];
    private array $optionsBrandLabel = [];
    private array $optionsBrandImage = [];
    private array $optionsItems = [];
    private array $optionsMenu = [];
    private array $optionsToggle = [
        'aria-expanded' => 'false',
        'aria-label' => 'menu',
        'class' => 'navbar-burger',
        'role' => 'button'
    ];

    public function start(): string
    {
        $this->buildOptions();
        $this->renderBrand();

        $navOptions = $this->options;
        $navTag = ArrayHelper::remove($navOptions, 'tag', 'nav');

        return
            Html::beginTag($navTag, $navOptions) . "\n" .
            $this->brand . "\n" .
            Html::beginTag('div', $this->optionsMenu) .
            Html::beginTag('div', $this->optionsItems);
    }

    protected function run(): string
    {
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');

        return
            Html::endTag('div') . "\n" .
            Html::endTag('div') . "\n" .
            Html::endTag($tag);
    }

    /**
     * Set render brand custom, {@see brandLabel} and {@see brandImage} are not generated.
     *
     * @param string $value
     *
     * @return self
     */
    public function brand(string $value): self
    {
        $this->brand = $value;
        return $this;
    }

    /**
     * The text of the brand label or empty if it's not used. Note that this is not HTML-encoded.
     *
     * @param string $value
     *
     * @return self
     */
    public function brandLabel(string $value): self
    {
        $this->brandLabel = $value;
        return $this;
    }

    /**
     * The image of the brand or empty if it's not used.
     *
     * @param string $value
     *
     * @return self
     */
    public function brandImage(string $value): self
    {
        $this->brandImage = $value;
        return $this;
    }

    /**
     * The URL for the brand's hyperlink tag and will be used for the "href" attribute of the brand link. Default value
     * is '/' will be used. You may set it to `null` if you want to have no link at all.
     *
     * @param string $value
     *
     * @return self
     */
    public function brandUrl(string $value): self
    {
        $this->brandUrl = $value;
        return $this;
    }

    /**
     * Set icon toggle.
     *
     * @param string $value.
     *
     * @return self
     */
    public function iconToggle(string $value): self
    {
        $this->iconToggle = $value;
        return $this;
    }

    /**
     * Options HTML attributes for the tag nav.
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
     * Options HTML attributes of the tag div brand.
     *
     * @param array $value default value `navbar-item`.
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsBrand(array $value): self
    {
        $this->optionsBrand = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div brand label.
     *
     * @param array $value default value `navbar-item`.
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsBrandLabel(array $value): self
    {
        $this->optionsBrandLabel = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div brand link.
     *
     * @param array $value default value `navbar-item`.
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsBrandImage(array $value): self
    {
        $this->optionsBrandImage = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div items nav, values `navbar-start`, `navbar-end`.
     *
     * @param array $value default value `navbar-start`.
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
     * Options HTML attributes of the tag div nav menu.
     *
     * @param array $value default value `navbar-menu`.
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsMenu(array $value): self
    {
        $this->optionsMenu = $value;
        return $this;
    }

    /**
     * The HTML attributes of the navbar toggler button.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function optionsToggle(array $value): self
    {
        $this->optionsToggle = $value;
        return $this;
    }

    private function buildOptions(): void
    {
        $id = '';

        if (!isset($this->options['id'])) {
            $id = $this->getId();
            $this->options['id'] = "{$id}-navbar";
        }

        $this->options = $this->addOptions($this->options, 'navbar');
        $this->optionsBrand = $this->addOptions($this->optionsBrand, 'navbar-brand');
        $this->optionsBrandLabel = $this->addOptions($this->optionsBrandLabel, 'navbar-item');
        $this->optionsBrandImage = $this->addOptions($this->optionsBrandImage, 'navbar-item');
        $this->optionsMenu = $this->addOptions($this->optionsMenu, 'navbar-menu');

        $this->optionsMenu['id'] = "{$id}-navbar-Menu";

        $this->initOptionsItems();
    }

    private function initOptionsItems(): void
    {
        $optionsItems = '';

        if (isset($this->optionsItems['class'])) {
            $optionsItems = $this->optionsItems['class'];

            unset($this->optionsItems['class']);
        }

        if (!strstr($optionsItems, 'navbar-end')) {
            Html::addCssClass($this->optionsItems, 'navbar-start');
        }

        if (!empty($optionsItems)) {
            Html::addCssClass($this->optionsItems, $optionsItems);
        }
    }

    private function renderBrand(): void
    {
        if ($this->brand === '') {
            $this->brand = Html::beginTag('div', $this->optionsBrand);

            if ($this->brandImage !== '' && $this->brandLabel !== '') {
                $this->brand .= Html::tag('span', Html::img($this->brandImage), $this->optionsBrandImage);
            }

            if ($this->brandImage !== '' && $this->brandLabel === '') {
                $this->brand .= Html::a(Html::img($this->brandImage), $this->brandUrl, $this->optionsBrandImage);
            }

            if ($this->brandLabel !== '') {
                $this->brand .= Html::a($this->brandLabel, $this->brandUrl, $this->optionsBrandLabel);
            }

            $this->brand .= $this->renderToggleButton();
            $this->brand .= Html::endTag('div');
        }
    }

    /**
     * Renders collapsible toggle button.
     *
     * @return string the rendering toggle button.
     */
    private function renderToggleButton(): string
    {
        return
            Html::beginTag('a', $this->optionsToggle) .
                $this->renderIconToggle() .

            Html::endTag('a');
    }

    /**
     * Render icon toggle.
     *
     * @return string
     */
    private function renderIconToggle(): string
    {
        if ($this->iconToggle === '') {
            $this->iconToggle = Html::tag('span', '', ['aria-hidden' => 'true']) .
                Html::tag('span', '', ['aria-hidden' => 'true']) .
                Html::tag('span', '', ['aria-hidden' => 'true']);
        }

        return $this->iconToggle;
    }
}
