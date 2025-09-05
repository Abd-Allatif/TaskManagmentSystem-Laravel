<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getClickedCategory($categoryId,$userId) {
        $category = $this->categoryRepository->getCategory($categoryId,$userId);

        // return response()->json($category);
        return view('pages.Categories.view-clickedCategory',['category' => $category,'userId' => $userId]);
    }
}
