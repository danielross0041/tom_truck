<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\MicrosoftController;
use App\Mail\mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/register-vendor', [IndexController::class, 'register_vendor'])->name('register_vendor');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/services', [IndexController::class, 'services'])->name('services');
Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
Route::get('/product', [IndexController::class, 'product'])->name('product');
Route::get('/product/{id}', [IndexController::class, 'categorized_product'])->name('categorized_product');
Route::get('/sellers', [IndexController::class, 'sellers'])->name('sellers');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/product-list/{id}', [IndexController::class, 'product_list'])->name('product_list');
Route::get('/blog-detail/{id}', [IndexController::class, 'blog_detail'])->name('blog_detail');
Route::get('/services-detail/{id}', [IndexController::class, 'services_detail'])->name('services_detail');


Route::post('/contact_submit', [IndexController::class, 'contact_submit'])->name('contact_submit');
Route::post('/customer_contact', [IndexController::class, 'customer_contact'])->name('customer_contact');
Route::post('/review_submit', [IndexController::class, 'review_submit'])->name('review_submit');
Route::post('/price_filter', [IndexController::class, 'price_filter'])->name('price_filter');





Route::get('/qr-code', [IndexController::class, 'qr_code'])->name('qr_code');


Route::group(['middleware' => 'auth'], function()
{

    Route::get('attribute/product-images/{id}', [HomeController::class, 'product_images'])->name('product_images');
    Route::post('/image_uploader', [GenericController::class, 'image_uploader'])->name('image_uploader');

    Route::get('/index', [HomeController::class, 'index_view'])->name('index_view');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/steps', [HomeController::class, 'steps'])->name('steps');
    Route::get('/switch-project/{id}', [HomeController::class, 'switch_project'])->name('switch_project');
    Route::get('/profile', [HomeController::class, 'user_profile'])->name('user_profile');
    Route::get('/user-profile', [HomeController::class , 'user_profile'])->name('user_profile');

    Route::get('/update-password', [HomeController::class , 'update_password'])->name('update_password');
    Route::post('/user-password-update', [HomeController::class, 'user_passwordupdate'])->name('user_passwordupdate');

    Route::get('logo', [HomeController::class , 'logo'])->name('logo');   
    Route::post('change_logo', [HomeController::class , 'change_logo'])->name('change_logo'); 
    
    Route::post('/user-info-update', [HomeController::class, 'user_infoupdate'])->name('user_infoupdate');
    Route::get('/user-office-details', [HomeController::class , 'user_office_details'])->name('user_office_details');
    Route::post('/user-office-info-update', [HomeController::class, 'user_office_infoupdate'])->name('user_office_infoupdate');
    Route::post('/user-file-info-update', [HomeController::class, 'user_file_infoupdate'])->name('user_file_infoupdate');
    Route::get('/user-file-details', [HomeController::class , 'user_file_details'])->name('user_file_details');
    Route::post('/user-photo-update', [HomeController::class, 'upload_image'])->name('upload_image');
    Route::post('/profile-submit', [HomeController::class, 'profile_submit'])->name('profile_submit');
    Route::get('/user-rights', [HomeController::class , 'user_rights'])->name('user_rights');
    Route::get('/inquiry-manage', [HomeController::class , 'inquiry_manage'])->name('inquiry_manage');
    // Reports Routes
    Route::post('/user-updates', [HomeController::class , 'user_updates'])->name('user_updates');
    Route::post('/shift-change', [HomeController::class , 'shift_change'])->name('shift_change');

    Route::get('/attribute/sub-category/{accessories_id?}/{category_id?}', [HomeController::class , 'subcategory'])->name('subcategory');


     
    // Reports Routes End
    
    Route::post('ckeditor/image_upload', [GenericController::class, 'upload'])->name('upload');


    Route::post('/cms_create', [GenericController::class , 'cms_generator'])->name('cms_generator');
    Route::post('/modalform', [GenericController::class , 'modalform'])->name('modalform');
    
    Route::post('/switch_top_category', [GenericController::class , 'switch_top_category'])->name('switch_top_category');
    Route::post('/featured_product', [GenericController::class , 'featured_product'])->name('featured_product');
    Route::post('/best_seller', [GenericController::class , 'best_seller'])->name('best_seller');
    

    Route::post('/remove_sale', [GenericController::class , 'remove_sale'])->name('remove_sale');
    Route::post('/sale_detail', [GenericController::class , 'sale_detail'])->name('sale_detail');
    Route::post('/active_ads', [GenericController::class , 'active_ads'])->name('active_ads');



    
    // Route::post('/upload', [GenericController::class , 'upload'])->name('upload');
    



    Route::post('/file_generator', [FileController::class , 'file_generator'])->name('file_generator');
    // Route::post('/import', [FileController::class , 'import'])->name('import');


    // Route::post('/export', [ImportExportController::class , 'export'])->name('export');
    // Route::post('/importExportView', [ImportExportController::class , 'importExportView'])->name('importExportView');
    // Route::post('/import', [ImportExportController::class , 'import'])->name('import');















    Route::post('/instructor_create', [GenericController::class , 'instructor_generator'])->name('instructor_generator');
    Route::post('/{slug?}/create', [GenericController::class , 'crud_generator'])->name('crud_generator');
    Route::post('/create-sale', [GenericController::class , 'sale_generator'])->name('sale_generator');


    Route::post('/{slug?}/product_create', [GenericController::class , 'product_generator'])->name('product_generator');
    Route::post('/{slug?}/variation_create', [GenericController::class , 'variation_generator'])->name('variation_generator');
    
    Route::post('/{slug?}/create_pro', [GenericController::class , 'pro_crud_generator'])->name('pro_crud_generator');
    Route::post('/{slug?}/create_product', [GenericController::class , 'pro_generator'])->name('pro_generator');
    Route::post('/{slug?}/create_cms', [GenericController::class , 'cms_crud_generator'])->name('cms_crud_generator');
    Route::post('/{slug?}/create_image', [GenericController::class , 'image_crud_generator'])->name('image_crud_generator');
    Route::post('/create_instructor', [GenericController::class , 'instructor_registration'])->name('instructor_registration');


    Route::get('/attributes', [GenericController::class , 'roles'])->name('roles');
    Route::get('/attribute/{slug}', [GenericController::class , 'listing'])->name('listing');
    Route::get('/attribute/product/{id}', [GenericController::class , 'variation_product'])->name('variation_product');
    Route::post('/delete-record', [GenericController::class , 'delete_record'])->name('delete_record');
    Route::post('/delete-pitcher', [GenericController::class , 'delete_pitcher'])->name('delete_pitcher');
    Route::post('/variation', [GenericController::class , 'variation'])->name('variation');
    Route::post('/setlist', [GenericController::class , 'setlist'])->name('setlist');
    Route::get('/report/{slug}', [GenericController::class , 'report_user'])->name('report_user');
    Route::post('/custom-report', [GenericController::class , 'custom_report'])->name('custom_report');
    Route::get('/custom-report/{slug}/{slug2}', [GenericController::class , 'custom_report_user'])->name('custom_report_user');
    Route::post('/generic-submit', [GenericController::class , 'generic_submit'])->name('generic_submit');
    Route::post('/assign-role-submit', [GenericController::class , 'roleassign_submit'])->name('roleassign_submit');
    Route::post('/role-assign-modal', [GenericController::class , 'role_assign_modal'])->name('role_assign_modal');
    
    // Player Details Routes

    Route::post('/attributes/approve_therapist', [GenericController::class , 'approve_therapist'])->name('approve_therapist');
    
    Route::post('/attributes/therapist_generator', [GenericController::class , 'therapist_generator'])->name('therapist_generator');
    Route::post('/attributes/therapist_details_generator', [GenericController::class , 'therapist_details_generator'])->name('therapist_details_generator');


    // Payroll Routes
  
    // Payroll Routes End


    // Leave Application Form

    
    // Send Message to telegram 
    Route::get('web-config', [HomeController::class , 'web_config'])->name('web_config');  
    Route::post('config-update', [HomeController::class , 'config_update'])->name('config_update');    
       
});






