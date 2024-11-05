<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        //get all categories
        $categories = Category::latest()->paginate(10);

        //render view with categories
        return view('pages.category.index', compact('categories'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.category.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required |max: 255',
        ]);

        //create category
        Category::create([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data saved successfully']);
    }


    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get category by ID
        $categories = Category::findOrFail($id);

        //render view with category
        return view('pages.category.edit', compact('categories'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required | max: 255',

        ]);

        //get category by ID
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,

        ]);

        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get category by ID
        $category = Category::findOrFail($id);

        //delete category
        $category->delete();

        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::where('name', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('pages.category.index', compact('categories'));
    }
}
