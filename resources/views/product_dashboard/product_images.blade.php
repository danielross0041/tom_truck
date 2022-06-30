@extends('layouts.main')
@section('content')
<!-- START: Main Content-->
<main>
    <div class="container-fluid site-width" id="mypitch">
        <div id="addevent" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg text-left">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="model-header">Form</h4>
                    </div>
                    <div class="modal-body">
                        <form class="" id="generic-form" enctype="multipart/form-data" method="POST" action="{{route('image_uploader')}}">
                            @csrf
                            <input type="hidden" name="record_id" id="record_id" value="" />
                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}" />
                            <div class="row">
                                <div id="assignrole"></div>
                                <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                    <div class="form-group start-date">
                                        <label for="start-date" class="">Image:</label>
                                        <div class="d-flex">
                                            <input type="file" id="image" accept="image/*" name="image[]" class="form-control" required multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button id="discard" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button id="add-generic" type="submit" class="btn btn-primary eventbutton">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <h3>Product Pictures</h3>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mt-3 updateevent" style="cursor: pointer;">
                <div class="card border-bottom-0">
                    <div class="card-content border-bottom border-primary border-w-5" style="border-color: #b3ff00 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="circle-50 outline-badge-primary" style="color: #b3ff00; border: 1px solid #b3ff00;"><span class="cf card-liner-icon cf-xsn mt-2"></span></div>
                                <div class="media-body align-self-center pl-3">
                                    <span class="mb-0 h6 font-w-600">{{$product->name}} Pictures</span> <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Image</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if(!$product_image->isEmpty())
                                <tbody>
                                    @foreach($product_image as $key => $val)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img style="width:80px;height:80px;" src="{{asset($val->image)}}"></td>
                                        <td>{{date("M d,Y" ,strtotime($val->created_at))}}</td>
                                        <td>
                                            @php
                                            $model = 'App\Models\product_image';
                                            @endphp
                                            <button type="button" class="btn btn-danger delete-record" data-model= "{{$model}}" data-id= "{{$val->id}}">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                                <tfoot>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Image</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->

@endsection
@section('css')
<style type="text/css">
    .start-date .js-example-basic-multiple + span {
        width: 100% !important;
    }
</style>
<link rel="stylesheet" href="{{asset('vendors/datatable/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendors/datatable/buttons/css/buttons.bootstrap4.min.css')}}" />
@endsection
@section('js')
<script src="{{asset('vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="{{asset('js/datatable.script.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var description = CKEDITOR.replace("description");
        description.on("change", function (evt) {
            $("#description").text(evt.editor.getData());
        });
    });

    // CKEDITOR.replace( 'description', );
</script>
<script type="text/javascript">
    $("body").on("click", ".editor-form", function () {
        $("#name").val($(this).data("name"));
        $("#record_id").val($(this).data("edit_id"));
        var texta = $(this).data("desc");
        CKEDITOR.instances.description.setData(texta);
        $("#addevent").modal("show");
    });
</script>
<script type="text/javascript">



    $("#add-generic").click(function(f){
        var has_error = 0
        // $("#generic-form").find("select,textarea,input")
        $("#generic-form").find("select,textarea,input").each(function(i,e){
            if($(e).prop("required") == true){
                if($(e).val() == ""){
                    has_error++;
                    f.preventDefault();
                    console.log("done")
                    return false
                }
            }
        })
        if(has_error == 0){
            console.log("no error")
            $("#generic-form").submit();
        } else{
            toastr.error("Fill all required fields");
        }
    })
    $("#productshow").click(function(){
        $("#generic-form").submit();
    })

    $("body").on(".add-event","click", function(){
        $("#generic-form")[0].reset();

        $("#addevent").modal("show")
        $("#attribute").click();
    })


    $(".updateevent").click(function(){
        $("#add-generic").css("display","")
        $("#generic-form").find("select,textarea,input").each(function(i,e){
            $(e).attr("disabled",false);
        })
        $("#image").attr("required",true);
        $("#image").css("display","")
        $('#image').prop('required', true);
        $("#image-add").css("display","none");
        $("#generic-form")[0].reset();
        $("#record_id").attr("value","");
        if (CKEDITOR.instances.description) {
            CKEDITOR.instances.description.setData("");
        }
        $("#addevent").modal("show")
        $("#attribute").click();
    })





    $("body").on("click" ,".delete-record",function(){
        var id = $(this).data("id");
        var model = $(this).data("model");
        var is_active = 0;
        var is_deleted = 1;
        $.ajax({
            type: 'post',
            dataType : 'json',
            url: "{{route('delete_record')}}",
            data: {id:id, model:model, is_active:is_active, is_deleted:is_deleted , _token: '{{csrf_token()}}'},
            success: function (response) {
                if (response.status == 0) {
                    toastr.error(response.message);
                }else{
                    var table = $('#example').DataTable();
                    // table.ajax.reload();
                    location.reload();
                    toastr.success(response.message);
                }
            }
        });
    })
    function convertToSlug( str ) {
      //replace all special characters | symbols with a space
      str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
      // trim spaces at start and end of string
      str = str.replace(/^\s+|\s+$/gm,'');
      // replace space with dash/hyphen
      str = str.replace(/\s+/g, '-');
      document.getElementById("slug").value = str;
      //return str;
    }


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endsection
