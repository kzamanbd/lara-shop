<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.category-manage', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.category-create');
    }


    public function uploadImage($request)
    {
        $image = $request->file('image');
        $name = $this->slug($image->getClientOriginalName());
        $imageUri = $request->file('image')->storeAs('categories', $name);
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
        $this->validate($request, [
            'name'   => 'required|unique:categories',
            'status' => 'required',
            'image'  => 'image|mimes:jpg,png,jpeg,gif'
        ], [
            'name.required'  => 'Please fill out the category name',
            'status.required'    => 'Choose Publication Status'
        ]);
        if ($request->file('image')) {
            $imageUri = $this->uploadImage($request);
            Category::create([
                'name'  => $request->name,
                'slug'      => $this->slug($request->name),
                'image'     => $imageUri,
                'status'    => $request->status,
            ]);
        } else {
            Category::create([
                'name'  => $request->name,
                'slug'  => $this->slug($request->name),
                'status' => $request->status,
            ]);
        }
        Session::flash('success', 'Category Inserted Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return redirect()->route('category.index');
    }
}