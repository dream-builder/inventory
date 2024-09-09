@extends('index')
@section('content')
    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            WearHouse
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title"></div>
                </div>
                <div class="box-body">
                    <h2>Add New Wearhouse </h2>
                    <form name="wearhouse" id="wearhouse" action="{{ env('APP_URL') }}wearhouse/addnew" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="type" class="form-label">Type</label>

                                <select class="form-control" id="type" name="type">
                                    <option></option>
                                    <option value="1">Central Wearhouse</option>
                                    <option value="2">DC office (District Wearhouse)</option>
                                    <option value="3">Center (Field level)</option>
                                </select>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="contactPerson" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contactPerson"
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

                            <div class="col-md-3 form-group">
                                <label for="division" class="form-label">Division</label>
                                <input type="text" class="form-control" id="division" placeholder="Enter division"
                                    name="division">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="district" class="form-label">Zilla</label>
                                <input type="text" class="form-control" id="district" placeholder="Enter district"
                                    name="district">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="subdistrict" class="form-label">Upazila</label>
                                <input type="text" class="form-control" id="subdistrict" placeholder="Enter subdistrict"
                                    name="upazila">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="union" class="form-label">Union</label>
                                <input type="text" class="form-control" id="union" placeholder="Enter union"
                                    name="union">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="village" class="form-label">Village</label>
                                <input type="text" class="form-control" id="village" placeholder="Enter village"
                                    name="village">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" placeholder="Enter address" name="address"></textarea>
                            </div>

                        </div>



                        <div class="row">
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
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>



                </div>


                <!-- product -->
                {{-- <div class="container">
                    <h2 class="mt-5">Product Information Form</h2>
                    <form class="form-horizontal">
                        <!-- Product -->
                        <div class="form-group">
                            <label for="product" class="col-sm-2 control-label">Product</label>
                            <div class="col-sm-10">
                                <input type="daterange" class="form-control" id="product"
                                    placeholder="Enter product name">
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" placeholder="Enter title">
                            </div>
                        </div>

                        <!-- ID -->
                        <div class="form-group">
                            <label for="id" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id" placeholder="Enter product ID">
                            </div>
                        </div>

                        <!-- Batch Number -->
                        <div class="form-group">
                            <label for="batchNumber" class="col-sm-2 control-label">Batch Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="batchNumber"
                                    placeholder="Enter batch number">
                            </div>
                        </div>

                        <!-- Serial Number -->
                        <div class="form-group">
                            <label for="serialNumber" class="col-sm-2 control-label">Serial Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="serialNumber"
                                    placeholder="Enter serial number">
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="category" placeholder="Enter category">
                            </div>
                        </div>

                        <!-- Unit -->
                        <div class="form-group">
                            <label for="unit" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="unit" placeholder="Enter unit">
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
                            </div>
                        </div>

                        <!-- Expiry Date -->
                        <div class="form-group">
                            <label for="expdate" class="col-sm-2 control-label">Expiry Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="expdate" placeholder="Enter expiry date">
                            </div>
                        </div>

                        <!-- Manufacturing Date -->
                        <div class="form-group">
                            <label for="mfgdate" class="col-sm-2 control-label">Manufacturing Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="mfgdate"
                                    placeholder="Enter manufacturing date">
                            </div>
                        </div>

                        <!-- Purchase Date -->
                        <div class="form-group">
                            <label for="purchaseDate" class="col-sm-2 control-label">Purchase Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="purchaseDate"
                                    placeholder="Enter purchase date">
                            </div>
                        </div>

                        <!-- Order Number -->
                        <div class="form-group">
                            <label for="orderNumber" class="col-sm-2 control-label">Order Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="orderNumber"
                                    placeholder="Enter order number">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> --}}

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
