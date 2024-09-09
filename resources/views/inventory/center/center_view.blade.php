@extends('index')
@section('content')
    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            Center
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Center</h3>
                </div>
                <div class="box-body">

                    <form name="wearhouse" id="wearhouse" action="{{ env('APP_URL') }}center/addnew" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label for="division" class="form-label">Division</label>
                                <input type="text" class="form-control" id="division" placeholder="Enter division"
                                    name="division">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="district" class="form-label">District</label>
                                <input type="text" class="form-control" id="district" placeholder="Enter district"
                                    name="district">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="subdistrict" class="form-label">Subdistrict</label>
                                <input type="text" class="form-control" id="subdistrict" placeholder="Enter subdistrict"
                                    name="upazila">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="union" class="form-label">Union</label>
                                <input type="text" class="form-control" id="union" placeholder="Enter union"
                                    name="union">
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" placeholder="Enter address" name="address"></textarea>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="lat" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="lat" placeholder="Enter latitude"
                                    name="lat">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="lon" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="lon" placeholder="Enter longitude"
                                    name="lon">
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="contactPerson" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contactPerson" name="contact_person"
                                    placeholder="Enter contact person">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone"
                                    placeholder="Enter phone nucol-mder" name="phone">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-footer">

                </div>

                <script>
                    $(document).ready(function() {

                        $("#wearhouse").submit(function(e) {

                            e.preventDefault(); // avoid to execute the actual submit of the form.

                            var form = $(this);
                            var actionUrl = form.attr('action');

                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                data: form.serialize(), // serializes the form's elements.
                                success: function(data) {

                                }
                            });

                        });

                    });
                </script>
            </div>
        </div>

    </section>
@endsection
@section('script')
    <script></script>
@endsection
