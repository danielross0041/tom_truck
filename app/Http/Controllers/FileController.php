<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;

use App\Exports\SalesOrderExport;
use App\Imports\SalesOrder;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\production_schedule;
use App\Models\production_schedule_time;

// use Excel;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function file_generator(Request $request){
        // dd($request->file);
        try{
            $this->validate($request,[
                'file' =>'required|mimes:xls,xlsx'
            ]);
            if ($request->file) {
                $file = $request->file;
                $file_name = $request->file->getClientOriginalName();
                $file_name = substr($file_name, 0, strpos($file_name, "."));
                $name = "uploads/file/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/file/';
                $share = $request->file->move($destinationPath,$name);
                $path = public_path($name);
                $rows = \Excel::toArray(new SalesOrderExport, $path);
                $check = $this->upload_sheet($rows);
                if ($check) {
                    $msg = "File has been uploaded";
                    return redirect()->back()->with('message', $msg);
                }
            }
            $msg = "File could not be uploaded";
            return redirect()->back()->with('error', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function upload_sheet($collection){
        $post_feilds= array();
        $time_feilds= array();
        foreach ($collection[0] as $key => $value) {
            if ($key>0) {
                if ($value[0] == null) {
                    return true;
                }
                $check_batch = $this->check_batch($value);
                if ($check_batch) {
                    $post_feilds['batch'] = $value[0];
                    $post_feilds['product'] = $value[3];
                    $post_feilds['mrp'] = $value[4];
                    $post_feilds['quantity'] = $value[5];
                    $post_feilds['size'] = $value[6];
                    $production_schedule = production_schedule::create($post_feilds);

                    $time_feilds['start_date'] = Date::excelToDateTimeObject($value[1]);
                    $time_feilds['finish_date'] = Date::excelToDateTimeObject($value[2]);
                    $time_feilds['production_schedule_id'] = $production_schedule->id;
                    $production_schedule_time = production_schedule_time::create($time_feilds);
                }
            }
        }
        return false;
    }
    public function check_batch($array)
    {
        $batch = production_schedule::where('is_active',1)->where('batch',$array[0])->first();
        if ($batch) {
            return false;
        } else{
            return true;
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
