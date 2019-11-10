<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MultiImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * AdminProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10)->setPageName('products-manage');
        return view('backend.products-manage',['products'=> $products]);
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.product-new',['categories' => $categories]);
    }

    /**
     * @param $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validation($request){
        $this->validate($request,[
            'name'          => 'required',
            'category_id'   => 'required',
            'product_price' => 'required',
            'sale_price'    => 'required',
            'product_color' => 'required',
            'alert_quantity'=> 'required',
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
    public function productStore($request, $imageUri){
        Product::create([
            'name'          => $request->name,
            'slug'          => $this->slug($request->name),
            'category_id'   => $request->category_id,
            'product_price' => $request->product_price,
            'sale_price'    => $request->sale_price,
            'product_color' => $request->product_color,
            'alert_quantity'=> $request->alert_quantity,
            'quantity'      => $request->quantity,
            'description'   => $request->description,
            'image'         => $imageUri,
            'status'        => $request->status,
            'created_at'    => Carbon::now(),
        ]);
    }

    /**
     * @param $request
     * @return string
     */
    public function uploadImage($request){
        $image = $request->file('image');
        $name = 'IMG_'.substr(time(),0,10);
        $extension = strtolower($image->getClientOriginalExtension());
        $imageUri = $name.'.'.$extension;
        $directory = 'uploads/products/';
        Image::make($image)->fit('600', '600', function($constraint) {
            $constraint->aspectRatio();
        })->save($directory.$imageUri);
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
        $this->validate($request,[
            'image' => 'required'
        ]);

        $random = strtoupper(Str::random(8));
        foreach($request->file('image') as $image){
            $extension =  strtolower($image->getClientOriginalExtension());
            $name = $random.'_'.$request->product_id.$this->slug($image->getClientOriginalName());
            $directory = 'uploads/products/';
            Image::make($image)->fit('600', '600', function($constraint) {
                $constraint->aspectRatio();
            })->save($directory.$name);
            MultiImages::create([
                'product_id' => $request->product_id,
                'image' => $name,
                'path' => $directory,
            ]);
        }
        Session::flash('success','Images Successfully Uploaded');
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
        Session::flash('success','Product Insert Successfully');
        return redirect(route('products.index'));
    }


    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $product_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrfail($id);
        return view('backend.product-edit',[
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*$this->validation($request);
        $imageUri = $this->uploadImage($request);
        $this->updateDatabase($request, $imageUri);
        Session()->flash('status', 'Product Update Successfully');
        return redirect()->route('/product-edit');*/
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $product_id
     * @return \Illuminate\Http\Response
     */
    public function productUnpublished($id)
    {
        Product::findOrfail($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('success','Product Unpublished Successfully');
        return back();
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productPublished($id)
    {
        Product::findOrfail($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        
        Session::flash('success','Product Published Successfully');
        return back();
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $path = 'uploads/products/';
        $product = Product::with('productImages','reviews')->findOrfail($id);
        if ($product) {
            if ($product->image != 'default.jpg') {
                unlink($path.$product->image);
            }
            if ($product->productImages) {
                foreach ($product->productImages as $getImage) {
                    unlink($path.$getImage->image);
                    MultiImages::findOrfail($getImage->id)->delete();
                }
            }
            if ($product->reviews) {
                foreach ($product->reviews as $review) {
                    Review::findOrfail($review->id)->delete();
                }
            }

            $product->delete();
        }
        Session::flash('success', 'Product Delete Successfully');
        return back();
    }
}
