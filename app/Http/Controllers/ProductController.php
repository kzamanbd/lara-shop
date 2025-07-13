<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * @param $string
     * @return null|string|string[]
     */
    public function slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('backend.products-manage', ['products' => $products]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.product-create', ['categories' => $categories]);
    }


    /**
     * @param $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validation($request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'category_id'   => 'required',
            'product_price' => 'required',
            'sale_price'    => 'required',
            'product_color' => 'required',
            'alert_quantity' => 'required',
            'quantity'      => 'required',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif',
            'status'        => 'required'
        ]);
    }

    /**
     * @param $request
     * @param $imageUri
     */
    public function productStore($request, $imageUri)
    {
        Product::create([
            'name'          => $request->name,
            'slug'          => $this->slug($request->name),
            'category_id'   => $request->category_id,
            'product_price' => $request->product_price,
            'sale_price'    => $request->sale_price,
            'product_color' => $request->product_color,
            'alert_quantity' => $request->alert_quantity,
            'quantity'      => $request->quantity,
            'description'   => $request->description,
            'image'         => $imageUri,
            'status'        => $request->status,
            'created_at'    => Carbon::now(),
        ]);
    }


    public function productUpdate($request, $imageUri = null)
    {
        Product::where('id', $request->product_id)->update([
            'name'          => $request->name,
            'slug'          => $this->slug($request->name),
            'category_id'   => $request->category_id,
            'product_price' => $request->product_price,
            'sale_price'    => $request->sale_price,
            'product_color' => $request->product_color,
            'alert_quantity' => $request->alert_quantity,
            'quantity'      => $request->quantity,
            'description'   => $request->description,
            'status'        => $request->status,
            'updated_at'    => Carbon::now(),
        ]);
        if ($imageUri) {
            Product::where('id', $request->product_id)->update(['image' => $imageUri]);
        }
    }


    /**
     * @param $request
     * @return string
     */
    public function uploadImage($request)
    {
        $image = $request->file('image');
        $name = $this->slug($image->getClientOriginalName());
        $imageUri = $request->file('image')->storeAs('products', $name);
        return $imageUri;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productMultipleImage($id)
    {
        $product = Product::findOrfail($id);
        return view('backend.product-multiple-image', compact('product'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function productMultipleImageStore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);

        foreach ($request->file('image') as $image) {
            $name = $this->slug($image->getClientOriginalName());
            $directory = $image->storeAs('products', $name);
            ProductImages::create([
                'product_id' => $request->product_id,
                'image' => $name,
                'path' => $directory,
            ]);
        }
        Session::flash('success', 'Images Successfully Uploaded');
        return redirect(route('products.index'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $imageUri = $this->uploadImage($request);
        $this->productStore($request, $imageUri);
        Session::flash('success', 'Product Insert Successfully');
        return redirect(route('products.index'));
    }


    public function show(Product $product) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrfail($id);
        return view('backend.product-edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required',
            'sale_price' => 'required',
            'product_color' => 'required',
            'alert_quantity' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        if ($request->has('image')) {
            $imageUri = $this->uploadImage($request);
            $this->productUpdate($request, $imageUri);
        } else {
            $this->productUpdate($request);
        }
        Session::flash('success', 'Product Update Successfully');
        return redirect(route('products.index'));
        //return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productUnpublished($id)
    {
        Product::findOrfail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('success', 'Product Unpublished Successfully');
        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productPublished($id)
    {
        Product::findOrfail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        Session::flash('success', 'Product Published Successfully');
        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        return back();
    }

    /**
     * Get New Arrival products
     */
    public function newArrivals()
    {
        $products = Product::newArrival()->with('category')->latest()->paginate(12);
        return view('frontend.products.new-arrivals', compact('products'));
    }

    /**
     * Get Best Selling products
     */
    public function bestSelling()
    {
        $products = Product::bestSelling()->with('category')->latest()->paginate(12);
        return view('frontend.products.best-selling', compact('products'));
    }

    /**
     * Get Featured products
     */
    public function featured()
    {
        $products = Product::featured()->with('category')->latest()->paginate(12);
        return view('frontend.products.featured', compact('products'));
    }

    /**
     * Get Special Offer products
     */
    public function specialOffers()
    {
        $products = Product::specialOffer()->with('category')->latest()->paginate(12);
        return view('frontend.products.special-offers', compact('products'));
    }

    /**
     * Get products for homepage sections
     */
    public function getHomepageProducts()
    {
        return [
            'newArrivals' => Product::newArrival()->with('category')->latest()->take(8)->get(),
            'bestSelling' => Product::bestSelling()->with('category')->latest()->take(8)->get(),
            'featured' => Product::featured()->with('category')->latest()->take(8)->get(),
            'specialOffers' => Product::specialOffer()->with('category')->latest()->take(8)->get(),
        ];
    }
}
