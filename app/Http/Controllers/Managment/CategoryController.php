<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected TaskRepository $taskRepository;
    protected CategoryRepository $categoryRepository;
    protected $user;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
        $this->user = Auth::user();
    }

    public function getClickedCategory($categoryId) {
        $category = $this->categoryRepository->getCategory($categoryId,$this->user->id);

        // return response()->json($category);
        return view('pages.Categories.view-clickedCategory',['category' => $category]);
    }
}
