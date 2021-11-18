<?php

namespace App\Imports;

use App\Http\Controllers\Admin\SiteController;
use App\Models\Category;
use App\Models\Site;
use App\Models\Tag;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SiteImport implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // 去掉表头
        unset($rows[0]);
        // 数据处理
        $categoryModel = new Category();
        $tagModel = new Tag();
        $siteModel = new Site();
        foreach ($rows as $row) {
            $category = trim($row[0]);
            $tags = trim($row[1]);
            $name = trim($row[2]);
            $url = trim($row[3]);
            $thumb = trim($row[4]);
            $desc = trim($row[5]);

            SiteController::$checkImport['total']++;
            if (empty($category) || empty($name) || empty($url)) {
                SiteController::$checkImport['fail']++;
                continue;
            }
            $categoryRecord = $categoryModel->firstOrCreate(['title' => $category, 'type' => Category::TYPE_SITE]);
            $tagsId = [];
            if (!empty($tags)) {
                $tags = explode(',', $tags);
                foreach ($tags as $tag) {
                    $tagRecord = $tagModel->firstOrCreate(['tag' => $tag]);
                    array_push($tagsId, $tagRecord->id);
                }
                $tagsId = implode(',', $tagsId);
            }


            $siteModel->updateOrCreate([
                'name' => $name
            ], [
                'category_id' => $categoryRecord->id,
                'tags_id'     => empty($tagsId) ? null : $tagsId,
                'name'        => $name,
                'url'         => $url,
                'thumb'       => $thumb,
                'desc'        => $desc,
            ]);
            SiteController::$checkImport['success']++;
        }
    }
}
