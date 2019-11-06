<?php

namespace App\Http\Controllers;

use Image;
use Session;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductsImages;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * AdminProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function product_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::paginate(10)->setPageName('products-manage');
        return view('backend.products-manage',['products'=> $products, 'categories' => $categories]);
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
            'name'      => 'required',
            'category_id'       => 'required',
            'product_price'     => 'required',
            'sale_price'        => 'required',
            'product_color'     => 'required',
            'alert_quantity'    => 'required',
            'quantity'  => 'required',
            'product_description'=> 'required',
            'product_image'     => 'required|image|mimes:jpg,png,jpeg,gif',
            'status'            => 'required'
        ]);
    }

    /**
     * @param $request
     * @param $imageUri
     */
    public function productSave($request, $imageUri){
        Product::create([
            'name'      => $request->name,
            'slug'              => str_slug($request->name),
            'category_id'       => $request->category_id,
            'product_price'     => $request->product_price,
            'sale_price'        => $request->sale_price,
            'product_color'     => $request->product_color,
            'alert_quantity'    => $request->alert_quantity,
            'quantity'  => $request->quantity,
            'product_description'=> $request->product_description,
            'product_image'     => $imageUri,
            'status'            => $request->status,
            'created_at'        => Carbon::now(),
        ]);
    }

    /**
     * @param $request
     * @return string
     */
    public function uploadImage($request){
        $productImage = $request->file('product_image');
        $imageName = substr(time(),0,10);
        $imgExt = strtolower($productImage->getClientOriginalExtension());
        $imageUri = $imageName.'.'.$imgExt;
        $directory = 'uploads/products/';
        Image::make($productImage)->fit('600', '600', function($constraint) {
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
        $product = Product::where('id', $id)->first();
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
            'product_image'     => 'required'
        ]);
        $product_image = Product::where('id', $request->product_id)->first()->product_image;
        $old_product_image = explode('.', $product_image)[0];
        $productsImages = $request->file('product_image');
        foreach($productsImages as $image){
            $imageExt =  strtolower($image->getClientOriginalExtension());
            $imageName = 'IMG_'.$old_product_image.substr(time(),0,10).'_'.$request->product_id.'.'.$imageExt;
            $directory = 'uploads/products/';
            Image::make($image)->fit('600', '600', function($constraint) {
                $constraint->aspectRatio();
            })->save($directory.$imageName);
            ProductsImages::create([
                'product_id' => $request->product_id,
                'product_image' => $imageName,
            ]);
        }
        session()->flash('status', 'Images Successfully Uploaded');
        return redirect()->route('manage.products');
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
        $this->productSave($request, $imageUri);
        session()->flash('status', 'Product Insert Successfully');
        return redirect()->route('manage.products');
    }


    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $product_id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $categories = Category::all();
        $product = Product::where('id', $product_id)->first();
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
    public function productUnpublished($product_id)
    {
        Product::where('id', $product_id)->update([
            'status' => 0,
            'updated_at' => Carbon::now(),
        ]);
        
        Session()->flash('status', 'Product Unpublished Successfully');
        return back();
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function productPublished($product_id)
    {
        Product::where('id', $product_id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        
        Session()->flash('status', 'Product Published Successfully');
        return back();
    }

    /**
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($product_id)
    {
        $imageUri = 'uploads/products/'.Product::find($product_id)->product_image;
        if ($imageUri) {
            unlink($imageUri);
        }
        Product::where('id', $product_id)->delete();
        Session()->flash('status', 'Product Delete Successfully');
        return back();
    }
}
