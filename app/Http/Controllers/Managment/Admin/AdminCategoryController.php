<?php

namespace App\Http\Controllers\Managment\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\AdminCategoryRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;
    protected AdminCategoryRepository $adminCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository, AdminCategoryRepository $adminCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->adminCategoryRepository = $adminCategoryRepository;
    }

    public function categoryPage()
    {
        $categories = $this->categoryRepository->getAllCategoriesWithTasks();

        return view('pages.admin.categoryManagment', ['categories' => $categories]);
    }

    public function createCategoryPage()
    {
        return view('pages.admin.Managment.category-create-page');
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required'],
            'color' => ['string', 'required']
        ]);

        $this->adminCategoryRepository->createCategory($validated);

        return redirect()->route('categoryManagment')->with('status', 'Category Created Successfully');
    }


    public function editCategoryPage($categoryId)
    {
        $category = $this->adminCategoryRepository->getCategory($categoryId);

        return view('pages.admin.Managment.category-edit-page',['category' => $category]);
    }

    public function editCategory(Request $request,$categoryId)
    {
        $validated = $request->validate([
            'name' => ['string', 'required'],
            'color' => ['string', 'required']
        ]);

        $this->adminCategoryRepository->editCategory($validated,$categoryId);

        return redirect()->route('categoryManagment')->with('status', 'Category Updated Successfully');
    }

    public function deleteCategory($categoryId)
    {
        $this->adminCategoryRepository->deleteCategory($categoryId);
        
        return redirect()->route('categoryManagment')->with('status', 'Category Deleted');
    }
}
