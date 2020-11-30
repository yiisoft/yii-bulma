<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function strpos;

/**
 * The navbar component is a responsive and versatile horizontal navigation bar.
 *
 * @link https://bulma.io/documentation/components/navbar/
 */
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
        'role' => 'button',
    ];

    public function begin(): ?string
    {
        parent::begin();

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
     * @return self
     */
    public function brand(string $value): self
    {
        $new = clone $this;
        $new->brand = $value;
        return $new;
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
        $new = clone $this;
        $new->brandLabel = $value;
        return $new;
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
        $new = clone $this;
        $new->brandImage = $value;
        return $new;
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
        $new = clone $this;
        $new->brandUrl = $value;
        return $new;
    }

    /**
     * Set toggle icon.
     *
     * @param string $value.
     *
     * @return self
     */
    public function toggleIcon(string $value): self
    {
        $new = clone $this;
        $new->toggleIcon = $value;
        return $new;
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
        $new = clone $this;
        $new->options = $value;
        return $new;
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
    public function brandOptions(array $value): self
    {
        $new = clone $this;
        $new->brandOptions = $value;
        return $new;
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
    public function brandLabelOptions(array $value): self
    {
        $new = clone $this;
        $new->brandLabelOptions = $value;
        return $new;
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
    public function brandImageOptions(array $value): self
    {
        $new = clone $this;
        $new->brandImageOptions = $value;
        return $new;
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
    public function itemsOptions(array $value): self
    {
        $new = clone $this;
        $new->itemsOptions = $value;
        return $new;
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
    public function menuOptions(array $value): self
    {
        $new = clone $this;
        $new->menuOptions = $value;
        return $new;
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
    public function toggleOptions(array $value): self
    {
        $new = clone $this;
        $new->toggleOptions = $value;
        return $new;
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
