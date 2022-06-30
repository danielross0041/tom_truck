 elseif ($slug == 'product') {
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
                                <label for="start-date" class="">Condition:</label>
                                <div class="d-flex">
                                    <input id="condition" placeholder="Condition" name="condition" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Stock Number:</label>
                                <div class="d-flex">
                                    <input id="stock_number" placeholder="Stock Number" name="stock_number" class="form-control" type="text" autocomplete="off" required/>
                                </div>
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
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Engine:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Horsepower:</label>
                                <div class="d-flex">
                                    <input id="horsepower" placeholder="Horsepower" name="horsepower" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine Manufacturer:</label>
                                <div class="d-flex">
                                    <input id="engine_manufacturer" placeholder="Engine Manufacturer" name="engine_manufacturer" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine Model:</label>
                                <div class="d-flex">
                                    <input id="engine_model" placeholder="Engine Model" name="engine_model" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Fuel Type:</label>
                                <div class="d-flex">
                                    <input id="fuel_type" placeholder="Fuel Type" name="fuel_type" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Engine Brake:</label>
                                <div class="d-flex">
                                    <input id="engine_brake" placeholder="Engine Brake" name="engine_brake" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Powertrain:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Transmission:</label>
                                <div class="d-flex">
                                    <input id="transmission" placeholder="Transmission" name="transmission" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Transmission Manufacturer:</label>
                                <div class="d-flex">
                                    <input id="transmission_manufacturer" placeholder="Transmission Manufacturer" name="transmission_manufacturer" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Number of Speeds:</label>
                                <div class="d-flex">
                                    <input id="number_of_speeds" placeholder="Number of Speeds" name="number_of_speeds" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Overdrive:</label>
                                <div class="d-flex">
                                    <input id="overdrive" placeholder="Overdrive" name="overdrive" class="form-control" type="text" autocomplete="off" required/>
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
                                <label for="start-date" class="">Differential Lock:</label>
                                <div class="d-flex">
                                    <input id="differential_lock" placeholder="Differential Lock" name="differential_lock" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Chassis:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive:</label>
                                <div class="d-flex">
                                    <input id="drive" placeholder="Drive" name="drive" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Suspension:</label>
                                <div class="d-flex">
                                    <input id="suspension" placeholder="Suspension" name="suspension" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Number of Rear Axles:</label>
                                <div class="d-flex">
                                    <input id="number_of_rear_axles" placeholder="Number of Rear Axles" name="number_of_rear_axles" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wheels:</label>
                                <div class="d-flex">
                                    <input id="wheels" placeholder="Wheels" name="wheels" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Wheelbase:</label>
                                <div class="d-flex">
                                    <input id="wheelbase" placeholder="Wheelbase" name="wheelbase" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class=""><b>Interior:</b></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Drive Side:</label>
                                <div class="d-flex">
                                    <input id="drive_side" placeholder="Drive Side" name="drive_side" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Sleeper:</label>
                                <div class="d-flex">
                                    <input id="sleeper" placeholder="Sleeper" name="sleeper" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
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
                                <label for="start-date" class="">Number of Beds:</label>
                                <div class="d-flex">
                                    <input id="number_of_beds" placeholder="Number of Beds" name="number_of_beds" class="form-control" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        }





