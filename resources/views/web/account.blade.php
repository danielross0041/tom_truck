<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="HTML, CSS, JavaScript" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @include('web.layouts.links')
        <title>{{isset($title)?$title:'Truck'}}</title>
    </head>
    <body>
        <section class="account-sec">
            <div class="container">
                <div class="row">
                    <div class="form-blk">
                        <div class="col-md-6">
                            <div class="login-form">
                                <form method="POST" action="{{route('login')}}" autocomplete="off">
                                    @csrf
                                    <h5>Log In</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="login-input">
                                                <input
                                                    type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="exampleInputEmail1"
                                                    aria-describedby="emailHelp"
                                                    placeholder="Enter email"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    required
                                                    autocomplete="email"
                                                    autofocus
                                                />
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="login-input">
                                                <input
                                                    type="password"
                                                    class="form-control validate @error('password') is-invalid @enderror"
                                                    id="exampleInputPassword1"
                                                    placeholder="Password"
                                                    name="password"
                                                    required
                                                    autocomplete="current-password"
                                                />
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="login-btn">
                                                <button>log In</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
