@extends('index')

@section('content')

    <section class="content">
        <h3>Change Account Password</h3>

        <div class="row">
            <!--region-->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-body">

                        <!-- form -->

                        <div class="box-body">
                            <form role="form">
                                <div class="form-group">
                                    <label for="oldpass">Old Password</label>
                                    <input type="password" class="form-control" id="oldpass" placeholder="Old Password">
                                </div>

                                <div class="form-group">
                                    <label for="newpass">New Password</label>
                                    <input type="password" class="form-control" id="newpass" placeholder="New Password">
                                </div>

                                <div class="form-group">
                                    <label for="repass">Re-type New Password </label>
                                    <input type="password" class="form-control" id="repass" placeholder="Re-type New Password">
                                </div>
                            </form>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger" id="reset_submit">Change Password</button>
                        </div>



                    </div>
                </div>
            </div>
            <!--//region-->

        </div>
    </section>

@endsection
@section('script')
    <script>


    </script>
@endsection