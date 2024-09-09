@extends('index')
@section('content')
    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            Stock
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Stock</h3>
                </div>
                <div class="box-body">

                    <form name="wearhouse" action="{{ env('APP_URL') }}stock/addnew" method="POST">
                        {{ csrf_field() }}

                        <div class="row">

                            <!-- Location/Cente Name -->
                            <div class="col-md-6 form-group ">
                                <label for="wearhouse">Wearhouse</label>
                                <select class="form-control" id="wearhouse" name="wearhouse">
                                    <option></option>
                                    @if (isset($wearhouse) && is_array($wearhouse))
                                        @foreach ($wearhouse as $w)
                                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>


                            <!-- Location/Cente Name -->
                            <div class="col-md-6 form-group ">
                                <label for="dcoffice">DC Office</label>
                                <select class="form-control" id="dcoffice" name="dcoffice">
                                    <option></option>
                                    @if (isset($dcoffice) && is_array($dcoffice))
                                        @foreach ($dcoffice as $w)
                                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>


                            <input type="hidden" name="type" value=21">

                        </div>

                        <div class="row">

                            <!-- Select Name -->
                            <div class="col-md-6 form-group ">
                                <label for="itemName">Item Name</label>
                                <select class="form-control" id="itemName" name="itemid">
                                    <option></option>
                                    @if (isset($items) && is_array($items))
                                        @foreach ($items as $item)
                                            <option value="{{ $w->id }}">{{ $item->item_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-3 form-group ">
                                <label for="">Available Quantity</label>
                                <input type="text" disabled value="" class="form-control">
                            </div>

                            <div class="col-md-12 form-group ">
                                <label for="">Description</label>
                                <div class="" id="item-description"
                                    style="border: solid 1px #ccc;padding:15px; background-color:#CCC; margin-top:15px; margin-bottom:15px;">
                                    dd
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-3 form-group ">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option>In Stock</option>
                                    <option>Out of Stock</option>
                                    <option>Discontinued</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-md-3 form-group ">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
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
                                    if (data = 'success') {
                                        alert('Item addes successfully');
                                        $("#wearhouse").trigger("reset");
                                    } else {
                                        alert(data);
                                    }
                                }
                            });

                        });



                        //select item by item name
                        // $("#wearhouse").change(function() {
                        //     alert('');
                        // });


                        //load Item by wearhouse
                        $("#wearhouse").change(function() {


                            var actionUrl = '{{ env('APP_URL') }}stock/getitems';

                            $.ajax({
                                type: "GET",
                                url: actionUrl,
                                data: {
                                    wearhouseid: $("#wearhouse").val()
                                },
                                success: function(data) {
                                    console.log(data);

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
