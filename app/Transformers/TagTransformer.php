<?php


namespace App\Transformers;


use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    /**
     * @param Tag $tag
     * @return array
     */
    public function transform(Tag $tag): array
    {
        return [
            'id'    => $tag->id,
            'tag'   => $tag->tag,
            'order' => $tag->order,
        ];
    }
}
