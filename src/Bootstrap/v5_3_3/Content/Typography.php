<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Typography extends AbstractComponent
{
    private string $tag;
    private string $content;
    private array $attributes;

    public function __construct(
        string $tag,
        string $content,
        array $attributes = []
    ) {
        $this->tag = $tag;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $tag = $this->createComponent($this->tag, $this->attributes);
        $tag->content($this->content);
        return $tag;
    }

    public static function heading(
        int $level,
        string $content,
        array $attributes = []
    ): self {
        if ($level < 1 || $level > 6) {
            throw new \InvalidArgumentException('Heading level must be between 1 and 6');
        }

        return new self("h{$level}", $content, $attributes);
    }

    public static function display(
        int $level,
        string $content,
        array $attributes = []
    ): self {
        if ($level < 1 || $level > 6) {
            throw new \InvalidArgumentException('Display level must be between 1 and 6');
        }

        $attributes['class'] = self::mergeClasses(
            "display-{$level}",
            $attributes['class'] ?? null
        );

        return new self('div', $content, $attributes);
    }

    public static function lead(string $content, array $attributes = []): self
    {
        $attributes['class'] = self::mergeClasses(
            'lead',
            $attributes['class'] ?? null
        );

        return new self('p', $content, $attributes);
    }

    public static function inline(
        string $type,
        string $content,
        array $attributes = []
    ): self {
        $tag = match ($type) {
            'mark' => 'mark',
            'del' => 'del',
            'strong' => 'strong',
            'em' => 'em',
            'small' => 'small',
            default => 'span'
        };

        return new self($tag, $content, $attributes);
    }

    public static function list(
        array $items,
        string $type = 'ul',
        array $attributes = []
    ): TagInterface {
        $list = new self($type, '', $attributes);
        $listItems = [];

        foreach ($items as $item) {
            if (is_array($item)) {
                // Sublist
                $subList = self::list($item['items'], $item['type'] ?? 'ul');
                $listItems[] = (new self('li', ''))->render()->content($subList);
            } else {
                $listItems[] = (new self('li', $item))->render();
            }
        }

        $renderedList = $list->render();
        $renderedList->content($listItems);
        return $renderedList;
    }
}
