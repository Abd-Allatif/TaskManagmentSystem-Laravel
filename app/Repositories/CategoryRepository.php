<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{
    // Retrieve all Catgories from Category model
    public function getAllCatgories(): Collection
    {
        return Category::all()->orderBy('name');
    }

    // Retrive Specific Catgory
    public function getCategory(int $id){
        return Category::find($id);
    }

    // Create a new category
    public function createCatgory(Collection $data){
        Category::create($data);
    }

    // Edit Category
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
    }
}
