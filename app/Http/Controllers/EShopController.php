<?php

namespace App\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Upazila;
use App\Models\Product;
use App\Models\Billing;
use App\Models\Category;
use App\Models\District;
use App\Models\Shipping;
use App\Models\Division;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class EShopController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(){
    	$categories = Category::where('status', 1)->get();
        $products = Product::with('category')->where('status', 1)->paginate(8)->setPageName('product-page');
    	$bastSales = Product::with('category')->where('status', 1)->where('sale_status',1)->paginate(8)->setPageName('best-sale');

        return view('frontend.index',[
            'products'      => $products,
            'bastSales'		=> $bastSales,
            'categories' 	=> $categories,
        ]);

        /*return view('frontend.aroma.index',[
            'products'      => $products,
            'bastSales'      => $bastSales,
            'categories'    => $categories,
        ]);*/
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetails($slug)
    {
        $categories = Category::where('status', 1)->orderBy('name', 'ASC')->get();
    	$product = Product::with('category', 'productImages')->where('slug', $slug)->firstOrfail();
        if ($product) {
    	   $relatedProducts = Product::with('productImages')->where('category_id', $product->category_id)->where('slug','!=', $slug)->take(4)->get();

            return  view('frontend.product-details',[
                'product'           => $product,
                'categories'        => $categories,
                'relatedProducts'   => $relatedProducts,
            ]);

            return  view('frontend.aroma.product-details',[
                'product'           => $product,
                'categories'        => $categories,
                'relatedProducts'   => $relatedProducts,
            ]);
        }
    	else{
            return redirect()->route('/');
        }
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryProducts($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category_id = Category::where('slug', $slug)->firstOrfail()->id;
            if (Product::where('category_id', $category_id)->exists()) {
                $products = Product::where('category_id', $category_id)->where('status', 1)->inRandomOrder()->paginate(8);
                return  view('frontend.product-category',[
                    'products' => $products,
                    'slug' => $slug,
                ]);
            }
            else{
                return redirect()->route('/');
            }            
        }
        else{
            return redirect()->route('/');
        }
    	
    }


    /**
     * @param string $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToWishList($product_id='')
    {

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request,[
            'search' => 'required'
        ]);
        if ($request->category == 'all'){
            $search_input = $request->search;
            $products = Product::where('name', 'LIKE', '%'.$search_input.'%')->get();
            return  view('frontend.search',[
                'products' => $products,
            ]);
        }
        else{
            $search_input = $request->search;
            $category_id = Category::where('slug', $request->category)->firstOrfail()->id;
            $products = Product::where('name', 'LIKE', '%'.$search_input.'%')->where('category_id', $category_id)->get();
            return  view('frontend.search',[
                'products' => $products,
            ]);
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public function searchAjax(Request $request)
    {
        $search_input = $request->search_input;
        $products = Product::where('name', 'LIKE', '%'.$search_input.'%')->get();
        $stringToSend = "";
        foreach ($products as $product) {
            $stringToSend .= "<li><a href='".route('/product-details',['slug' => $product->slug])."'>".$product->name."</a></li>";
        }
        return $stringToSend;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkout(Request $request)
    {
        $this->validate($request,[
            'sub_total' =>'required',
            'shipping_method' =>'required',
        ],[
            'sub_total.required' => 'Please Select Shipping Method',
        ]);
        $divisions = Division::all();
        return view('frontend.checkout',[
            'divisions' => $divisions,
            'total_qty' => $request->total_qty,
            'sub_total' => $request->sub_total,
            'shipping_method' => $request->shipping_method,
        ]);
        
    }

    /**
     * @param Request $request
     * @return string
     */
    public function districtsList(Request $request)
    {
        $stringToSend = "<option>District *</option>";
        $districts = District::where('division_id',$request->division_id)->get();
        foreach ($districts as $district) {
            $stringToSend .= "<option value='".$district->id."'>".$district->bn_name."</option>";
        }
        return $stringToSend;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function upazilaList(Request $request)
    {
        $stringToSend = "<option>Upazila *</option>";
        $upazilas = Upazila::where('district_id',$request->district_id)->get();
        foreach ($upazilas as $upazila) {
            $stringToSend .= "<option value='".$upazila->id."'>".$upazila->bn_name."</option>";
        }
        return $stringToSend;
    }

    public function CreateAccount($request){
        if($request->create_account){
            $this->validate($request,[
                'email' =>['required', 'string', 'email', 'unique:customers'],
                'password' =>'required',
            ]);
            $customer_id = Customer::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            return $customer_id;
        }
        else{
            $customer_id = null;
        }
    }


    public function productShipping($request, $customer_id = null){
        $shipping_id =Shipping::insertGetId([
            'customer_id'   => Auth::guard('customer')->check()?Auth::guard('customer')->id():$customer_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'  => $request->phone,
            'zip_code'      => $request->zip_code,
            'division_id'   => $request->division_id,
            'district_id'   => $request->district_id,
            'upazila_id'    => $request->upazila_id,
            'address'       => $request->address,
            'payment_type'  => $request->payment_type,
            'shipping_method'  => $request->shipping_method,
            'created_at'    => Carbon::now(),
        ]);
        return $shipping_id;
    }
    
    public function productSale($request, $shipping_id, $customer_id = null){
        $order_id = Order::insertGetId([
            'customer_id'   => Auth::guard('customer')->check()?Auth::guard('customer')->id():$customer_id,
            'shipping_id'   => $shipping_id,
            'sub_total'     => $request->sub_total,
            'created_at'    => Carbon::now(),
        ]);
        return $order_id;
    }

    public function productBilling($order_id, $shipping_id, $customer_id = null){
        $carts = Cart::where('session_id', session()->getId())->get();
        foreach ($carts as $cart){
            Billing::create([
                'order_id' => $order_id,
                'product_id' =>$cart->product_id,
                'quantity' =>$cart->quantity,
                'product_unit_price' => $cart->product->sale_price,
                'created_at'    => Carbon::now(),
            ]);

            Product::find($cart->product_id)->decrement('quantity',$cart->quantity);
        }
        Cart::truncate();
        $shipping = Shipping::where('id',$shipping_id)->firstOrfail();
        Mail::to($shipping->email)->send(new OrderConfirmationMail($shipping));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function shipping(Request $request){
        //return $request->all();

        $this->validate($request,[
            'name' =>'required|string',
            'division_id' =>'required',
            'district_id' =>'required',
            'upazila_id' =>'required',
            'phone' =>'required|string',
            'zip_code' =>'required|string',
            'phone' =>'required|string',
            'email' =>'required|string',
            'address' =>'required|string',
            'payment_type' =>'required',
            'shipping_method' =>'required',
        ]);

        $customer_id = $this->CreateAccount($request);

        if ($request->payment_type == 'cash'){
            $shipping_id = $this->productShipping($request, $customer_id);
            $order_id = $this->productSale($request, $shipping_id, $customer_id);
            $this->productBilling($order_id, $shipping_id);
            session()->flash('cart_status', 'Your Order Successfully Completed, <a href="https://mail.google.com" target="_blank">Please Check Confirmation Email Mail</a>');
            return redirect('/');
        }
        else{
            $shipping_id = $this->productShipping($request);
            $order_id = $this->productSale($request, $shipping_id);
            $this->productBilling($order_id, $shipping_id);
            Session::put('sub_total', $request->sub_total);
            return redirect()->route('stripe');
        }

    }

}
