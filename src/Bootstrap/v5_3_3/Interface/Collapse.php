<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Collapse de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID del collapse (requerido)
 * - 'content': mixed - Contenido
 * - 'horizontal': bool - Si es horizontal [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Collapse extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;
        $this->content = $options['content'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'horizontal' => $options['horizontal'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['collapse'];
        if ($this->options['horizontal']) {
            $classes[] = 'collapse-horizontal';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['id'] = $this->id;

        $collapse = $this->createComponent('div', $this->attributes);

        if ($this->options['horizontal']) {
            $widthWrapper = $this->createComponent('div', ['style' => 'width: 300px;']);
            $widthWrapper->content($this->createCardBody($this->content));
            $collapse->content($widthWrapper);
        } else {
            $collapse->content($this->createCardBody($this->content));
        }

        return $collapse;
    }

    protected function createCardBody(mixed $content): TagInterface
    {
        $card = $this->createComponent('div', ['class' => 'card card-body']);
        $card->content($content);
        return $card;
    }

    // Métodos fluidos opcionales
    public function horizontal(bool $horizontal = true): self
    {
        $this->options['horizontal'] = $horizontal;
        return $this;
    }
}
