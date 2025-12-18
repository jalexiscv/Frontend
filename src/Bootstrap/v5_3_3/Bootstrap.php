<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3;

use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Alert;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Badge;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\ButtonGroup;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\CardGroup;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Carousel;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Dropdown;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\ListGroup;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Modal;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Offcanvas;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Popover;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Progress;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Spinner;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Toast;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Tooltip;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Grid;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Content\Table;
use Higgs\Frontend\Bootstrap\v5_3_3\Content\Typography;
use Higgs\Frontend\Bootstrap\v5_3_3\Content\Image;
use Higgs\Frontend\Bootstrap\v5_3_3\Navigation\Breadcrumb;
use Higgs\Frontend\Bootstrap\v5_3_3\Navigation\Nav;
use Higgs\Frontend\Bootstrap\v5_3_3\Navigation\Navbar;
use Higgs\Frontend\Bootstrap\v5_3_3\Navigation\Pagination;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Check;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\FormControl;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\InputGroup;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Collapse;
use Higgs\Frontend\Bootstrap\v5_3_3\Content\Figure;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Form;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Input;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Select;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Radio;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\File;
use Higgs\Frontend\Bootstrap\v5_3_3\Form\Textarea;

/**
 * Fachada para los componentes de Bootstrap 5
 */
class Bootstrap
{
    /**
     * Crea una alerta
     */
    public static function alert(
        string $content,
        string $type = 'primary',
        bool   $dismissible = false,
        array  $attributes = []
    ): TagInterface {
        return (new Alert($content, $type, $dismissible, $attributes))->render();
    }

    /**
     * Crea una alerta de éxito
     */
    public static function successAlert(
        string $content,
        bool   $dismissible = false,
        array  $attributes = []
    ): TagInterface {
        return Alert::success($content, $dismissible, $attributes)->render();
    }

    /**
     * Crea una tarjeta
     * 
     * @param string|null $title Título de la tarjeta
     * @param string|null $content Contenido de la tarjeta
     * @param string|null $footer Pie de la tarjeta
     * @param string|null $imageUrl URL de la imagen
     * @param array $attributes Atributos HTML adicionales
     * @return TagInterface
     */
    public static function card(
        ?string $title = null,
        ?string $content = null,
        ?string $footer = null,
        ?string $imageUrl = null,
        array   $attributes = []
    ): TagInterface {
        // Construir array de opciones
        $options = [];

        if ($title !== null) {
            $options['title'] = $title;
        }

        if ($content !== null) {
            $options['content'] = $content;
        }

        if ($footer !== null) {
            $options['footer'] = $footer;
        }

        if ($imageUrl !== null) {
            $options['image'] = $imageUrl;
        }

        if (!empty($attributes)) {
            $options['attributes'] = $attributes;
        }

        return (new Card($options))->render();
    }

    /**
     * Crea una tarjeta horizontal
     */
    public static function horizontalCard(
        string $imageUrl,
        string $title,
        string $content,
        array  $attributes = []
    ): TagInterface {
        return Card::horizontal($imageUrl, $title, $content, $attributes)->render();
    }

    /**
     * Crea un botón
     */
    public static function button(
        string $content = '',
        string $variant = 'primary',
        array  $attributes = []
    ): TagInterface {
        // Aseguramos que la clase btn-{variant} esté presente
        $classes = ['btn', "btn-{$variant}"];

        if (isset($attributes['class'])) {
            if (is_string($attributes['class'])) {
                $classes = array_merge($classes, explode(' ', trim($attributes['class'])));
            } elseif (is_array($attributes['class'])) {
                $classes = array_merge($classes, $attributes['class']);
            }
        }

        $attributes['class'] = implode(' ', array_unique($classes));

        return (new Button($content, $attributes))->render();
    }

    /**
     * Crea un grupo de botones
     */
    public static function buttonGroup(
        array $buttons = [],
        array $attributes = []
    ): TagInterface {
        $group = new ButtonGroup($attributes);
        $group->addButtons($buttons);
        return $group->render();
    }

    /**
     * Crea un badge
     */
    public static function badge(
        string $content,
        string $variant = 'primary',
        array  $attributes = []
    ): TagInterface {
        return (new Badge($content, $attributes, ['variant' => $variant]))->render();
    }

    /**
     * Crea un breadcrumb
     */
    public static function breadcrumb(
        array $items = [],
        array $attributes = []
    ): TagInterface {
        return (new Breadcrumb($items, $attributes))->render();
    }

    /**
     * Crea un carousel
     */
    public static function carousel(
        string $id,
        array  $slides = [],
        array  $attributes = []
    ): TagInterface {
        return (new Carousel($id, $slides, $attributes))->render();
    }

    /**
     * Crea un collapse
     */
    public static function collapse(
        string $id,
        string $content = '',
        array  $attributes = []
    ): TagInterface {
        return (new Collapse($id, $content, $attributes))->render();
    }

    /**
     * Crea un dropdown
     */
    public static function dropdown(
        string $label = '',
        array  $items = [],
        array  $attributes = []
    ): TagInterface {
        return (new Dropdown($label, $items, $attributes))->render();
    }

