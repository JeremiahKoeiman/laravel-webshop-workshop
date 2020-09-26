<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class CategoryController extends Controller
{

    /**
     * Set permissions on methods creation
     */
    public function __construct()
    {
        // Must be authenticated to use the CategoryController
        $this->middleware('auth');
        // If the user has the 'create category' permission, you can only use the 'create' and 'store' method
        $this->middleware('permission:create category', ['only' => ['create', 'store']]);
        // If the user has the 'edit category' permission, you can only use the 'edit' and 'update' method
        $this->middleware('permission:edit category', ['only' => ['edit', 'update']]);
        // If the user has the 'delete category' permission, you can only use the 'delete' and 'destroy' method
        $this->middleware('permission:delete category', ['only' => ['delete', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // Get categories
        $categories = Category::all();

        return view( 'admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Categorie aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return View
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param \App\Models\Category $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Categorie geupdate');
    }

    /**
     * @param Category $category
     * @return View
     */
    public function delete(Category $category)
    {
        return view('admin.categories.delete', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('categories.index')->with('wrong', 'Category is not yet empty. There aren\'t any products in the category allowed anymore.');
        }
        return redirect()->route('categories.index')->with('message', 'Categorie verwijderd');
    }
}
