<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;

/**
 * Componente de Grupo de Tarjetas de Bootstrap 5
 */
class CardGroup extends AbstractComponent
{
    private array $cards = [];
    private array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Agrega una tarjeta al grupo
     */
    public function addCard($cardOrCallback): self
    {
        if (is_callable($cardOrCallback)) {
            $card = new Card();
            $cardOrCallback($card);
            $this->cards[] = $card;
        } else {
            $this->cards[] = $cardOrCallback;
        }

        return $this;
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'card-group',
            $this->attributes['class'] ?? null
        );

        $group = Html::tag('div', $this->attributes);
        $cards = [];

        foreach ($this->cards as $card) {
            if ($card instanceof Card) {
                $cards[] = $card->render();
            } elseif (is_array($card)) {
                $cards[] = (new Card())
                    ->header($card['title'] ?? null)
                    ->body($card['content'] ?? null)
                    ->footer($card['footer'] ?? null)
                    ->render();
            }
        }

        $group->content($cards);
        return $group;
    }
}
