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

                    <form name="wearhouse" id="wearhouse" action="{{ env('APP_URL') }}stock/addnew" method="POST">
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


                            <input type="hidden" name="type" value="1">

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

                            <!-- Category -->
                            {{-- <div class="col-md-3 form-group ">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" disabled>
                    </div> --}}

                            <!-- Brand -->
                            <div class="col-md-3 form-group ">
                                <label for="brand">Brand</label>
                                <select class="form-control" id="brand" name="brand">
                                    <option selected></option>
                                    @if (isset($brands) && is_array($brands))
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                            <!-- Supplier -->
                            <div class="col-md-3 form-group ">
                                <label for="supplier">Supplier</label>

                                <select class="form-control" id="supplier" name="supplier">
                                    <option selected></option>
                                    @if (isset($suppliers) && is_array($suppliers))
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Barcode/UPC -->
                            <div class="col-md-3 form-group ">
                                <label for="barcode">Barcode/UPC</label>
                                <input type="text" class="form-control" id="barcode" name="barcode"
                                    placeholder="Enter barcode or UPC">
                            </div>

                            <!-- Description -->
                            <div class="col-md-6 form-group ">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" placeholder="Enter description" name="description"></textarea>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Quantity in Stock -->
                            {{-- <div class="col-md-3 form-group ">
                <label for="quantityInStock">Quantity in Stock</label>
                <input type="text" class="form-control" id="quantityInStock" disabled name="instock">
            </div> --}}

                            <!-- New Quantity -->
                            <div class="col-md-3 form-group ">
                                <label for="newQuantity">Quantity</label>
                                <input type="number" class="form-control" id="newQuantity" placeholder="Enter new quantity"
                                    name="newquantity">
                            </div>

                            <!-- Minimum Stock Level -->
                            <div class="col-md-3 form-group ">
                                <label for="minStockLevel">Minimum Stock Level</label>
                                <input type="number" class="form-control" id="minStockLevel"
                                    placeholder="Enter minimum stock level" name="minstocklevel">
                            </div>

                        </div>

                        <div class="row">


                            <!-- Batch Number -->
                            <div class="col-md-3 form-group ">
                                <label for="batchNumber">Batch Number</label>
                                <input type="text" class="form-control" id="batchNumber" placeholder="Enter batch number"
                                    name="batchnumber">
                            </div>

                            <!-- Lot Number -->
                            <div class="col-md-3 form-group ">
                                <label for="lotNumber">Lot Number</label>
                                <input type="text" class="form-control" id="lotNumber" placeholder="Enter lot number"
                                    name="lotnumber">
                            </div>

                            <!-- PO Number -->
                            <div class="col-md-3 form-group ">
                                <label for="ponumber">Order/PO Number</label>
                                <input type="text" class="form-control" id="ponumber" placeholder="Enter PO number"
                                    name="ponumber">
                            </div>

                            <!-- Expiration Date -->
                            <div class="col-md-3 form-group ">
                                <label for="expDate">Expiration Date</label>
                                <input type="date" class="form-control" id="expDate" name="expdate">
                            </div>
                        </div>
                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-3 form-group ">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter price"
                                    name="price">
                            </div>

                            <!-- Cost Price -->
                            <div class="col-md-3 form-group ">
                                <label for="costPrice">Cost Price</label>
                                <input type="number" class="form-control" id="costPrice" name="costprice"
                                    placeholder="Enter cost price">
                            </div>



                        </div>
                        <div class="row">
                            <!-- Unit of Measure -->
                            <div class="col-md-3 form-group ">
                                <label for="unitOfMeasure">Unit of Measure</label>
                                <input type="text" class="form-control" id="unitOfMeasure"
                                    placeholder="Enter unit of measure" name="unitofmeasure">
                            </div>

                            <!-- Weight -->
                            <div class="col-md-3 form-group ">
                                <label for="weight">Weight</label>
                                <input type="number" class="form-control" id="weight" placeholder="Enter weight"
                                    name="weight">
                            </div>

                            <!-- Dimensions -->
                            <div class="col-md-3 form-group ">
                                <label for="dimensions">Dimensions</label>
                                <input type="text" class="form-control" id="dimensions"
                                    placeholder="Enter dimensions (e.g., 10x5x3 cm)" name="dimension">
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
                                    if (data = 'success') {
                                        alert('Item addes successfully');
                                        $("#wearhouse").trigger("reset");
                                    } else {
                                        alert(data);
                                    }
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
