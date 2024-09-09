@extends('index')
    @section('content')
           <section class="content">

            <div class="row">
               <!--region-->
               <div class="col-md-12" >
                   <!-- search section -->
                   <div class="box box-warning">
                       <div class="box-header with-border">
                           <h3 class="box-title text-warning" >Not found</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body" >
                           <?php if(isset($err)) echo $err; else{?>
                           Sorry! The information you are looking for are not found in system. Please check your URL.
                           <?php }?>
                       </div>
                   </div>
               </div>
           </div>

        </section>
    @endsection