<input type="checkbox" data-ad_id ="'.$val->id.'" class="toggle-class active_ads" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" '.$checked.'>



 elseif ($slug == "product") {
            $data = 'App\Models\car_details';
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Company</th>
                                          <th>Brand</th>
                                          <th>Type</th>
                                          <th>Model</th>
                                          <th>From Year</th>
                                          <th>To Year</th>
                                          <th>Piston Caliper</th>
                                          <th>Finish Caliper</th>
                                          <th>Disc Size and Type</th>
                                          <th>Drilled Part Number</th>
                                          <th>Type-1 Part Number</th>
                                          <th>Type-3 Part Number</th>
                                          <th>Type-5 Part Number</th>
                                          <th>Note</th>
                                          <th>GT Price</th>
                                          <th>GTS Price</th>
                                          <th>GTR Price</th>
                                          <th>Image</th>
                                          <th>Featured Product</th>
                                          <th>Best Seller</th>
                                          <th>On Sale</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                        if($loop) {
                                        foreach($loop as $key => $val){
                                        $featured = " ";
                                        if ($val->is_featured == 1) {
                                            $featured = "checked";
                                        }
                                        $best_seller = " ";
                                        if ($val->best_seller == 1) {
                                            $best_seller = "checked";
                                        }
                                        $sale = " ";
                                        if ($val->is_sale == 1) {
                                            $sale = "checked";
                                        }

                                        $data_image = '';
                                        $table_image = '<td>-</td>';
                                        if (isset($val->image) && $val->image != '' && $val->image !== null) {
                                            $data_image=asset($val->image);
                                            
                                            $table_image = '<td><img style="width:80px;height:80px;" src="'.$data_image.'"></td>';

                                        }
                                        $company = company::where('is_active',1)->where('is_deleted',0)->where('id',$val->company_id)->first();
                                        $brand = brand::where('is_active',1)->where('is_deleted',0)->where('id',$val->brand_id)->first();
                                        $finishScript = '';
                                        if (isset($val->finish_caliper) && $val->finish_caliper != '' && $val->finish_caliper !== null) {
                                            $check = @unserialize($val->finish_caliper);
                                            if ($check !== false) {
                                                $finish_caliper = unserialize($val->finish_caliper);
                                                $finish_data = '<td> <ul>';
                                                foreach ($finish_caliper as $i => $value) {
                                                    $finish_data .= '<li>'.$value.'</li>';
                                                    $finishScript .= $value.',';
                                                }
                                                $finish_data .= '</ul> </td>';
                                            } else{
                                                $finish_data = '<td> <ul> <li> '.$val->finish_caliper.'</li> </ul> </td>';
                                                $finishScript .= $val->finish_caliper.',';
                                            }
                                        } else{
                                            $finish_data ='<td>-</td>';
                                        }
                                        // dd($finishScript);
                                        $noteScript = '';
                                        if (isset($val->note) && $val->note != '' && $val->note !== null) {
                                            $check_note = @unserialize($val->note);
                                            if ($check_note !== false) {
                                                $noteArray = unserialize($val->note);
                                                $note_data = '<td> <ul>';
                                                foreach ($noteArray as $j => $v) {
                                                    $note = note::where('is_active',1)->where('is_deleted',0)->where('note_no',$v)->orderBy('id', 'desc')->first();
                                                    $note_data .= '<li>'.$note->note.'</li> ';
                                                    $noteScript .= $v.',';
                                                }
                                                $note_data .= '</ul> </td>';
                                            } else{
                                                $note = note::where('is_active',1)->where('is_deleted',0)->where('note_no',$val->note)->orderBy('id', 'desc')->first();
                                                $note_data = '<td> <ul> <li> '.$note->note.'</li> </ul> </td>';
                                                $noteScript .= $val->note.',';
                                            }
                                        } else{
                                            $note_data ='<td>-</td>';
                                        }
                                        $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$company->name.'</td>
                                          <td>'.$brand->name.'</td>
                                          <td>'.$val->type.'</td>
                                          <td>'.$val->model.'</td>
                                          <td>'.$val->from_year.'</td>
                                          <td>'.$val->to_year.'</td>
                                          <td>'.$val->pistons_caliper.'</td>
                                          '.$finish_data.'
                                          <td>'.$val->disc_size_type.'</td>
                                          <td>'.$val->drilled_no.'</td>
                                          <td>'.$val->type1_no.'</td>
                                          <td>'.$val->type3_no.'</td>
                                          <td>'.$val->type5_no.'</td>
                                          '.$note_data.'
                                          <td>'.$val->gt_price.'</td>
                                          <td>'.$val->gts_price.'</td>
                                          <td>'.$val->gtr_price.'</td>
                                          '.$table_image.'
                                          <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-pro_id ="'.$val->id.'" class="featured"  '.$featured.'>
                                                    <span class="slider"></span>
                                                </label>
                                          </td>
                                          <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-pro_id ="'.$val->id.'" class="best_seller"  '.$best_seller.'>
                                                    <span class="slider"></span>
                                                </label>
                                          </td>
                                          <td>
                                            <ul>
                                                <li> 
                                                    <label class="switch">
                                                        <input type="checkbox" data-pro_id ="'.$val->id.'" class="sale"  '.$sale.'>
                                                        <span class="slider"></span>
                                                    </label> 
                                                </li>';
                                                if ($sale == "checked") {
                                                    $car_sale = car_sale::where('product_id',$val->id)->first();
                                                    $body .= '<li>
                                                        <ul>
                                                            <li>Start Date: '.$car_sale->start_date.'</li>
                                                            <li>End Date: '.$car_sale->end_date.'</li>
                                                            <li>Discount: '.$car_sale->dis_percentage.'%</li>
                                                        </ul>
                                                    </li>';
                                                }
                                                
                                                
                                            $body .= '</ul>
                                          </td>
                                          
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'"
                                                 data-company_id= "'.$val->company_id.'" 
                                                 data-brand_id= "'.$val->brand_id.'" 
                                                 data-type= "'.$val->type.'"
                                                 data-model= "'.$val->model.'"
                                                 data-from_year= "'.$val->from_year.'"
                                                 data-to_year= "'.$val->to_year.'"
                                                 data-pistons_caliper= "'.$val->pistons_caliper.'"
                                                 data-disc_size_type= "'.$val->disc_size_type.'"
                                                 data-drilled_no= "'.$val->drilled_no.'"
                                                 data-type1_no= "'.$val->type1_no.'"
                                                 data-type3_no= "'.$val->type3_no.'"
                                                 data-type5_no= "'.$val->type5_no.'"
                                                 data-gt_price= "'.$val->gt_price.'"
                                                 data-gts_price= "'.$val->gts_price.'"
                                                 data-gtr_price= "'.$val->gtr_price.'" 
                                                 data-finish_caliper= "'.$finishScript.'" 
                                                 data-note= "'.$noteScript.'"
                                                 data-image= "'.$data_image.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Company</th>
                                          <th>Brand</th>
                                          <th>Type</th>
                                          <th>Model</th>
                                          <th>From Year</th>
                                          <th>To Year</th>
                                          <th>Piston Caliper</th>
                                          <th>Finish Caliper</th>
                                          <th>Disc Size and Type</th>
                                          <th>Drilled Part Number</th>
                                          <th>Type-1 Part Number</th>
                                          <th>Type-3 Part Number</th>
                                          <th>Type-5 Part Number</th>
                                          <th>Note</th>
                                          <th>GT Price</th>
                                          <th>GTS Price</th>
                                          <th>GTR Price</th>
                                          <th>Image</th>
                                          <th>Featured Product</th>
                                          <th>Best Seller</th>
                                          <th>On Sale</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#image-add").css("display","none")
                                                $("#image-add").attr("src","")
                                                var image_data = $(this).data("image")
                                                console.log(image_data);
                                                if(image_data != ""){
                                                    $("#image-add").css("display","")
                                                    $("#image-add").attr("src",image_data)
                                                }
                                                $("#company_id").val($(this).data("company_id"))
                                                $("#brand_id").val($(this).data("brand_id"))
                                                $("#type").val($(this).data("type"))
                                                $("#model").val($(this).data("model"))
                                                $("#from_year").val($(this).data("from_year"))
                                                $("#to_year").val($(this).data("to_year"))
                                                $("#pistons_caliper").val($(this).data("pistons_caliper"))
                                                $("#disc_size_type").val($(this).data("disc_size_type"))
                                                $("#drilled_no").val($(this).data("drilled_no"))
                                                $("#type1_no").val($(this).data("type1_no"))
                                                $("#type3_no").val($(this).data("type3_no"))
                                                $("#type5_no").val($(this).data("type5_no"))
                                                $("#gt_price").val($(this).data("gt_price"))
                                                $("#gts_price").val($(this).data("gts_price"))
                                                $("#gtr_price").val($(this).data("gtr_price"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var selectedFinish = $(this).data("finish_caliper")
                                                var finishArray = selectedFinish.split(",")
                                                finishArray.splice(-1);
                                                $("#finish_caliper").select2({
                                                    data: finishArray,
                                                    tags: true,
                                                    });
                                                $("#finish_caliper").val(finishArray).trigger("change");
                                                var selectedNote = $(this).data("note")
                                                var noteArray = selectedNote.split(",")
                                                noteArray.splice(-1);
                                                $("#note").select2({
                                                    tags: true,
                                                    });
                                                $("#note").val(noteArray).trigger("change");
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        }









<form action="{{route('search_detail')}}" method="GET">
                            <input type="text" list="year" id="year-searcha" autofocus name="year" placeholder="Year" />
                            <datalist id="year">
                                @foreach($years as $year)
                                <option value="{{$year}}">
                                </option>
                                @endforeach
                            </datalist>


                            <input type="text" list="make" id="make-searcha" autofocus name="make" placeholder="Make" />
                            <datalist id="make">
                            </datalist>


                            <input type="text" list="model" id="searcha-job" autofocus name="model" placeholder="Model" />
                            <datalist id="model">
                            </datalist>
                            <!-- <input type="text" name="" placeholder="Select level 1..." />
                            <input type="text" name="" placeholder="Select level 1..." />
                            <input type="text" name="" placeholder="Select level 1..." /> -->
                            <button type="submit">BROWSE</button>
                            <a href="#"><i class="fa fa-refresh" aria-hidden="true"></i>Reset</a>
                        </form>







<td> <ul>';
                                          foreach ($finish_caliper as $key => $value) {
                                            $body .= '<li>'.$value.'</li>';
                                          }
                                          $body.= '</ul> </td>



                                          // if ($val->finish_caliper != null && $val->finish_caliper != '') {
                                        //     $finish_caliper = unserialize($val->finish_caliper);
                                        // }

                                        $data = @unserialize($str);





if ($val->finish_caliper != null && $val->finish_caliper != '') {
                                            $data = @unserialize($val->finish_caliper);
                                            if ($data !== false) {
                                                # code...
                                            }
                                            $finish_caliper = unserialize($val->finish_caliper);
                                        }



<div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <div class="d-flex">';
                                    $i = asset('uploads/product/dash-kits_ic_5_1647051952.jpg');
                                    $body.='<td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                </div>
                            </div>
                        </div>








y = ($(this).data("availability")).unserialize()




<div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Multiple:</label>
                                <div class="d-flex">
                                    <select class="anything" multiple="multiple">
                                      <option selected="selected">orange</option>
                                      <option>white</option>
                                      <option selected="selected">purple</option>
                                    </select>
                                </div>
                            </div>
                        </div>

<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>


config.toolbarGroups = [
		// { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'tools' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles'] },
		{ name: 'paragraph',   groups: [ 'list',  'align'] },
		{ name: 'styles' },
		{ name: 'colors' }
	];

config.toolbarGroups = [
		// { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

    
    config.toolbarGroups = [
        // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        { name: 'colors' },
        { name: 'about' }
    ];

