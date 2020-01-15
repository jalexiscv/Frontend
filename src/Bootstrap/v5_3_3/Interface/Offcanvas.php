<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Offcanvas de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID (requerido)
 * - 'title': string - Título
 * - 'body': mixed - Contenido del body
 * - 'placement': string - Posición ('start', 'end', 'top', 'bottom') [default: 'start']
 * - 'backdrop': bool|string - 'static' o bool [default: true]
 * - 'scroll': bool - Permitir scroll del body [default: false]
 * - 'dark': bool - Tema oscuro [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Offcanvas extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private ?string $title = null;
    private mixed $body = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;
        $this->title = $options['title'] ?? null;
        $this->body = $options['body'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'placement' => $options['placement'] ?? 'start',
            'backdrop' => $options['backdrop'] ?? true,
            'scroll' => $options['scroll'] ?? false,
            'dark' => $options['dark'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['offcanvas', "offcanvas-{$this->options['placement']}"];
        if ($this->options['dark']) $classes[] = 'text-bg-dark';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['tabindex'] = '-1';
        $this->attributes['id'] = $this->id;
        $this->attributes['aria-labelledby'] = "{$this->id}Label";

        if ($this->options['scroll']) $this->attributes['data-bs-scroll'] = 'true';
        if ($this->options['backdrop'] === false) {
            $this->attributes['data-bs-backdrop'] = 'false';
        } elseif ($this->options['backdrop'] === 'static') {
            $this->attributes['data-bs-backdrop'] = 'static';
        }

        $offcanvas = $this->createComponent('div', $this->attributes);
        $offcanvas->content([$this->createHeader(), $this->createBody()]);

        return $offcanvas;
    }

    protected function createHeader(): TagInterface
    {
        $header = Html::tag('div', ['class' => 'offcanvas-header']);

        $title = Html::tag('h5', [
            'class' => 'offcanvas-title',
            'id' => "{$this->id}Label"
        ], $this->title ?? '');

        $closeBtn = Html::tag('button', [
            'type' => 'button',
            'class' => 'btn-close' . ($this->options['dark'] ? ' btn-close-white' : ''),
            'data-bs-dismiss' => 'offcanvas',
            'aria-label' => 'Close'
        ]);

        $header->content([$title, $closeBtn]);
        return $header;
    }

    protected function createBody(): TagInterface
    {
        return Html::tag('div', ['class' => 'offcanvas-body'], $this->body);
    }

    // Métodos fluidos opcionales
    public function placement(string $placement): self
    {
        $this->options['placement'] = $placement;
        return $this;
    }
    public function scroll(bool $scroll = true): self
    {
        $this->options['scroll'] = $scroll;
        return $this;
    }
    public function backdrop(bool|string $backdrop): self
    {
        $this->options['backdrop'] = $backdrop;
        return $this;
    }
}
