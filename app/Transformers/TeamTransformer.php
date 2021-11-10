<?php


namespace App\Transformers;


use App\Models\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    /**
     * @param Team $team
     * @return array
     */
    public function transform(Team $team): array
    {
        return [
            'id'               => $team->id,
            'category_id'      => $team->category_id,
            'tags_id'          => $team->tags_id,
            'name'             => $team->name,
            'desc'             => $team->desc,
            'avatar'           => $team->avatar,
            'homepage'         => $team->homepage,
            'class_start_date' => $team->class_start_date,
        ];
    }
}
