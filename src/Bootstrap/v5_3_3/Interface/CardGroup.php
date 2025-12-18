<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente CardGroup de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'cards': array - Array de tarjetas
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class CardGroup extends AbstractComponent implements ComponentInterface
{
    private array $cards = [];
    private array $attributes = [];

    public function __construct(array $options = [])
    {
        if (isset($options['cards']) && is_array($options['cards'])) {
            $this->cards = $options['cards'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'card-group',
            $this->attributes['class'] ?? null
        );

        $group = $this->createComponent('div', $this->attributes);
        $group->content($this->cards);

        return $group;
    }

    public function addCard(mixed $card): self
    {
        $this->cards[] = $card;
        return $this;
    }
}
