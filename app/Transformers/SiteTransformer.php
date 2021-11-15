<?php


namespace App\Transformers;


use App\Models\Site;
use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class SiteTransformer extends TransformerAbstract
{
    /**
     * @param Site $site
     * @return array
     */
    public function transform(Site $site): array
    {
        $tagsList = [];
        if (!empty($site->tags_id)) {
            $tagsId = explode(',', $site->tags_id);
            $tagQuery = Tag::whereIn('id', $tagsId)->get(['id', 'tag']);
            if (!$tagQuery->isEmpty()) {
                $tagsList = $tagQuery->toArray();
            }
        }

        return [
            'id'            => $site->id,
            'name'          => $site->name,
            'desc'          => $site->desc,
            'thumb'         => $site->thumb,
            'url'           => $site->url,
            'category_id'   => $site->category_id,
            'category_name' => $site->category_name,
            'tags_id'       => $tagsList,
            'show_loading'  => false,
        ];
    }
}
