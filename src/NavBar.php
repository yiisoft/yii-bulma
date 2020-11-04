<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function strpos;

final class NavBar extends Widget
{
    private string $brand = '';
    private string $brandLabel = '';
    private string $brandImage = '';
    private string $brandUrl = '/';
    private string $toggleIcon = '';
    private array $options = [];
    private array $brandOptions = [];
    private array $brandLabelOptions = [];
    private array $brandImageOptions = [];
    private array $itemsOptions = [];
    private array $menuOptions = [];
    private array $toggleOptions = [
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
        if (!is_string($navTag) && !is_bool($navTag) && $navTag !== null) {
            throw new \InvalidArgumentException('Tag should be either string, bool or null.');
        }

        return
            Html::beginTag($navTag, $navOptions) . "\n" .
            $this->brand . "\n" .
            Html::beginTag('div', $this->menuOptions) .
            Html::beginTag('div', $this->itemsOptions);
    }

    protected function run(): string
    {
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        if (!is_string($tag) && !is_bool($tag) && $tag !== null) {
            throw new \InvalidArgumentException('Tag should be either string, bool or null.');
        }

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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function brandUrl(string $value): self
    {
        $this->brandUrl = $value;
        return $this;
    }

    /**
     * Set toggle icon.
     *
     * @param string $value.
     *
     * @return $this
     */
    public function toggleIcon(string $value): self
    {
        $this->toggleIcon = $value;
        return $this;
    }

    /**
     * Options HTML attributes for the tag nav.
     *
     * @param array $value
     *
     * @return $this
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
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandOptions(array $value): self
    {
        $this->brandOptions = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div brand label.
     *
     * @param array $value default value `navbar-item`.
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandLabelOptions(array $value): self
    {
        $this->brandLabelOptions = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div brand link.
     *
     * @param array $value default value `navbar-item`.
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function brandImageOptions(array $value): self
    {
        $this->brandImageOptions = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div items nav, values `navbar-start`, `navbar-end`.
     *
     * @param array $value default value `navbar-start`.
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function itemsOptions(array $value): self
    {
        $this->itemsOptions = $value;
        return $this;
    }

    /**
     * Options HTML attributes of the tag div nav menu.
     *
     * @param array $value default value `navbar-menu`.
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function menuOptions(array $value): self
    {
        $this->menuOptions = $value;
        return $this;
    }

    /**
     * The HTML attributes of the navbar toggler button.
     *
     * @param array $value
     *
     * @return $this
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function toggleOptions(array $value): self
    {
        $this->toggleOptions = $value;
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
        $this->brandOptions = $this->addOptions($this->brandOptions, 'navbar-brand');
        $this->brandLabelOptions = $this->addOptions($this->brandLabelOptions, 'navbar-item');
        $this->brandImageOptions = $this->addOptions($this->brandImageOptions, 'navbar-item');
        $this->menuOptions = $this->addOptions($this->menuOptions, 'navbar-menu');

        $this->menuOptions['id'] = "{$id}-navbar-Menu";

        $this->initItemsOptions();
    }

    private function initItemsOptions(): void
    {
        $itemsClass = '';

        if (isset($this->itemsOptions['class'])) {
            $itemsClass = $this->itemsOptions['class'];
            unset($this->itemsOptions['class']);
            if (is_array($itemsClass)) {
                $itemsClass = implode(' ', $itemsClass);
            }
        }

        /** @var string $itemsClass */
        if (strpos($itemsClass, 'navbar-end') === false) {
            Html::addCssClass($this->itemsOptions, 'navbar-start');
        }

        if (!empty($itemsClass)) {
            Html::addCssClass($this->itemsOptions, $itemsClass);
        }
    }

    private function renderBrand(): void
    {
        if ($this->brand === '') {
            $this->brand = Html::beginTag('div', $this->brandOptions);

            if ($this->brandImage !== '' && $this->brandLabel !== '') {
                $this->brand .= Html::tag('span', Html::img($this->brandImage), $this->brandImageOptions);
            }

            if ($this->brandImage !== '' && $this->brandLabel === '') {
                $this->brand .= Html::a(Html::img($this->brandImage), $this->brandUrl, $this->brandImageOptions);
            }

            if ($this->brandLabel !== '') {
                $this->brand .= Html::a($this->brandLabel, $this->brandUrl, $this->brandLabelOptions);
            }

            $this->brand .= $this->renderToggleButton();
            $this->brand .= Html::endTag('div');
        }
    }

    /**
     * Renders collapsible toggle button.
     *
     * @throws JsonException
     *
     * @return string the rendering toggle button.
     */
    private function renderToggleButton(): string
    {
        return
            Html::beginTag('a', $this->toggleOptions) .
                $this->renderToggleIcon() .

            Html::endTag('a');
    }

    /**
     * Render icon toggle.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderToggleIcon(): string
    {
        if ($this->toggleIcon === '') {
            $this->toggleIcon = Html::tag('span', '', ['aria-hidden' => 'true']) .
                Html::tag('span', '', ['aria-hidden' => 'true']) .
                Html::tag('span', '', ['aria-hidden' => 'true']);
        }

        return $this->toggleIcon;
    }
}
