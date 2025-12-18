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
     * 
     * Actúa como bypass/proxy a la clase Alert.
     * 
     * @param array $options Array de opciones (ver Alert::__construct)
     * @return TagInterface
     * 
     * @example
     * Bootstrap::alert(['content' => 'Mensaje', 'type' => 'danger', 'dismissible' => true]);
     */
    public static function alert(array $options = []): TagInterface
    {
        return (new Alert($options))->render();
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
     * Actúa como bypass/proxy a la clase Card.
     * Recibe el mismo array de opciones que el constructor de Card.
     * 
     * @param array $options Array de opciones de configuración (ver Card::__construct)
     * @return TagInterface
     * 
     * @example
     * Bootstrap::card(['title' => 'Título', 'content' => 'Contenido']);
     * Bootstrap::card(['headerTitle' => 'Header', 'headerButtons' => [...]]);
     */
    public static function card(array $options = []): TagInterface
    {
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
     * 
     * Actúa como bypass/proxy a la clase Button.
     * 
     * @param array $options Array de opciones (ver Button::__construct)
     * @return TagInterface
     * 
     * @example
     * Bootstrap::button(['content' => 'Click', 'variant' => 'primary', 'size' => 'lg']);
     */
    public static function button(array $options = []): TagInterface
    {
        return (new Button($options))->render();
    }

    /**
     * Crea un grupo de botones
     */
    /**
     * Crea un grupo de botones
     * 
     * @param array $options Array de opciones (ver ButtonGroup::__construct)
     * @return TagInterface
     */
    public static function buttonGroup(array $options = []): TagInterface
    {
        return (new ButtonGroup($options))->render();
    }

    /**
     * Crea un badge
     * 
     * @param array $options Array de opciones (ver Badge::__construct)
     * @return TagInterface
     */
    public static function badge(array $options = []): TagInterface
    {
        return (new Badge($options))->render();
    }

    /**
     * Crea un breadcrumb
     */
    /**
     * Crea un breadcrumb
     * 
     * @param array $options Array de opciones (ver Breadcrumb::__construct)
     * @return TagInterface
     */
    public static function breadcrumb(array $options = []): TagInterface
    {
        return (new Breadcrumb($options))->render();
    }

    /**
     * Crea un carousel
     */
    /**
     * Crea un carousel
     * 
     * @param array $options Array de opciones (ver Carousel::__construct)
     * @return TagInterface
     */
    public static function carousel(array $options = []): TagInterface
    {
        return (new Carousel($options))->render();
    }

    /**
     * Crea un collapse
     */
    /**
     * Crea un collapse
     * 
     * @param array $options Array de opciones (ver Collapse::__construct)
     * @return TagInterface
     */
    public static function collapse(array $options = []): TagInterface
    {
        return (new Collapse($options))->render();
    }

    /**
     * Crea un dropdown
     */
    /**
     * Crea un dropdown
     * 
     * @param array $options Array de opciones (ver Dropdown::__construct)
     * @return TagInterface
     */
    public static function dropdown(array $options = []): TagInterface
    {
        return (new Dropdown($options))->render();
    }

    /**
     * Crea un form
     */
    /**
     * Crea un form
     * 
     * @param array $options Array de opciones (ver Form::__construct)
     * @return TagInterface
     */
    public static function form(array $options = []): TagInterface
    {
        return (new Form($options))->render();
    }

    /**
     * Crea un input
     */
    /**
     * Crea un input
     * 
     * @param array $options Array de opciones (ver Input::__construct)
     * @return TagInterface
     */
    public static function input(array $options = []): TagInterface
    {
        return (new Input($options))->render();
    }

    /**
     * Crea un select
     */
    /**
     * Crea un select
     * 
     * @param array $options Array de opciones (ver Select::__construct)
     * @return TagInterface
     */
    public static function select(array $options = []): TagInterface
    {
        return (new Select($options))->render();
    }

    /**
     * Crea un checkbox
     */
    /**
     * Crea un checkbox
     * 
     * @param array $options Array de opciones (ver Check::__construct)
     * @return TagInterface
     */
    public static function check(array $options = []): TagInterface
    {
        return (new Check($options))->render();
    }

    /**
     * Crea un radio
     */
    /**
     * Crea un radio
     * 
     * @param array $options Array de opciones (ver Radio::__construct)
     * @return TagInterface
     */
    public static function radio(array $options = []): TagInterface
    {
        return (new Radio($options))->render();
    }

    /**
     * Crea un file input
     */
    /**
     * Crea un file input
     * 
     * @param array $options Array de opciones (ver File::__construct)
     * @return TagInterface
     */
    public static function file(array $options = []): TagInterface
    {
        return (new File($options))->render();
    }

    /**
     * Crea un textarea
     */
    /**
     * Crea un textarea
     * 
     * @param array $options Array de opciones (ver Textarea::__construct)
     * @return TagInterface
     */
    public static function textarea(array $options = []): TagInterface
    {
        return (new Textarea($options))->render();
    }

    /**
     * Crea un list group
     */
    /**
     * Crea un list group
     * 
     * @param array $options Array de opciones (ver ListGroup::__construct)
     * @return TagInterface
     */
    public static function listGroup(array $options = []): TagInterface
    {
        return (new ListGroup($options))->render();
    }

    /**
     * Crea un modal
     * 
     * @param array $options Array de opciones (ver Modal::__construct)
     * @return TagInterface
     */
    public static function modal(array $options = []): TagInterface
    {
        return (new Modal($options))->render();
    }

    /**
     * Crea un nav
     */
    /**
     * Crea un nav
     * 
     * @param array $options Array de opciones (ver Nav::__construct)
     * @return TagInterface
     */
    public static function nav(array $options = []): TagInterface
    {
        return (new Nav($options))->render();
    }

    /**
     * Crea un navbar
     */
    /**
     * Crea un navbar
     * 
     * @param array $options Array de opciones (ver Navbar::__construct)
     * @return TagInterface
     */
    public static function navbar(array $options = []): TagInterface
    {
        return (new Navbar($options))->render();
    }

    /**
     * Crea un offcanvas
     */
    /**
     * Crea un offcanvas
     * 
     * @param array $options Array de opciones (ver Offcanvas::__construct)
     * @return TagInterface
     */
    public static function offcanvas(array $options = []): TagInterface
    {
        return (new Offcanvas($options))->render();
    }

    /**
     * Crea una paginación
     */
    /**
     * Crea una paginación
     * 
     * @param array $options Array de opciones (ver Pagination::__construct)
     * @return TagInterface
     */
    public static function pagination(array $options = []): TagInterface
    {
        return (new Pagination($options))->render();
    }

    /**
     * Crea un popover
     */
    /**
     * Crea un popover
     * 
     * @param array $options Array de opciones (ver Popover::__construct)
     * @return TagInterface
     */
    public static function popover(array $options = []): TagInterface
    {
        return (new Popover($options))->render();
    }

    /**
     * Crea un progress
     * 
     * @param array $options Array de opciones (ver Progress::__construct)
     * @return TagInterface
     */
    public static function progress(array $options = []): TagInterface
    {
        return (new Progress($options))->render();
    }

    /**
     * Crea un spinner
     * 
     * @param array $options Array de opciones (ver Spinner::__construct)
     * @return TagInterface
     */
    public static function spinner(array $options = []): TagInterface
    {
        return (new Spinner($options))->render();
    }

    /**
     * Crea un toast
     * 
     * @param array $options Array de opciones (ver Toast::__construct)
     * @return TagInterface
     */
    public static function toast(array $options = []): TagInterface
    {
        return (new Toast($options))->render();
    }

    /**
     * Crea un tooltip
     */
    /**
     * Crea un tooltip
     * 
     * @param array $options Array de opciones (ver Tooltip::__construct)
     * @return TagInterface
     */
    public static function tooltip(array $options = []): TagInterface
    {
        return (new Tooltip($options))->render();
    }

    /**
     * Crea un container
     */
    /**
     * Crea un container
     * 
     * @param array $options Array de opciones (ver Container::__construct)
     * @return TagInterface
     */
    public static function container(array $options = []): TagInterface
    {
        return (new Container($options))->render();
    }

    /**
     * Crea un grid
     */
    /**
     * Crea un grid
     * 
     * @param array $options Array de opciones (ver Grid::__construct)
     * @return TagInterface
     */
    public static function grid(array $options = []): TagInterface
    {
        return (new Grid($options))->render();
    }

    /**
     * Crea una columna
     */
    /**
     * Crea una columna
     * 
     * @param array $options Array de opciones (ver Col::__construct)
     * @return TagInterface
     */
    public static function col(array $options = []): TagInterface
    {
        return (new Col($options))->render();
    }

    /**
     * Crea una fila
     */
    /**
     * Crea una fila
     * 
     * @param array $options Array de opciones (ver Row::__construct)
     * @return TagInterface
     */
    public static function row(array $options = []): TagInterface
    {
        return (new Row($options))->render();
    }

    /**
     * Crea una tabla
     */
    /**
     * Crea una tabla
     * 
     * @param array $options Array de opciones (ver Table::__construct)
     * @return TagInterface
     */
    public static function table(array $options = []): TagInterface
    {
        return (new Table($options))->render();
    }

    /**
     * Crea una figura
     */
    /**
     * Crea una figura
     * 
     * @param array $options Array de opciones (ver Figure::__construct)
     * @return TagInterface
     */
    public static function figure(array $options = []): TagInterface
    {
        return (new Figure($options))->render();
    }

    /**
     * Crea una imagen
     * 
     * @param array $options Array de opciones (ver Image::__construct)
     * @return TagInterface
     */
    public static function image(array $options = []): TagInterface
    {
        return (new Image($options))->render();
    }

    /**
     * Crea un elemento de tipografía
     */
    /**
     * Crea un elemento de tipografía
     * 
     * @param array $options Array de opciones (ver Typography::__construct)
     * @return TagInterface
     */
    public static function typography(array $options = []): TagInterface
    {
        return (new Typography($options))->render();
    }

    /**
     * Crea un grupo de tarjetas
     */
    /**
     * Crea un grupo de tarjetas
     * 
     * @param array $options Array de opciones (ver CardGroup::__construct)
     * @return TagInterface
     */
    public static function cardGroup(array $options = []): TagInterface
    {
        return (new CardGroup($options))->render();
    }

    /**
     * Crea un acordeón
     * 
     * @param array $options Array de opciones (ver Accordion::__construct)
     * @return TagInterface
     */
    public static function accordion(array $options = []): TagInterface
    {
        return (new \Higgs\Frontend\Bootstrap\v5_3_3\Interface\Accordion($options))->render();
    }
}
