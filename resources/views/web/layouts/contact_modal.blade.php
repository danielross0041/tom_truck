<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('customer_contact')}}">
                    @csrf
                    <input type="hidden" name="product_id" value="" id="product_id">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="form-group">
                                <input type="text" name="first_name" placeholder="First Name" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="form-group">
                                <input type="text" name="last_name" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Subject" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="form-group">
                                <textarea name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="form-group">
                                <button class="submit-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
