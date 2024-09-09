@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Registration</h3>
                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="{{ route('register/list') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>User List</a>
                            </div>
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group row {{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <label for="user_type" class="control-label col-sm-2 inline-label">User Type</label>
                                    <div class="col-sm-8">
                                        @if ($errors->has('user_type'))
                                            <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i> {{ $errors->first('user_type') }}
                                            </label><br/>
                                        @endif
                                        <input type="hidden" name="user_type"/>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <select class="form-control user-type" name="user_type" id="user-type">
                                                <option value="">--Select--</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="UFPO">UFPO</option>
                                                <option value="FWV-SACMO">FWV/SACMO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row geo-code" >
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8 no-padding">
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ $errors->has('zilla_id') ? ' has-error' : '' }}">
                                                <label for="zilla_id" class="control-label col-sm-2">District</label>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="zilla_id"/>
                                                    <div class="input-group">
                                                        <select class="form-control" id="zilla_id" name="zilla_id">
                                                            {{--                                            @foreach($options as $select => $option)--}}
                                                            {{--@endforeach--}}
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('zilla_id'))
                                                        <label class="control-label" for="inputError"><i
                                                                    class="fa fa-times-circle-o"></i> {{ $errors->first('zilla_id') }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 {{ $errors->has('upazilla_id') ? ' has-error' : '' }}">
                                                <label for="upazilla_id" class="control-label col-sm-2">Upazilla</label>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="upazilla_id"/>
                                                    <div class="input-group">
                                                        <select class="form-control " name="upazilla_id" id="upazilla_id">
                                                            {{--                                            @foreach($options as $select => $option)--}}
                                                            {{--@endforeach--}}
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('upazilla_id'))
                                                        <label class="control-label" for="inputError"><i
                                                                    class="fa fa-times-circle-o"></i> {{ $errors->first('upazilla_id') }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 {{ $errors->has('union_id') ? ' has-error' : '' }}">
                                                <label for="union_id" class="control-label col-sm-2">Union</label>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="union_id"/>
                                                    <div class="input-group">
                                                        <select class="form-control " name="union_id" id="union_id">
                                                            {{--                                            @foreach($options as $select => $option)--}}
                                                            {{--@endforeach--}}
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('union_id'))
                                                        <label class="control-label" for="inputError"><i
                                                                    class="fa fa-times-circle-o"></i> {{ $errors->first('union_id') }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('user_id') ? ' has-error' : '' }}">
                                    <label for="user_id" class="control-label col-sm-2 inline-label">User Id</label>
                                    <div class="col-sm-8">
                                        @if ($errors->has('user_id'))
                                            <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i> {{ $errors->first('user_id') }}
                                            </label><br/>
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" id="user_id" name="user_id" value="{{ old('user_id') }}"
                                                   class="form-control" placeholder="User Id" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label col-sm-2 inline-label">Name</label>
                                    <div class="col-sm-8">
                                        @if ($errors->has('name'))
                                            <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}
                                            </label><br/>
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                   class="form-control" placeholder="Name" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone"
                                           class="control-label col-sm-2 inline-label">Mobile No</label>
                                    <div class="col-sm-8">
                                        @if ($errors->has('phone'))
                                            <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i> {{ $errors->first('phone') }}
                                            </label><br/>
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                            <input type="text" id="phone" name="phone"
                                                   value="{{ old('phone') }}"
                                                   class="form-control" placeholder="Mobile No" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-sm-2 control-label inline-label">Password</label>
                                    <div class="col-sm-8">
                                        @if ($errors->has('password'))
                                            <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i> {{ $errors->first('password') }}
                                            </label><br/>
                                        @endif
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                                            <input id="password" class="form-control" name="password"
                                                   value="{{ old('password') }}" type="password"
                                                   placeholder="Password" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="col-sm-2 control-label inline-label">Confirm
                                        Password</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                                            <input id="password_confirmation" class="form-control"
                                                   name="password_confirmation"
                                                   value="{{ old('password_confirmation') }}" type="password"
                                                   placeholder="Confirm Password" required autofocus>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3 col-md-offset-5">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function () {

            <!--$("#upazilla_id").val("{{ old('upazilla_id') }}").trigger('change');-->
            {{--$("#union_id").val("{{ old('union_id') }}").trigger('change');--}}

            $('.user-type').on('change',function () {
                var type=$(this).val();
                if(type == 'ADMIN'){
                    $('.geo-code').hide();
                }else if (type == 'UFPO'){
                    $('.geo-code').show();
                    $("#union_id").prop("disabled", true);
                }else if (type == 'FWV-SACMO'){
                    $('.geo-code').show();
                    $("#union_id").prop("disabled", false);
                }
            });
            $('#user-type').select2().val("{{ old('user_type') }}").trigger('change');
            $("#zilla_id,#upazilla_id").select2({
                placeholder: "-- Select --",
                allowClear: true
            });
            $("#union_id").select2({
                placeholder: "Select Union",
                allowClear: true
            });
            //Load Zilla Data
            $.ajax({
                url: "{{ route('/api/get_geo_code')}}",
                cache: false,
                success: function (result) {
                    $('#zilla_id').select2({
                        data: JSON.parse(result),
                        placeholder: "Select District",
                        allowClear: true
                    }).val("{{ old('zilla_id') }}").trigger('change');

                }
            });
            //load Upazila data
            $('#zilla_id').select2().on('change', function() {
                $('#upazilla_id').find('option').remove();
                $('#union_id').find('option').remove();
                var zilla = $('#zilla_id').val();
                if(zilla == null){
                    return ;
                }
                $.ajax({
                    url: "{{ route('/api/get_geo_code')}}?ZillaId="+zilla,
                    cache: false,
                    success: function (result) {
                        $('#upazilla_id').select2({
                            data: JSON.parse(result),
                            placeholder: "Select Upazila",
                            allowClear: true
                        }).val("{{ old('upazilla_id') }}").trigger('change');
                    }
                });
            });
            //load Union data
            $('#upazilla_id').select2().on('change', function() {
                $('#union_id').find('option').remove();
                var zilla = $('#zilla_id').val();
                var upa_zilla = $('#upazilla_id').val();
                if(zilla == null || upa_zilla == null){
                    return ;
                }
                $.ajax({
                    url: "{{ route('/api/get_geo_code')}}?ZillaId="+zilla+"&UpazilaId="+upa_zilla,
                    cache: false,
                    success: function (result) {
                        $('#union_id').select2({
                            data: JSON.parse(result),
                            placeholder: "Select Union",
                            allowClear: true
                        }).val("{{ old('union_id') }}").trigger('change');
                    }
                });
            });


            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                history.back(1);
            });

        });
    </script>
@endsection