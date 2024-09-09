@extends('index')

@section('content')
    <section class="content-header"></section>

    <section class="content">

            <form action="upload" method="POST" enctype="multipart/form-data" id="upload-file">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="file_to_upload" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>

    </section>
@endsection
@section('script')
    <script></script>
@endsection