    /**
     * Crea un form
     */
    public static function form(
        array $attributes = []
    ): TagInterface {
        return (new Form($attributes))->render();
    }

    /**
     * Crea un input
     */
    public static function input(
        string $type = 'text',
        string $name = '',
        array  $attributes = []
    ): TagInterface {
        return (new Input($type, $name, $attributes))->render();
    }

    /**
     * Crea un select
     */
    public static function select(
        string $name,
        array  $options = [],
        array  $attributes = []
    ): TagInterface {
        return (new Select($name, $options, $attributes))->render();
    }

    /**
     * Crea un checkbox
     */
    public static function check(
        string $name,
        string $label = '',
        array  $attributes = []
    ): TagInterface {
        return (new Check($name, $label, $attributes))->render();
    }

    /**
     * Crea un radio
     */
    public static function radio(
        string $name,
        array  $attributes = []
    ): TagInterface {
        return (new Radio($name, $attributes))->render();
    }

    /**
     * Crea un file input
     */
    public static function file(
        string $name,
        array  $attributes = []
    ): TagInterface {
        return (new File($name, $attributes))->render();
    }

    /**
     * Crea un textarea
     */
    public static function textarea(
        string $name,
        array  $attributes = []
    ): TagInterface {
        return (new Textarea($name, $attributes))->render();
    }

    /**
     * Crea un list group
     */
    public static function listGroup(
        array $items = [],
        array $attributes = []
    ): TagInterface {
        return (new ListGroup($items, $attributes))->render();
    }

    /**
     * Crea un modal
     */
    public static function modal(
        string $id,
        string $title = '',
        array  $attributes = []
    ): TagInterface {
        return (new Modal($id, $title, $attributes))->render();
    }

    /**
     * Crea un nav
     */
    public static function nav(
        array $items = [],
        array $attributes = []
    ): TagInterface {
        return (new Nav($items, $attributes))->render();
    }

    /**
     * Crea un navbar
     */
    public static function navbar(
        array $attributes = []
    ): TagInterface {
        return (new Navbar($attributes))->render();
    }

    /**
     * Crea un offcanvas
     */
    public static function offcanvas(
        string $id,
        string $title = '',
        array  $attributes = []
    ): TagInterface {
        return (new Offcanvas($id, $title, $attributes))->render();
    }

    /**
     * Crea una paginación
     */
    public static function pagination(
        int   $total,
        int   $current = 1,
        array $attributes = []
    ): TagInterface {
        return (new Pagination($total, $current, $attributes))->render();
    }

    /**
     * Crea un popover
     */
    public static function popover(
        string $content,
        string $title = '',
        array  $attributes = []
    ): TagInterface {
        return (new Popover($content, $title, $attributes))->render();
    }

    /**
     * Crea un progress
     */
    public static function progress(
        int   $value = 0,
        array $attributes = []
    ): TagInterface {
        return (new Progress($value, $attributes))->render();
    }

    /**
     * Crea un spinner
     */
    public static function spinner(
        string $type = 'border',
        array  $attributes = []
    ): TagInterface {
        return (new Spinner($type, $attributes))->render();
    }

    /**
     * Crea un toast
     */
    public static function toast(
        string $content = '',
        string $title = '',
        array  $attributes = []
    ): TagInterface {
        return (new Toast($content, $title, $attributes))->render();
    }

    /**
     * Crea un tooltip
     */
    public static function tooltip(
        string $content,
        array  $attributes = []
    ): TagInterface {
        return (new Tooltip($content, $attributes))->render();
    }

    /**
     * Crea un container
     */
    public static function container(
        array $attributes = []
    ): TagInterface {
        return (new Container($attributes))->render();
    }

    /**
     * Crea un grid
     */
    public static function grid(
        array $attributes = []
    ): TagInterface {
        return (new Grid($attributes))->render();
    }

    /**
     * Crea una columna
     */
    public static function col(
        string $size = '',
        array  $attributes = []
    ): TagInterface {
        return (new Col($size, $attributes))->render();
    }

    /**
     * Crea una fila
     */
    public static function row(
        array $attributes = []
    ): TagInterface {
        return (new Row($attributes))->render();
    }

    /**
     * Crea una tabla
     */
    public static function table(
        array $attributes = []
    ): TagInterface {
        return (new Table($attributes))->render();
    }

    /**
     * Crea una figura
     */
    public static function figure(
        string $src = '',
        string $caption = '',
        array  $attributes = []
    ): TagInterface {
        return (new Figure($src, $caption, $attributes))->render();
    }

    /**
     * Crea un elemento de tipografía
     */
    public static function typography(
        string $tag = 'p',
        array  $attributes = []
    ): TagInterface {
        return (new Typography($tag, $attributes))->render();
    }

    /**
     * Crea un grupo de tarjetas
     */
    public static function cardGroup(array $attributes = []): TagInterface
    {
        return (new CardGroup($attributes))->render();
    }
}
