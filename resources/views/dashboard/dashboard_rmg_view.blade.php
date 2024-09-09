@extends('index')
@section('content')
    <section class="content-header" style="margin-bottom: 25px">
        {{-- <h1 style="display: inline-block">
            <a href="{{ url('/') }}" style="color: #0A4F21"><i class="fa fa-dashboard"></i> Dashboard</a>
        </h1> --}}
    </section>

    <section>
        <style>
            .dash-item {
                border-style: solid;
                border-width: 1px;
                border-color: #ddd !important;
                background-color: #FFF;
                padding: 20px;
                text-align: center;
                border-radius: 5px;
                box-shadow: 0px 0px 2px 0px #ccc;
                cursor: pointer;
                margin-right: 20px;
            }

            .dash-item-icon img {
                width: auto;
                height: 80px;
            }

            .dash-item-text {
                color: #036e88;
                font-weight: bold;
            }
        </style>
        <div class="col-md-12">

            <div class="col-md-3 dash-item">
                <div class="dash-item-icon"><img src="public/image/factory.jpg"></div>
                <div class="dash-item-text">Factory Profile</div>
            </div>

            <div class="col-md-3 dash-item">
                <div class="dash-item-icon"><img src="public/image/survey.png"></div>
                <div class="dash-item-text">Survey List</div>
            </div>

            <div class="col-md-3 dash-item">
                <div class="dash-item-icon"><img src="public/image/questions.png"></div>
                <div class="dash-item-text">Questions</div>
            </div>


        </div>

    </section>
@endsection
@section('script')
    <script></script>
@endsection
