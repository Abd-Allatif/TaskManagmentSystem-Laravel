<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AdminCategoryRepository.
 */
class AdminCategoryRepository
{   

    public function getCategory($categoryId)
    {
        $category = Category::find($categoryId);

        return $category;
    }

    public function createCategory($data)
    {
        Category::create([
            'name' => $data['name'],
            'color' => $data['color']
        ]);
    }

    public function editCategory($data, $categoryId)
    {
        $category = Category::find($categoryId);

        $category->update([
            'name' => $data['name'],
            'color' => $data['color']
        ]);
    }

    public function deleteCategory($categoryId) 
    {
        $category = Category::find($categoryId);

        $category->delete();
    }
}
