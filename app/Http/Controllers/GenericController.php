<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestAttributes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\attributes;
use App\Models\role_assign;
use App\Models\web_cms;
use App\Models\category;
use App\Models\customer_contact;

use App\Models\production_schedule;
use App\Models\product_image;

use Illuminate\Support\Str;
use Session;
use Helper;

class GenericController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $user = Helper::curren_user();

        // $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        // $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        
        // View()->share('att_tag',$att_tag);
        // View()->share('role_assign',$role_assign);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roles()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', "No Link found");
        }
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active' ,1)->get();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        
        return view('roles/roles')->with(compact('attributes','att_tag','role_assign'));
    }
    
    public function generic_submit(RequestAttributes $request)
    {
        // $user = User::find(Auth::user()->id);
        // $columns  = \Schema::getColumnListing("attributes");
        // $ignore = ['id' , 'is_active' ,'is_deleted' , 'created_at' , 'updated_at' ,'deleted_at'];
        //$push_in = array_diff($columns, $ignore);

        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        
        try{
            attributes::insert($post_feilds);
            return redirect()->back()->with('message', 'Information updated successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Error will saving record');
        }
    }

    public function role_assign_modal()
    {
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$_POST['role_id'])->orderBy('id','desc')->first();
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $body = "";
        if ($att_tag) {
            $route = route('roleassign_submit');
            $body .= "<input type='hidden' name='role_id' id='fetch-role-id' value='".$_POST['role_id']."'>";
            if ($role_assign && $role_assign->assignee!='N;') {
                $checker = unserialize($role_assign->assignee);
                $body .= "<input type='hidden' name='record_id' value='".$role_assign->id."'>";
            }else{
                $checker = [];
            }
            foreach($att_tag as $key => $role){
                $body .= "<tr><td>".ucwords($role->attribute)."</td><td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck1".$key."' ";
                                   if(in_array($role->attribute."_1", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_1'>
                                  <label class='custom-control-label' for='customCheck1".$key."'>1</label></div></td>
                            
                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck2".$key."' ";
                                   if(in_array($role->attribute."_2", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_2'>
                                  <label class='custom-control-label' for='customCheck2".$key."'>2</label></div></td>

                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck3".$key."' ";
                                   if(in_array($role->attribute."_3", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_3'>
                                  <label class='custom-control-label' for='customCheck3".$key."'>3</label></div></td>

                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck4".$key."' ";
                                   if(in_array($role->attribute."_4", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_4'>
                                  <label class='custom-control-label' for='customCheck4".$key."'>4</label></div></td></tr>";    
            }
        }

        $bod['body'] = $body;
        $response = json_encode($bod);
        return $response;
    }

    public function roleassign_submit(Request $request)
    {
        if (isset($request->record_id) && $request->record_id != 0) {
            $role_assign = role_assign::where('is_active' ,1)->where("id" ,$request->record_id)->first();
        }else{
            $role_assign = new role_assign;
            $role_assign->role_id = $request->role_id;    
        }
        
        $role_assign->assignee = serialize($request->assignee);
        $role_assign->save();
        return redirect()->back()->with('message', 'Role has been assigned successfully');
    }

    public function listing($slug='')
    {
        if ($slug == 'contact') {
            $slug = "contact_details";
        }
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        }else{
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }
        
        $form = null;
        $table = null;
        $eloquent = '';
        if($slug == "roles"){
            $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();

            $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
            $is_hide = 0;
        }else{
            $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
            $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
            $get_eloquent = attributes::where('is_active' ,1)->where('attribute' , $slug)->first();
            $eloquent = ($get_eloquent->model != '')?$get_eloquent->model:'';
            $is_hide = 1;
            if ($eloquent != '') {
                $form = $this->generated_form($slug);
                $table = $this->generated_table($slug);
            }

        }
        return view('roles/crud')->with(compact('attributes','att_tag','role_assign','validator','slug','is_hide','eloquent','form','table'));
    }
    
    private function generated_form($slug = '')
    {
        $body = '';

        if ($slug == 'testimonials') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } elseif ($slug == 'blogs') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Title:</label>
                                <div class="d-flex">
                                    <input id="title" placeholder="Tile" name="title" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" accept="image/*" name="image" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <div class="d-flex">
                                    <td><img id="image-add" style="width:80px;height:80px;display:none;" src=""></td>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } elseif ($slug == 'product') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Vehicle Information:</b></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Category:</label>
                                <div class="d-flex">
                                    <select name="categoryid" id="categoryid" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Category</option>';
                                        $category= category::where("is_active",1)->where("is_deleted",0)->get();
                                        foreach($category as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                        }
                                        
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Price:</label>
                                <div class="d-flex">
                                    <input id="price" placeholder="Price" name="price" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" accept="image/*" name="image" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>General:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Year:</label>
                                <div class="d-flex">
                                    <input id="year" placeholder="Year" name="year" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Manufacturer:</label>
                                <div class="d-flex">
                                    <input id="manufacturer" placeholder="Manufacturer" name="manufacturer" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Model:</label>
                                <div class="d-flex">
                                    <input id="model" placeholder="Model" name="model" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">VIN:</label>
                                <div class="d-flex">
                                    <input id="vin" placeholder="VIN" name="vin" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">GVWR:</label>
                                <div class="d-flex">
                                    <input id="gvwr" placeholder="GVWR" name="gvwr" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Interior Information:</b></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Seats:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Driver:</label>
                                <div class="d-flex">
                                    <select name="driver_seat" id="driver_seat" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Driver Seat</option>
                                            <option value="Air">Air</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Bench">Bench</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Pessenger:</label>
                                <div class="d-flex">
                                    <select name="pessenger_seat" id="pessenger_seat" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Pessenger Seat</option>
                                            <option value="Air">Air</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Bench">Bench</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Radio:</label>
                                <div class="d-flex">
                                    <select name="radio" id="radio" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Radio</option>
                                            <option value="CD">CD</option>
                                            <option value="Cassette">Cassette</option>
                                            <option value="AM/FM">AM/FM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Sleeper Size:</label>
                                <div class="d-flex">
                                    <input id="sleeper_size" placeholder="Sleeper Size" name="sleeper_size" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Sleeper Type:</label>
                                <div class="d-flex">
                                    <select name="sleeper" id="sleeper" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Sleeper</option>
                                            <option value="Single Bunk">Single Bunk</option>
                                            <option value="Double Bunk">Double Bunk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Air Conditioning:</label>
                                <div class="d-flex">
                                    <label for="air_condition_Yes">Yes</label><br>
                                    <input type="radio" id="air_condition_Yes" name="air_condition" value="Yes" required>
                                    <label for="air_condition_No">No</label><br>
                                    <input type="radio" id="air_condition_No" name="air_condition" value="No">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Machenical Information:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Mileage:</label>
                                <div class="d-flex">
                                    <input id="mileage" placeholder="Mileage" name="mileage" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Hours:</label>
                                <div class="d-flex">
                                    <input id="hours" placeholder="Hours" name="hours" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine:</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine Manufacturer:</label>
                                <div class="d-flex">
                                    <input id="engine_manufacturer" placeholder="Engine Manufacturer" name="engine_manufacturer" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine Model:</label>
                                <div class="d-flex">
                                    <input id="engine_model" placeholder="Engine Model" name="engine_model" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Horsepower:</label>
                                <div class="d-flex">
                                    <input id="horsepower" placeholder="Horsepower" name="horsepower" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Transmission:</label>
                                <div class="d-flex">
                                    <input id="transmission" placeholder="Transmission" name="transmission" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Axle Rating(GVWR):</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Front Axle:</label>
                                <div class="d-flex">
                                    <input id="front_axle" placeholder="Front Axle" name="front_axle" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Driver Axle:</label>
                                <div class="d-flex">
                                    <input id="driver_axle" placeholder="Driver Axle" name="driver_axle" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Ratio:</label>
                                <div class="d-flex">
                                    <input id="ratio" placeholder="Ratio" name="ratio" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Tag, Pusher, Cheater axle:</label>
                                <div class="d-flex">
                                    <input id="tag_axle" placeholder="Tag, Pusher, Cheater axle" name="tag_axle" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Power Steering:</label>
                                <div class="d-flex">
                                    <label for="power_steering_Yes">Yes</label><br>
                                    <input type="radio" id="power_steering_Yes" name="power_steering" value="Yes" required>
                                    <label for="power_steering_No">No</label><br>
                                    <input type="radio" id="power_steering_No" name="power_steering" value="No">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Jake Brake:</label>
                                <div class="d-flex">
                                    <label for="jake_brake_Yes">Yes</label><br>
                                    <input type="radio" id="jake_brake_Yes" name="jake_brake" value="Yes" required>
                                    <label for="jake_brake_No">No</label><br>
                                    <input type="radio" id="jake_brake_No" name="jake_brake" value="No">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">5th Wheel:</label>
                                <div class="d-flex">
                                    <select name="tth_wheel" id="tth_wheel" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select 5th Wheel</option>
                                            <option value="Air Slide">Air Slide</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Manual Slide">Manual Slide</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Exterior Information:</b></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wheel Base:</label>
                                <div class="d-flex">
                                    <input id="wheel_base" placeholder="Wheel Base" name="wheel_base" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">CA or CT:</label>
                                <div class="d-flex">
                                    <input id="ca_ct" placeholder="CA or CT" name="ca_ct" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Cab to end of Frame:</label>
                                <div class="d-flex">
                                    <input id="end_of_frame" placeholder="Cab to end of Frame" name="end_of_frame" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wheel Type:</label>
                                <div class="d-flex">
                                    <select name="wheels" id="wheels" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Wheel Type</option>
                                            <option value="Steel">Steel</option>
                                            <option value="Alum">Alum</option>
                                            <option value="Dayton">Dayton</option>
                                            <option value="BUD">BUD</option>
                                            <option value="Hub Pilot">Hub Pilot</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Tires:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Front Tire Size:</label>
                                <div class="d-flex">
                                    <input id="front_tire_size" placeholder="Front Tire Size" name="front_tire_size" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Rare Tire Size:</label>
                                <div class="d-flex">
                                    <input id="rare_tire_size" placeholder="Rare Tire Size" name="rare_tire_size" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Fuel Tanks:</b></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Fuel Tank Type:</label>
                                <div class="d-flex">
                                    <select name="fuel_tank" id="fuel_tank" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Fuel Tank Type</option>
                                            <option value="Steel">Steel</option>
                                            <option value="Alum">Alum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Number of Tanks:</label>
                                <div class="d-flex">
                                    <input id="no_of_tanks" placeholder="Number of Tanks" name="no_of_tanks" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Gallons:</label>
                                <div class="d-flex">
                                    <input id="gallons" placeholder="Gallons" name="gallons" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Steer R:</label>
                                <div class="d-flex">
                                    <input id="steer_r" placeholder="Steer R" name="steer_r" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Steer L:</label>
                                <div class="d-flex">
                                    <input id="steer_l" placeholder="Steer L" name="steer_l" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive FR:</label>
                                <div class="d-flex">
                                    <input id="drive_fr" placeholder="Drive FR" name="drive_fr" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive FL:</label>
                                <div class="d-flex">
                                    <input id="drive_fl" placeholder="Drive FL" name="drive_fl" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive RR:</label>
                                <div class="d-flex">
                                    <input id="drive_rr" placeholder="Drive RR" name="drive_rr" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive RL:</label>
                                <div class="d-flex">
                                    <input id="drive_rl" placeholder="Drive RL" name="drive_rl" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Suspension:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Suspension Type:</label>
                                <div class="d-flex">
                                    <select name="suspension" id="suspension" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Suspension Type</option>
                                            <option value="Air Ride">Air Ride</option>
                                            <option value="Spring Ride">Spring Ride</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Suspension Type:</label>
                                <div class="d-flex">
                                    <input id="suspension_type" placeholder="Suspension Type" name="suspension_type" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Brakes:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Brakes Type:</label>
                                <div class="d-flex">
                                    <select name="brakes" id="brakes" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Brakes Type</option>
                                            <option value="Hydraulic">Hydraulic</option>
                                            <option value="Air">Air</option>
                                            <option value="Disk">Disk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Accessories:</b></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <div class="d-flex">
                                    <div class="custom-check-input">
                                    <label for="apu">APU</label>
                                    <input type="checkbox" id="apu" name="accessories[]" value="apu">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="headache_rack">Headache Rack</label>
                                    <input type="checkbox" id="headache_rack" name="accessories[]" value="headache_rack">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="power_locks">Power Locks</label>
                                    <input type="checkbox" id="power_locks" name="accessories[]" value="power_locks">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="cruise_control">Cruise Control</label>
                                    <input type="checkbox" id="cruise_control" name="accessories[]" value="cruise_control">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="diff_locks">Diff Locks</label>
                                    <input type="checkbox" id="diff_locks" name="accessories[]" value="diff_locks">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="full_lockers">Full Lockers</label>
                                    <input type="checkbox" id="full_lockers" name="accessories[]" value="full_lockers">  
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="dual_air_breathers">Dual Air Breathers</label>
                                    <input type="checkbox" id="dual_air_breathers" name="accessories[]" value="dual_air_breathers">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="dual_exhaust">Dual Exhaust</label>
                                    <input type="checkbox" id="dual_exhaust" name="accessories[]" value="dual_exhaust">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="dual_frame">Double Frame</label>
                                    <input type="checkbox" id="dual_frame" name="accessories[]" value="dual_frame">
                                    </div>
                                    <div class="custom-check-input">
                                    <label for="tool_box">Tool Box</label>
                                    <input type="checkbox" id="tool_box" name="accessories[]" value="tool_box">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Mirror:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Mirror Type:</label>
                                <div class="d-flex">
                                    <select name="mirror" id="mirror" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Mirror Type</option>
                                            <option value="Heated">Heated</option>
                                            <option value="Power">Power</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Side:</label>
                                <div class="d-flex">
                                    <input id="mirror_side" placeholder="Side" name="mirror_side" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Windows:</label>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Window Type:</label>
                                <div class="d-flex">
                                    <select name="window" id="window" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Window Type</option>
                                            <option value="Power">Power</option>
                                            <option value="Air">Air</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Side:</label>
                                <div class="d-flex">
                                    <input id="window_side" placeholder="Side" name="window_side" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wet Kit:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wet Kit Type:</label>
                                <div class="d-flex">
                                    <select name="wet_kit" id="wet_kit" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Wet Kit Type</option>
                                            <option value="1 Line">1 Line</option>
                                            <option value="2 Line">2 Line</option>
                                            <option value="3 Line">3 Line</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Body:</b></label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Body Type:</label>
                                <div class="d-flex">
                                    <select name="body" id="body" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Body Type</option>
                                            <option value="Flat Bed">Flat Bed</option>
                                            <option value="Dump Body">Dump Body</option>
                                            <option value="Tank">Tank</option>
                                            <option value="Dry Van">Dry Van</option>
                                            <option value="Reefer">Reefer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-3" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Length:</label>
                                <div class="d-flex">
                                    <input id="body_lenght" placeholder="Length" name="body_lenght" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-3" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Width:</label>
                                <div class="d-flex">
                                    <input id="body_width" placeholder="Width" name="body_width" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-3" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Height:</label>
                                <div class="d-flex">
                                    <input id="body_height" placeholder="Height" name="body_height" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-3" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Gallons:</label>
                                <div class="d-flex">
                                    <input id="body_gallons" placeholder="Gallons" name="body_gallons" class="form-control" type="number" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } elseif ($slug == 'services') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Title:</label>
                                <div class="d-flex">
                                    <input id="title" placeholder="Tile" name="title" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" accept="image/*" name="image" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <div class="d-flex">
                                    <td><img id="image-add" style="width:80px;height:80px;display:none;" src=""></td>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } elseif ($slug == 'category') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Category:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Category" name="name" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </form>';
            return $body;
        } elseif ($slug == 'fileUploader') {
            $route_url = route('file_generator');
            $body = '<form class="" id="generic-form" enctype="multipart/form-data" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-6 col-sm-6 col-6 im" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">File:</label>
                                <div class="d-flex">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else{
            return $body;
        }
    }

    private function generated_table($slug='')
    {
        

        $body = '';
        if ($slug == "testimonials") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td> 
                                          <td>'.$val->desc.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc= "'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "vendors") {
            $loop = User::where("is_active" ,1)->where("is_deleted" ,0)->where('role_id',3)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Contact Number</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td> 
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->contact_number.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Contact Number</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "category") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>';
                                          if ($val->user_id == Auth::user()->id || Auth::user()->role_id == 1) {
                                            $body .= '<button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-user_id="'.$val->user_id.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>';
                                          }
                                             
                                          $body .= '</td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#user_id").val($(this).data("user_id"))
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "blogs") {
            $data = 'App\Models\\'.$slug;
            $user = Auth::user();
            if ($user->role_id == 1) {
                $loop = $data::where("is_deleted" ,0)->get();
            } else{
                $loop = $data::where("is_deleted" ,0)->where('user_id',$user->id)->get();
            }
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Author</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->title.'</td>
                                          <td>'.$val->desc.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.$val->author->name.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-title= "'.$val->title.'" data-image="'.$i.'" data-desc="'.$val->desc.'" data-user_id="'.$val->user_id.'">Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Author</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#title").val($(this).data("title"))
                                                $("#user_id").val($(this).data("user_id"))
                                                $("#image").removeAttr("required");
                                                $("#image-add").css("display","");
                                                $("#image-add").attr("src",$(this).data("image"));
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "contact-details") {
            $data = 'App\Models\contact_details';
            $user = Auth::user();
            if ($user->role_id == 1) {
                $loop = $data::all();
            } else{
                $loop = $data::where("is_deleted" ,0)->where('user_id',$user->id)->get();
            }
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Subject</th>
                                          <th>Message</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->subject.'</td>
                                          <td>'.$val->message.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Subject</th>
                                          <th>Message</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "services") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->title.'</td>
                                          <td>'.$val->desc.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-title= "'.$val->title.'" data-image="'.$i.'" data-desc="'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#title").val($(this).data("title"))
                                                $("#image").removeAttr("required");
                                                $("#image-add").css("display","");
                                                $("#image-add").attr("src",$(this).data("image"));
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "product-inquiry") {
            $loop = customer_contact::where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Product</th>
                                          <th>Vendor Name</th>
                                          <th>Vendor Email</th>
                                          <th>Customer Name</th>
                                          <th>Customer Email</th>
                                          <th>Subject</th>
                                          <th>Message</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->product->name.'</td>
                                          <td>'.$val->product->owner->name.'</td>
                                          <td>'.$val->product->owner->email.'</td>
                                          <td>'.$val->first_name.' '.$val->last_name.'</td>
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->subject.'</td>
                                          <td>'.$val->message.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Product</th>
                                          <th>Vendor Name</th>
                                          <th>Vendor Email</th>
                                          <th>Customer Name</th>
                                          <th>Customer Email</th>
                                          <th>Subject</th>
                                          <th>Message</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "product") {
            $data = 'App\Models\\'.$slug;
            $user = Auth::user();
            if ($user->role_id == 1) {
                $loop = $data::where("is_deleted" ,0)->get();
            } else{
                $loop = $data::where("is_deleted" ,0)->where('user_id',$user->id)->get();
            }
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Name</th>
                                          <th>Price</th>
                                          <th>Image</th>
                                          <th>Added By</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                        $url = route('product_images',$val->id);
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->category->name.'</td>
                                          <td>'.$val->name.'</td>
                                          <td>$'.$val->price.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.$val->owner->name.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <a href="'.$url.'" class="btn btn-secondary" style="color:white;">Pictures</a>
                                             <button type="button" class="btn btn-info show-form-product" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-image="'.$i.'" data-price="'.$val->price.'" data-user_id="'.$val->user_id.'" data-categoryid="'.$val->categoryid.'" data-year="'.$val->year.'" data-manufacturer="'.$val->manufacturer.'" data-model="'.$val->model.'" data-vin="'.$val->vin.'" data-gvwr="'.$val->gvwr.'" data-desc="'.$val->desc.'" data-driver_seat="'.$val->driver_seat.'" data-pessenger_seat="'.$val->pessenger_seat.'" data-radio="'.$val->radio.'" data-sleeper_size="'.$val->sleeper_size.'" data-sleeper="'.$val->sleeper.'" data-air_condition="'.$val->air_condition.'" data-mileage="'.$val->mileage.'" data-hours="'.$val->hours.'" data-engine_manufacturer="'.$val->engine_manufacturer.'" data-engine_model="'.$val->engine_model.'" data-horsepower="'.$val->horsepower.'" data-transmission="'.$val->transmission.'" data-front_axle="'.$val->front_axle.'" data-driver_axle="'.$val->driver_axle.'" data-ratio="'.$val->ratio.'" data-tag_axle="'.$val->tag_axle.'" data-power_steering="'.$val->power_steering.'" data-jake_brake="'.$val->jake_brake.'" data-th_wheel="'.$val->tth_wheel.'" data-wheel_base="'.$val->wheel_base.'" data-ca_ct="'.$val->ca_ct.'" data-end_of_frame="'.$val->end_of_frame.'" data-wheels="'.$val->wheels.'" data-front_tire_size="'.$val->front_tire_size.'" data-rare_tire_size="'.$val->rare_tire_size.'" data-fuel_tank="'.$val->fuel_tank.'" data-no_of_tanks="'.$val->no_of_tanks.'" data-gallons="'.$val->gallons.'" data-steer_r="'.$val->steer_r.'" data-steer_l="'.$val->steer_l.'" data-drive_fr="'.$val->drive_fr.'" data-drive_fl="'.$val->drive_fl.'" data-drive_rr="'.$val->drive_rr.'" data-drive_rl="'.$val->drive_rl.'" data-suspension="'.$val->suspension.'" data-suspension_type="'.$val->suspension_type.'" data-brakes="'.$val->brakes.'" data-mirror="'.$val->mirror.'" data-mirror_side="'.$val->mirror_side.'" data-window="'.$val->window.'" data-window_side="'.$val->window_side.'" data-wet_kit="'.$val->wet_kit.'" data-body="'.$val->body.'" data-body_lenght="'.$val->body_lenght.'" data-body_width="'.$val->body_width.'" data-body_height="'.$val->body_height.'" data-body_gallons="'.$val->body_gallons.'" data-accessories="';
                                                 $accessories= unserialize($val->accessories);
                                                 // dd($accessories);
                                                 foreach ($accessories as $key => $value) {
                                                     $body .= $value.',';
                                                 }
                                                 $body.='">Show</button>



                                             <button type="button" class="btn btn-primary editor-form-product" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-image="'.$i.'" data-price="'.$val->price.'" data-user_id="'.$val->user_id.'" data-categoryid="'.$val->categoryid.'" data-year="'.$val->year.'" data-manufacturer="'.$val->manufacturer.'" data-model="'.$val->model.'" data-vin="'.$val->vin.'" data-gvwr="'.$val->gvwr.'" data-desc="'.$val->desc.'" data-driver_seat="'.$val->driver_seat.'" data-pessenger_seat="'.$val->pessenger_seat.'" data-radio="'.$val->radio.'" data-sleeper_size="'.$val->sleeper_size.'" data-sleeper="'.$val->sleeper.'" data-air_condition="'.$val->air_condition.'" data-mileage="'.$val->mileage.'" data-hours="'.$val->hours.'" data-engine_manufacturer="'.$val->engine_manufacturer.'" data-engine_model="'.$val->engine_model.'" data-horsepower="'.$val->horsepower.'" data-transmission="'.$val->transmission.'" data-front_axle="'.$val->front_axle.'" data-driver_axle="'.$val->driver_axle.'" data-ratio="'.$val->ratio.'" data-tag_axle="'.$val->tag_axle.'" data-power_steering="'.$val->power_steering.'" data-jake_brake="'.$val->jake_brake.'" data-th_wheel="'.$val->tth_wheel.'" data-wheel_base="'.$val->wheel_base.'" data-ca_ct="'.$val->ca_ct.'" data-end_of_frame="'.$val->end_of_frame.'" data-wheels="'.$val->wheels.'" data-front_tire_size="'.$val->front_tire_size.'" data-rare_tire_size="'.$val->rare_tire_size.'" data-fuel_tank="'.$val->fuel_tank.'" data-no_of_tanks="'.$val->no_of_tanks.'" data-gallons="'.$val->gallons.'" data-steer_r="'.$val->steer_r.'" data-steer_l="'.$val->steer_l.'" data-drive_fr="'.$val->drive_fr.'" data-drive_fl="'.$val->drive_fl.'" data-drive_rr="'.$val->drive_rr.'" data-drive_rl="'.$val->drive_rl.'" data-suspension="'.$val->suspension.'" data-suspension_type="'.$val->suspension_type.'" data-brakes="'.$val->brakes.'" data-mirror="'.$val->mirror.'" data-mirror_side="'.$val->mirror_side.'" data-window="'.$val->window.'" data-window_side="'.$val->window_side.'" data-wet_kit="'.$val->wet_kit.'" data-body="'.$val->body.'" data-body_lenght="'.$val->body_lenght.'" data-body_width="'.$val->body_width.'" data-body_height="'.$val->body_height.'" data-body_gallons="'.$val->body_gallons.'"data-accessories="';
                                                 $accessories= unserialize($val->accessories);
                                                 // dd($accessories);
                                                 foreach ($accessories as $key => $value) {
                                                     $body .= $value.',';
                                                 }
                                                 $body.='">Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Name</th>
                                          <th>Price</th>
                                          <th>Image</th>
                                          <th>Added By</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".show-form-product",function(){
                                                $("#user_id").val($(this).data("user_id"))
                                                $("#categoryid").val($(this).data("categoryid"))
                                                $("#name").val($(this).data("name"))
                                                $("#image").removeAttr("required");
                                                $("#price").val($(this).data("price"))
                                                $("#year").val($(this).data("year"))
                                                $("#manufacturer").val($(this).data("manufacturer"))
                                                $("#model").val($(this).data("model"))
                                                $("#vin").val($(this).data("vin"))
                                                $("#gvwr").val($(this).data("gvwr"))
                                                $("#driver_seat").val($(this).data("driver_seat"))
                                                $("#pessenger_seat").val($(this).data("pessenger_seat"))
                                                $("#radio").val($(this).data("radio"))
                                                $("#sleeper_size").val($(this).data("sleeper_size"))
                                                $("#sleeper").val($(this).data("sleeper"))
                                                $("#air_condition_"+$(this).data("air_condition")).prop("checked",true);
                                                $("#mileage").val($(this).data("mileage"))
                                                $("#hours").val($(this).data("hours"))
                                                $("#engine_manufacturer").val($(this).data("engine_manufacturer"))
                                                $("#engine_model").val($(this).data("engine_model"))
                                                $("#horsepower").val($(this).data("horsepower"))
                                                $("#transmission").val($(this).data("transmission"))
                                                $("#front_axle").val($(this).data("front_axle"))
                                                $("#driver_axle").val($(this).data("driver_axle"))
                                                $("#ratio").val($(this).data("ratio"))
                                                $("#tag_axle").val($(this).data("tag_axle"))
                                                $("#power_steering_"+$(this).data("power_steering")).prop("checked",true);


                                                var accessories = $(this).data("accessories")
                                                var accArr = accessories.split(",");
                                                for (let i = 0; i < accArr.length-1; i++) {
                                                    $("#"+accArr[i]).prop("checked",true);
                                                }
                                                $("#jake_brake_"+$(this).data("jake_brake")).prop("checked",true);
                                                $("#tth_wheel").val($(this).data("th_wheel"))
                                                $("#wheel_base").val($(this).data("wheel_base"))
                                                $("#ca_ct").val($(this).data("ca_ct"))
                                                $("#end_of_frame").val($(this).data("end_of_frame"))
                                                $("#wheels").val($(this).data("wheels"))
                                                $("#front_tire_size").val($(this).data("front_tire_size"))
                                                $("#rare_tire_size").val($(this).data("rare_tire_size"))
                                                $("#fuel_tank").val($(this).data("fuel_tank"))
                                                $("#no_of_tanks").val($(this).data("no_of_tanks"))
                                                $("#gallons").val($(this).data("gallons"))
                                                $("#steer_r").val($(this).data("steer_r"))
                                                $("#steer_l").val($(this).data("steer_l"))
                                                $("#drive_fr").val($(this).data("drive_fr"))
                                                $("#drive_fl").val($(this).data("drive_fl"))
                                                $("#drive_rr").val($(this).data("drive_rr"))
                                                $("#drive_rl").val($(this).data("drive_rl"))
                                                $("#suspension").val($(this).data("suspension"))
                                                $("#suspension_type").val($(this).data("suspension_type"))
                                                $("#brakes").val($(this).data("brakes"))
                                                $("#mirror").val($(this).data("mirror"))
                                                $("#mirror_side").val($(this).data("mirror_side"))
                                                $("#window").val($(this).data("window"))
                                                $("#window_side").val($(this).data("window_side"))
                                                $("#wet_kit").val($(this).data("wet_kit"))
                                                $("#body").val($(this).data("body"))
                                                $("#body_lenght").val($(this).data("body_lenght"))
                                                $("#body_width").val($(this).data("body_width"))
                                                $("#body_height").val($(this).data("body_height"))
                                                $("#body_gallons").val($(this).data("body_gallons"))
                                                
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#generic-form").find("textarea,input,select").each(function(i,e){
                                                    $(e).attr("disabled",true);
                                                });
                                                $("#add-generic").css("display","none")
                                                $("#addevent").modal("show")
                                            })
                                            $("body").on("click" ,".editor-form-product",function(){
                                                $("#user_id").val($(this).data("user_id"))
                                                $("#categoryid").val($(this).data("categoryid"))
                                                $("#name").val($(this).data("name"))
                                                $("#image").removeAttr("required");
                                                $("#price").val($(this).data("price"))
                                                $("#year").val($(this).data("year"))
                                                $("#manufacturer").val($(this).data("manufacturer"))
                                                $("#model").val($(this).data("model"))
                                                $("#vin").val($(this).data("vin"))
                                                $("#gvwr").val($(this).data("gvwr"))
                                                $("#driver_seat").val($(this).data("driver_seat"))
                                                $("#pessenger_seat").val($(this).data("pessenger_seat"))
                                                $("#radio").val($(this).data("radio"))
                                                $("#sleeper_size").val($(this).data("sleeper_size"))
                                                $("#sleeper").val($(this).data("sleeper"))
                                                $("#air_condition_"+$(this).data("air_condition")).prop("checked",true);
                                                $("#mileage").val($(this).data("mileage"))
                                                $("#hours").val($(this).data("hours"))
                                                $("#engine_manufacturer").val($(this).data("engine_manufacturer"))
                                                $("#engine_model").val($(this).data("engine_model"))
                                                $("#horsepower").val($(this).data("horsepower"))
                                                $("#transmission").val($(this).data("transmission"))
                                                $("#front_axle").val($(this).data("front_axle"))
                                                $("#driver_axle").val($(this).data("driver_axle"))
                                                $("#ratio").val($(this).data("ratio"))
                                                $("#tag_axle").val($(this).data("tag_axle"))
                                                $("#power_steering_"+$(this).data("power_steering")).prop("checked",true);


                                                var access = $(this).data("accessories")
                                                var accArray = access.split(",");
                                                for (let i = 0; i < accArray.length-1; i++) {
                                                    $("#"+accArray[i]).prop("checked",true);
                                                }
                                                $("#jake_brake_"+$(this).data("jake_brake")).prop("checked",true);
                                                $("#tth_wheel").val($(this).data("th_wheel"))
                                                $("#wheel_base").val($(this).data("wheel_base"))
                                                $("#ca_ct").val($(this).data("ca_ct"))
                                                $("#end_of_frame").val($(this).data("end_of_frame"))
                                                $("#wheels").val($(this).data("wheels"))
                                                $("#front_tire_size").val($(this).data("front_tire_size"))
                                                $("#rare_tire_size").val($(this).data("rare_tire_size"))
                                                $("#fuel_tank").val($(this).data("fuel_tank"))
                                                $("#no_of_tanks").val($(this).data("no_of_tanks"))
                                                $("#gallons").val($(this).data("gallons"))
                                                $("#steer_r").val($(this).data("steer_r"))
                                                $("#steer_l").val($(this).data("steer_l"))
                                                $("#drive_fr").val($(this).data("drive_fr"))
                                                $("#drive_fl").val($(this).data("drive_fl"))
                                                $("#drive_rr").val($(this).data("drive_rr"))
                                                $("#drive_rl").val($(this).data("drive_rl"))
                                                $("#suspension").val($(this).data("suspension"))
                                                $("#suspension_type").val($(this).data("suspension_type"))
                                                $("#brakes").val($(this).data("brakes"))
                                                $("#mirror").val($(this).data("mirror"))
                                                $("#mirror_side").val($(this).data("mirror_side"))
                                                $("#window").val($(this).data("window"))
                                                $("#window_side").val($(this).data("window_side"))
                                                $("#wet_kit").val($(this).data("wet_kit"))
                                                $("#body").val($(this).data("body"))
                                                $("#body_lenght").val($(this).data("body_lenght"))
                                                $("#body_width").val($(this).data("body_width"))
                                                $("#body_height").val($(this).data("body_height"))
                                                $("#body_gallons").val($(this).data("body_gallons"))

                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#generic-form").find("select,textarea,input").each(function(i,e){
                                                    $(e).prop("disabled",false);
                                                });
                                                $("#add-generic").css("display","")
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "fileUploader") {
            $loop = production_schedule::where("is_active" ,1)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Batch</th>
                                          <th>Product</th>
                                          <th>MRP</th>
                                          <th>Quantity</th>
                                          <th>size</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->batch.'</td>
                                          <td>'.$val->product.'</td>
                                          <td>'.$val->mrp.'</td>
                                          <td>'.$val->quantity.'</td>
                                          <td>'.$val->size.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Batch</th>
                                          <th>Product</th>
                                          <th>MRP</th>
                                          <th>Quantity</th>
                                          <th>size</th>
                                          <th>Creation Date</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else{
            return $body;
        }
    }

    public function report_user($slug)
    {
        $user = Auth::user();
        
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        }else{
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }
        
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
        return view('reports/report_generic_user')->with(compact('attributes','att_tag','role_assign','validator','slug'));
    }

    public function custom_report()
    {
        $status['status'] = 0;
        if (isset($_POST['role_id'])) {
            $attributes = attributes::find($_POST['role_id']);
            if ($attributes->attribute == "departments") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->name)]);

                return json_encode($status);
            }elseif ($attributes->attribute == "designations") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->name)]);
                return json_encode($status);
            }elseif ($attributes->attribute == "roles") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->role)]);
                return json_encode($status);
            }else{
                $status['status'] = 0;
                return json_encode($status);
            }
        }else{
            $status['status'] = 0;
            return json_encode($status);
        }
    }

    public function custom_report_user($slug='',$slug2='')
    {
        $attributes = attributes::where("attribute" , $slug)->first();
        $designation = attributes::where("is_active" , 1)->get();
        $project_id = Session::get("project_id");
        if ($attributes) {

            if ($attributes->attribute == "departments") {
                $all_user = User::where("is_active" , 1)->where("department" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }elseif ($attributes->attribute == "designations") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2));
                $attributes = attributes::where("attribute" , $slug)->where("name" , "LIKE" , $slug2)->first();
                $all_user = User::where("is_active" , 1)->where("designation" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }elseif ($attributes->attribute == "roles") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2)); 
                $attributes = attributes::where("attribute" , $slug)->where("role" , "LIKE" , $slug2)->first();
                if (!$attributes) {
                    return redirect()->back()->with('error', "Didn't find any records.!");
                }
                $all_user = User::where("is_active" , 1)->where("role_id" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }else{
                return redirect()->back()->with('error', "Didn't find any records.!");
            }
        }else{
            return redirect()->back()->with('error', "Didn't find any records..");
        }
    }
    public function sale_generator(Request $request){
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\car_sale';
        $car_feilds['is_sale'] = 1;
        // dd($post_feilds);
        try {
            $check = $data::where('is_active',1)->where('is_deleted',0)->where('product_id',$_POST['product_id'])->first();

            if ($check) {
                $create = $data::where("id" ,$check->id)->update($post_feilds);
                $product_sale = car_details::where("id" ,$_POST['product_id'])->update($car_feilds);
                $msg = "Record has been updated";
            } else{
                $create = $data::create($post_feilds);
                $product_sale = car_details::where("id" ,$_POST['product_id'])->update($car_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function crud_generator($slug='' , Request $request)
    {
        $token_ignore = ['_token' => '' , 'record_id' => '' , 'image' => '', 'accessories' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        if ($slug == 'product') {
            $post_feilds['accessories'] = serialize($_POST['accessories']);
        }
        // dd($post_feilds);
        // dd($post_feilds);
        $data = 'App\Models\\'.$slug;
        $extension=array("jpeg","jpg","png","webp","jfif");
        if (isset($request->image)) {
            $file = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            if(in_array($ext,$extension)) {
                $file_name = $request->image->getClientOriginalName();
                $file_name = substr($file_name, 0, strpos($file_name, "."));
                $name = "uploads/product/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/product/';
                $share = $request->image->move($destinationPath,$name);
                $post_feilds['image'] = $name;
            } else{
                $msg = "This File type is not Supported!";
                return redirect()->back()->with('error', "Error Code: ".$msg);
            }
        }
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                if ($slug == 'car_details') {
                    $check_record = car_details::where('is_active',1)->where('slug',$slug)->first();
                    if ($check_record) {
                        $msg = "This Product already exists";
                        return redirect()->back()->with('error',$msg);
                    }
                }
                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function delete_record(Request $request)
    {
        $token_ignore = ['_token' => '' , 'id' => '' , 'model' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = $_POST['model'];
        try{
            $update = $data::where("id" , $_POST['id'])->update($post_feilds);
            $status['message'] = "Record has been deleted";
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function cms_generator(Request $request)
    {
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try {
            $cms = web_cms::where("slug",$_POST['slug'])->first();
            if ($cms) {
                $create = web_cms::where("slug" , $_POST['slug'])->update($post_feilds);
                $msg = "Record has been updated";
            }
            else{
                $create = web_cms::create($post_feilds);
                $msg = "Record has been updated";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function modalform(Request $request)
    {
        $desc = $_POST['desc'];
        $slug = $_POST['slug'];
        $class = $_POST['class'];
        $tag = $_POST['tag'];
        $body="";
        try{
            $route_url = route('cms_generator');
            $body .='<div id="addcms" class="modal fade" role="dialog">
                        <div class="modal-dialog text-left">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="" id="cms_form" method="POST" action="'.$route_url.'">
                                        <div class="row">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="hidden" name="tag" id="tag" value="'.$tag.'">
                                            <input type="hidden" name="class" id="class" value="'.$class.'">
                                            <input type="hidden" name="slug" id="slug" value="'.$slug.'">
                                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                                                <div class="form-group end-date">
                                                    <div class="d-flex">
                                                        <textarea id="description"  name="desc" class="form-control" required="true" required>'.$desc.'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="discard" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                    <button id="cms-generic" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>';
            $status['message'] = $body;
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function image_uploader(Request $request)
    {
        // dd($_POST);
        try{
            $post_feilds['product_id'] = $request->product_id;
            $extension=array("jpeg","jpg","png","webp","jfif");
            if($request->hasFile('image')){
                $files = $request->file('image');
                foreach($files as $file){
                    $ext = $file->getClientOriginalExtension();
                    if(in_array($ext,$extension)) {
                        $file_name = $file->getClientOriginalName();
                        $file_name = substr($file_name, 0, strpos($file_name, "."));
                        $name = "uploads/product/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path().'/uploads/product/';
                        $share = $file->move($destinationPath,$name);
                        $post_feilds['image'] = $name;
                        $create = product_image::create($post_feilds);
                    } else{
                        $msg = "This File type is not Supported!";
                        return redirect()->back()->with('error', "Error Code: ".$msg);
                    }
                }
            }
            return redirect()->back()->with('message', 'Images has been uploaded');
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
}