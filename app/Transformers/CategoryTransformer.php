<?php


namespace App\Transformers;


use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id'         => $category->id,
            'title'      => $category->title,
            'icon'       => $category->icon,
            'order'      => $category->order,
            'created_at' => $category->created_at,
        ];
    }
}
