<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{

    // Getting All Tasks for the user
    public function getAllCategories()
    {
        $categories = Category::all();

        return $categories;
    }

    // Getting All Tasks for the user
    public function getAllCategoriesWithTasks()
    {
        $categories = Category::with('tasks')->get();

        return $categories;
    }

    public function getCategory($categoryId, $userId)
    {
        $category = Category::with(['tasks' => function ($query) use ($userId, $categoryId) {
            return $query->parent()->forUser($userId)->whereHas('categories', function ($query) use ($categoryId) {
                return $query->where('category_id', '=', $categoryId);
            })->orderBy('status', 'desc');
        }])->where('id', '=', $categoryId)->first();

        return $category;
    }

    public function getSingleCategory(array $categoryId)
    {
        return  Category::whereIn('id', $categoryId)->first();
    }
}
