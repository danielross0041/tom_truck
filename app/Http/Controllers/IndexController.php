<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\attributes;
use App\Models\company;
use App\Models\car_details;
use App\Models\category;
use App\Models\subcategory;
use App\Models\accessories;
use App\Models\brand;
use App\Models\blogs;
use App\Models\services;
use App\Models\contact_details;
use App\Models\product;
use App\Models\product_image;
use App\Models\customer_contact;
use App\Models\product_review;


use Illuminate\Support\Str;
use App\Mail\mailer;
use Session;
use Helper;
use Mail;
use Carbon\Carbon;
use \Crypt;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(){
        
        if (Auth::check()) {
            
            return redirect()->route('user_profile');
        }
        $title = 'Truck - Login';
        return view('auth.login')->with(compact('title'));
    }

    public function register_vendor(){
        // dd("here");
        
        if (Auth::check()) {
            
            return redirect()->route('user_profile');
        }
        $title = 'Truck - Vendor Registration';
        return view('auth.register')->with(compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $products = product::where('is_active',1)->take(6)->get();
        $services = services::where('is_active',1)->get();
        $blogs = blogs::where('is_active',1)->get();
        return view('web.index')->with(compact('services','blogs','products'));
    }
    
    public function about(){
        $admin = User::where('username','admin')->where('role_id',1)->first();
        return view('web.about')->with(compact('admin'));
    }
    public function services(){
        $services = services::where('is_active',1)->get();
        return view('web.services')->with(compact('services'));
    }
    public function blog(){
        $blogs = blogs::where('is_active',1)->get();
        return view('web.blog')->with(compact('blogs'));
    }
    public function blog_detail($id){
        $blog = blogs::where('id',$id)->first();
        return view('web.blog-detail')->with(compact('blog'));
    }
    public function product(){
        $categories = category::where('is_active',1)->get();
        $products = product::where('is_active',1)->paginate(12);
        return view('web.product')->with(compact('products','categories'));
    }
    public function categorized_product($id){
        $categories = category::where('is_active',1)->get();
        $products = product::where('is_active',1)->where('categoryid',$id)->paginate(12);
        return view('web.product')->with(compact('products','categories'));
    }
    public function sellers(){
        return view('web.sellers');
    }
    public function contact(){
        return view('web.contact');
    }
    public function product_list($id){
        $reviews = product_review::where('is_active',1)->where('product_id',$id)->get();
        $product = product::where('is_active',1)->where('id',$id)->first();
        $product_images = product_image::where('is_active',1)->where('product_id',$id)->get();
        // dd($product_images);
        return view('web.product-detail')->with(compact('product','product_images','reviews'));
    }
    public function services_detail($id){
        $service = services::where('id',$id)->first();
        return view('web.service-detail')->with(compact('service'));
    }

    public function contact_submit(Request $request)
    {
        try{
            $post_feilds = array();
            $post_feilds['name'] = $request->name;
            $post_feilds['email'] = $request->email;
            $post_feilds['subject'] = $request->subject;
            $post_feilds['message'] = $request->message;
            $create = contact_details::create($post_feilds);
            return redirect()->back()->with('message', 'Contact Submitted');
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }


    public function customer_contact(Request $request)
    {
        try{
            $post_feilds = array();
            $post_feilds['product_id'] = $request->product_id;
            $post_feilds['first_name'] = $request->first_name;
            $post_feilds['last_name'] = $request->last_name;
            $post_feilds['email'] = $request->email;
            $post_feilds['subject'] = $request->subject;
            $post_feilds['message'] = $request->message;
            $create = customer_contact::create($post_feilds);
            return redirect()->back()->with('message', 'Order has been placed');
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function review_submit(Request $request)
    {
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try{
            $create = product_review::create($post_feilds);
            return redirect()->back()->with('message', 'Review has been Submitted');
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }

    public function price_filter(Request $request)
    {

        $price = (int)$request->price;
        $products = product::where('is_active',1)->where('price','<=',$price)->get();
        // dd($products);
        $body = '<div class="row">';
        if (!$products->isEmpty()) {
            foreach ($products as $key => $value) {
                $route = route('product_list',$value->id);
                $body .= '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                            <div class="product-listing-item">
                                <img src="'.asset($value->image).'" alt="img" class="img-fluid">
                                <div class="product-item-content">
                                    <a href="'.$route.'"><h4>'.$value->name.' | '.$value->category->name.'</h4></a>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>
                                <button class="contact-now-btn" id="customer_contact" data-product_id="'.$value->id.'" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact Now</button>
                            </div>
                        </div>';
            }
        } else{
            $body .= '<h4>No Product Found</h4>
                </div>';
        }
        $status['message'] = $body;
        $status['status'] = 1;
        return json_encode($status);
    }















    public function qr_code()
    {
        return view('web.qr_code');
    }
    
    
    

}
