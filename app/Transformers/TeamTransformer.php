<?php


namespace App\Transformers;


use App\Models\Tag;
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
        $tagsList = [];
        if (!empty($team->tags_id)) {
            $tagsId = explode(',', $team->tags_id);
            $tagQuery = Tag::whereIn('id', $tagsId)->get(['id', 'tag']);
            if (!$tagQuery->isEmpty()) {
                $tagsList = $tagQuery->toArray();
            }
        }

        return [
            'id'               => $team->id,
            'name'             => $team->name,
            'desc'             => $team->desc,
            'avatar'           => $team->avatar,
            'homepage'         => $team->homepage,
            'class_start_date' => $team->class_start_date,
            'category_id'      => $team->category_id,
            'category_name'    => $team->category_name,
            'tags_id'          => $tagsList,
            'show_loading'     => false,
        ];
    }
}
