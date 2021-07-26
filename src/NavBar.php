<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function is_bool;
use function is_string;
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
        $this->checkNavTag($navTag);

        return
            (is_string($navTag) ? Html::openTag($navTag, $navOptions) : '') . "\n" .
            $this->brand . "\n" .
            Html::openTag('div', $this->menuOptions) .
            Html::openTag('div', $this->itemsOptions);
    }

    protected function run(): string
    {
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        $this->checkNavTag($tag);

        return
            Html::closeTag('div') . "\n" .
            Html::closeTag('div') . "\n" .
            (is_string($tag) ? Html::closeTag($tag) : '');
    }

    /**
     * @param mixed $navTag
     */
    private function checkNavTag($navTag): void
    {
        if (
            (!is_string($navTag) || $navTag === '') &&
            !is_bool($navTag) &&
            $navTag !== null
        ) {
            throw new InvalidArgumentException('Tag should be either non empty string, bool or null.');
        }
    }

    /**
     * Returns a new instance with the specified HTML code of brand.
     *
     * @param string $value The HTML code of brand.
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
     * Returns a new instance with the specified brand label.
     *
     * @param string $value The text of the brand label or empty if it's not used. Note that this is not HTML-encoded.
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
     * Returns a new instance with the specified brand image.
     *
     * @param string $value The image of the brand or empty if it's not used.
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
     * Returns a new instance with the specified brand URL.
     *
     * @param string $value The URL for the brand's hyperlink tag and will be used for the "href" attribute of the
     * brand link. Default value is '/' will be used. You may set it to `null` if you want to have no link at all.
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
     * Returns a new instance with the specified toggle icon.
     *
     * @param string $value The toggle icon.
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
     * Returns a new instance with the specified options HTML attributes for the tag nav.
     *
     * @param array $value The options HTML attributes for the tag nav.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options HTML attributes of the tag div brand.
     *
     * @param array $value The options HTML attributes of the tag div brand. Default value `navbar-item`.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function brandOptions(array $value): self
    {
        $new = clone $this;
        $new->brandOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options HTML attributes of the tag div brand label.
     *
     * @param array $value The options HTML attributes of the tag div brand label. Default value `navbar-item`.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function brandLabelOptions(array $value): self
    {
        $new = clone $this;
        $new->brandLabelOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options HTML attributes of the tag div brand image.
     *
     * @param array $value The options HTML attributes of the tag div brand image. Default value `navbar-item`.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function brandImageOptions(array $value): self
    {
        $new = clone $this;
        $new->brandImageOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options HTML attributes of the tag div items nav.
     *
     * @param array $value The options HTML attributes of the tag div items nav, values `navbar-start`, `navbar-end`.
     * Default value `navbar-start`.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function itemsOptions(array $value): self
    {
        $new = clone $this;
        $new->itemsOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options HTML attributes of the tag div nav menu.
     *
     * @param array $value The options HTML attributes of the tag div nav menu. Default value `navbar-menu`.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function menuOptions(array $value): self
    {
        $new = clone $this;
        $new->menuOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes of the navbar toggler button.
     *
     * @param array $value The HTML attributes of the navbar toggler button.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
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
            $this->brand = Html::openTag('div', $this->brandOptions);

            if ($this->brandImage !== '' && $this->brandLabel !== '') {
                $this->brand .= Html::tag(
                    'span',
                    Html::img($this->brandImage)->render(),
                    $this->brandImageOptions
                )->encode(false);
            }

            if ($this->brandImage !== '' && $this->brandLabel === '') {
                $this->brand .= Html::a(
                    Html::img($this->brandImage)->render(),
                    $this->brandUrl,
                    $this->brandImageOptions
                )->encode(false);
            }

            if ($this->brandLabel !== '') {
                $this->brand .= Html::a($this->brandLabel, $this->brandUrl, $this->brandLabelOptions);
            }

            $this->brand .= $this->renderToggleButton();
            $this->brand .= Html::closeTag('div');
        }
    }

    /**
     * Renders collapsible toggle button.
     *
     * @throws JsonException
     *
     * @return string The rendering toggle button.
     */
    private function renderToggleButton(): string
    {
        return
            Html::openTag('a', $this->toggleOptions) .
            $this->renderToggleIcon() .

            Html::closeTag('a');
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
