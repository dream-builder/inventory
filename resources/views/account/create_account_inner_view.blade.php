@extends('index')
@section('content')

    <section class="content">
        <script src="{{ asset("public/js/passwd.js")}}" type="application/javascript"></script>
        <script src="{{ asset ("public/js/create_account.js") }}"></script>
        <div class="row">
            <div class="col-md-6"><h3>Create New Assessor</h3></div>

        </div>

        <div class="row" style="margin-top: 15px;">

            <!-- selection area -->
            <div class="col-md-4 col-md-offset-4">

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Create Assessor</h3>
                    </div>
                    <div class="box-body">
                        <div id="error_msg" style="color: red"></div>
                        <form id="loginData " class="form-signin"  method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                                <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-user" aria-hidden="true"></i>
	                        </span>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                           placeholder="Person name" />
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-envelope" aria-hidden="true"></i>
	                        </span>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="Email address" />
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-lock" aria-hidden="true"></i>
	                        </span>
                                    <input type="password"  id="password" name="password" class="form-control" value="{{ old('password') }}"
                                           placeholder="Password" />
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('Confirmpassword') ? ' has-error' : '' }}">
                                <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-lock" aria-hidden="true"></i>
	                        </span>
                                    <input type="password" id="Confirmpassword" name="Confirmpassword" class="form-control" value="{{ old('password') }}"
                                           placeholder="Confirm password" />
                                </div>
                            </div>

                            <div class="row">

                            </div>
                        </form>

                    </div>

                    <div class="box-footer">
                        <div class="col-xs-12">
                            {{--                        <a href="{{url('/login')}}">--}}
                            <input type="button" id="create-account"
                                   class='btn btn-primary btn-block' value="Create account" />
                            {{--                        </a>--}}

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>


@endsection
@section('script')
    <script>
    </script>
@endsection