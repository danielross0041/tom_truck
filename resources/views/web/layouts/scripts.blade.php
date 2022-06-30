<script src="{{asset('web/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="{{asset('web/slick/slick.js')}}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('web/js/custom.js')}}"></script>

<!-- Toatr cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- ckeditor script -->
<script src="{{asset('vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on("click", "#cms-generic", function () {
        $("#cms_form").submit();
    });

    $(document).on("click", "#discard", function () {
        $("#addcms").modal("hide");
    });
    $(document).on("click", ".clickable", function () {
        $("#addcms").modal("hide");
        var element = $(this);
        var desc = $(this).html();
        var slug = $(this).data("slug");
        var clas = $(this).data("class");
        var tag = $(this).data("tag");
        $("#addcms").remove();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "{{route('modalform')}}",
            data: { desc: desc, slug: slug, class: clas, tag: tag, _token: "{{csrf_token()}}" },
            success: function (response) {
                if (response.status == 1) {
                    $(response.message).insertAfter(element);

                    $("#addcms").modal("show");
                    var description = CKEDITOR.replace("description");
                    description.on("change", function (evt) {
                        $("#description").text(evt.editor.getData());
                    });
                }
            },
        });
    });

    $(document).on("click", "#customer_contact", function () {
        $("#product_id").val($(this).data("product_id"));
    });
    $(document).on("change", "#rangeSlider", function () {
        var price = $(this).val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "{{route('price_filter')}}",
            data: { price: price, _token: "{{csrf_token()}}" },
            success: function (response) {
                if (response.status == 1) {
                    console.log(response.message)
                    $("#products-list").html(response.message);
                }
            },
        });
    });
</script>

<script>

    @if(Session::has('message'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true,
      "debug": false,
      "positionClass": "toast-bottom-right",
    }
          toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('success'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true,
      "debug": false,
      "positionClass": "toast-bottom-right",
    }
          toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true,
      "debug": false,
      "positionClass": "toast-bottom-right",
    }
          toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true,
      "debug": false,
      "positionClass": "toast-bottom-right",
    }
          toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true,
      "debug": false,
      "positionClass": "toast-bottom-right",
    }
          toastr.warning("{{ session('warning') }}");
    @endif
</script>
