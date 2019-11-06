<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category-manage',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category-new');
    }


    public function uploadImage($request){
        $categoryImage = $request->file('image');
        $imageName = substr(time(),0,10);
        $imgExt = strtolower($categoryImage->getClientOriginalExtension());
        $imageUri = $imageName.'.'.$imgExt;
        $directory = 'uploads/categories/';
        Image::make($categoryImage)->fit('600', '400', function($constraint) {
            $constraint->aspectRatio();
        })->save($directory.$imageUri);
        return $imageUri;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:categories',
            'status'    => 'required',
            'image'     => 'image|mimes:jpg,png,jpeg,gif'
        ],[
            'name.required'  => 'Please fill out the category name',
            'status.required'    => 'Choose Publication Status'
        ]);
        if ($request->file('image')) {
            $imageUri = $this->uploadImage($request);
            Category::create([
                'name'  => $request->name,
                'slug'      => str_slug($request->name),
                'image'     => $imageUri,
                'status'    => $request->status,
                'created_at'=> Carbon::now(),
            ]);
        }
        else{
            Category::create([
                'name'  => $request->name,
                'slug'      => str_slug($request->name),
                'status'    => $request->status,
                'created_at'=> Carbon::now(),
            ]);
        }
        $request->session()->flash('status', 'Category Inserted Successfully');
        return redirect()->route('manage.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach (Product::where('category_id', $id)->get() as $item){
            Product::where('id', $item->id)->delete();
        }

        if(Category::find($id)->image != 'default.jpg'){
            $path = 'uploads/categories/'.Category::find($id)->image;
            unlink($path);
        }
        Category::where('id', $id)->delete();
        session()->flash('status', 'Category Deleted Successfully');
        return redirect()->route('manage.categories');
    }
}
