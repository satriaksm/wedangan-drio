<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request): View
    {
        //get all products
        $products = Product::with('category')->get();
        $categories = Category::all();
        //render view with products
        return view('pages.product.index', compact('products', 'categories'));
    }
    public function transaction(): View
    {
        //get all products
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('pages.transaction.index', compact('products','categories'));
    }

    public function pay(): View
    {
        //get all products
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('pages.transaction.pay', compact('products','categories'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
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
            'name' => 'required | max: 255',
            'category_id' => 'required',
            'selling_price' => 'required | max:12',
            'purchase_price' => 'required | max:12',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //create product
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'selling_price' => $request->selling_price,
            'purchase_price' => $request->purchase_price,
            'img' => $request->file('img')->store('images/products', 'public'),
        ]);

        //redirect to index
        return redirect()->route('product.index')->with(['success' => 'Data saved successfully']);
    }


    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $products = Product::findOrFail($id);
        $categories = Category::all();
        //render view with product
        return view('pages.product.edit', compact('products', 'categories'));
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
            'name' => 'required|max:255',
            'category_id' => 'required',
            'selling_price' => 'required|max:12',
            'purchase_price' => 'required|max:12',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // img is optional
        ]);

        //get product by ID
        $product = Product::findOrFail($id);

        //update product
        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'selling_price' => $request->selling_price,
            'purchase_price' => $request->purchase_price,
        ];

        //check if a new image is uploaded
        if ($request->hasFile('img')) {
            //delete old image
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            //store new image
            $data['img'] = $request->file('img')->store('images/products', 'public');
        }

        $product->update($data);

        //redirect to index
        return redirect()->route('product.index')->with(['success' => 'Data updated successfully']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //delete product image if exists
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('product.index')->with(['success' => 'Data deleted successfully']);
    }

    public function search(Request $request): View
    {
        $search = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('pages.product.index', compact('products'));
    }
}
