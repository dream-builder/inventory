@extends('index')
@section('content')
    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            Items
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Item</h3>
                </div>
                <div class="box-body">

                    <form name="wearhouse" id="wearhouse" action="{{ env('APP_URL') }}item/addnew" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="sku" class="form-label" title="Stock Keeping Unit">SKU </label>
                                <input type="text" class="form-control" id="sku" placeholder="SKU" name="sku">
                            </div>



                            <div class="col-md-2 form-group">
                                <label for="expdate" class="form-label">Exp Date</label>
                                <input type="date" class="form-control" id="expdate" placeholder="Expdate"
                                    name="expdate">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">

                                <label for="cat" class="form-label">Category</label>
                                <select class="form-control" id="cat" name="cat">
                                    <option></option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" placeholder="Enter address" name="description"></textarea>
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
