@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Section Wise Question Add</h3>
                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="{{ url('question') }}" class="btn btn-sm btn-default"><i
                                            class="fa fa-list"></i>Question List</a>
                            </div>
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    <form id="question_form" class="form-horizontal" method="POST"  >
                        <div  class="alert isa_error" role="alert" style="display: none">
                            Please check the fields marked with
                            <span class="text-red fa fa-close"></span>.
                        </div>
                        <div class="box-body">
                            <div class="fields-group">
                                @foreach($sections as $section)
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="panel panel-info section-panel">
                                                <div class="panel-heading panel-heading-section">
                                                    <h3 class="panel-title">
                                                        <span class="clickable"><i
                                                                    class="btn-plus fa fa-minus"></i></span>
                                                        {{$section->section_name}}&nbsp;({{$section->details}}) <input class="section_id required" type="hidden" name="section_{{$section->section_id}}[section_id]"
                                                                                          value="{{$section->section_id}}">
                                                    </h3>
                                                    <span class="pull-right clickable"><i
                                                                class="btn-arrow fa fa-chevron-up"></i></span>
                                                </div>
                                                <div class="panel-body">
                                                    <button type="button" class="btn btn-success btn-xs question-block-add"><i class="fa fa-plus"> </i> Add</button>
                                                    @foreach($section->questions as $question)
                                                        <div class="panel panel-info single-question">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">
                                                                    <span class="child-clickable"><i class="btn-plus fa fa-minus">&nbsp;&nbsp;{{$question->question_text}}</i></span>
                                                                </h3>
                                                                <span class="pull-right">
                                                                    <button type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-down down-question-block" ></i></button>
                                                                    <button type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-up up-question-block" ></i></button>
                                                                    <button type="button" class="btn btn-outline-info btn-sm del-question-block"><i class="fa fa-trash " ></i></button>
                                                                </span>
                                                            </div>
                                                            <div class="panel-body">

                                                                <div class="form-group row">
                                                                    <label for="user_id" class="control-label col-sm-2 inline-label">Question</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                                            <input type="hidden" class="q-count" value="{{$loop->iteration}}">
                                                                            <input type="hidden" name="section_{{$section->section_id}}[questions][q{{$loop->iteration}}][question_id]" value="{{$question->question_id}}">
                                                                            <input type="text" name="section_{{$section->section_id}}[questions][q{{$loop->iteration}}][text]" value="{{$question->question_text}}"
                                                                                   class="form-control question-text required" autofocus>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row ">
                                                                    <label for="user_type" class="control-label col-sm-2 inline-label">Question Type</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                                            <input type="hidden" class="combo-selection" value="{{$question->question_type}}">
                                                                            <select class="form-control required question_type" name="section_{{$section->section_id}}[questions][q{{$loop->iteration}}][question_type]">
                                                                                <option value="single"> Single Select</option>
                                                                                <option value="multiple"> Multiple Select</option>
                                                                                <option value="text"> text</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row options">
                                                                    <label for="user_id" class="control-label col-sm-2 inline-label">
                                                                        Options &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-success btn-add-option btn-xs">
                                                                            <i class="fa fa-plus "></i>
                                                                        </button>
                                                                    </label>
                                                                    <div class="col-sm-10 option">
                                                                        @foreach($question->options as $option)
                                                                            <div class="single-option">
                                                                                <div class="form-group row">
                                                                                    <label for="user_id" class="control-label col-sm-1 inline-label">Option</label>
                                                                                    <div class="col-sm-10">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon option-value">
                                                                                            <input type="hidden" value="{{$loop->iteration}}" class="op-count">
                                                                                            <input type="hidden"  name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][option_id]" value="{{$option->option_id}}">
                                                                                            <input type="number" class="form-control" name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][value]" value="{{$option->option_value}}">
                                                                                        </span>
                                                                                            <input type="text" class="form-control required" name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][text]" value="{{$option->option_text}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    <button type="button" class="btn btn-danger btn-xs btn-option-del"><i class="fa fa-trash "></i></button>
                                                                                    </div>
                                                                                <div class="form-group row child-options">
                                                                                    <label for="user_id" class="control-label col-sm-2 inline-label">
                                                                                        Child &nbsp;&nbsp;
                                                                                        <button type="button" class="btn btn-success btn-xs btn-add-child-option">
                                                                                            <i class="fa fa-plus "></i>
                                                                                            </button>
                                                                                        </label>
                                                                                        <div class="col-md-10">
                                                                                            <input type="hidden" class="child-type-selection" value="{{$option->child_option_type}}">
                                                                                            <input type="radio" name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][child_option_type]" id="{{$section->section_id}}_{{$loop->parent->iteration}}_{{$loop->iteration}}_S" value="single" class="single-child">
                                                                                            <label class="control-label" for="">Single</label>
                                                                                            <input type="radio" name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][child_option_type]" id="{{$section->section_id}}_{{$loop->parent->iteration}}_{{$loop->iteration}}_M" value="multiple" class="multiple-child">
                                                                                            <label class="control-label" for="">Multiple</label>
                                                                                            <input type="radio" name="section_{{$section->section_id}}[questions][q{{$loop->parent->iteration}}][options][op{{$loop->iteration}}][child_option_type]" id="{{$section->section_id}}_{{$loop->parent->iteration}}_{{$loop->iteration}}_T" value="text" class="multiple-child">
                                                                                            <label class="control-label" for="">Text</label>
                                                                                        </div>
                                                                                        <div class="col-md-1"></div>
                                                                                         <div class="col-sm-11 child-option">
                                                                                            @foreach($option->child_options as $child_option)
                                                                                                <div class="single-child-option">
                                                                                                    <div class="form-group row">
                                                                                                        <label for="user_id" class="control-label col-sm-1 inline-label">Option</label>
                                                                                                        <div class="col-sm-9">
                                                                                                            <div class="input-group">
                                                                                                                <input type="hidden" value="{{$loop->iteration}}" class="ch-op-count">
                                                                                                                <span class="input-group-addon option-value">
                                                                                                                    <input type="hidden" name="section_{{$section->section_id}}[questions][q{{$loop->parent->parent->iteration}}][options][op{{$loop->parent->iteration}}][ch_op{{$loop->iteration}}][child_option_id]" value="{{$child_option->option_id}}">
                                                                                                                    <input type="number" name="section_{{$section->section_id}}[questions][q{{$loop->parent->parent->iteration}}][options][op{{$loop->parent->iteration}}][ch_op{{$loop->iteration}}][value]" class="form-control required" value="{{$child_option->option_value}}">
                                                                                                                </span>
                                                                                                                <input type="text" class="form-control required" name="section_{{$section->section_id}}[questions][q{{$loop->parent->parent->iteration}}][options][op{{$loop->parent->iteration}}][ch_op{{$loop->iteration}}][text]" value="{{$child_option->option_text}}">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <button type="button" class="btn btn-danger btn-xs btn-child-option-del"><i class="fa fa-trash "></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{--<input type="text" class="data-str" name="data">--}}
                                <div class="form-group row">
                                    {{--<div class="col-md-2"></div>--}}
                                    <div class="col-md-3 col-md-offset-5">
                                        <button id="submit" type="button" class="btn btn-primary">
                                            Submit
                                        </button>
                                        {{--<button id="submit2" type="submit" class="btn btn-primary">--}}
                                            {{--Submit--}}
                                        {{--</button>--}}
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
        $(document).ready(function () {
            // close all
            $('.panel-heading span.clickable').parents('.panel').find('.panel-body').slideUp();
            $('.panel-heading span.clickable').addClass('panel-collapsed');
            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus');

            //open first
            $('.panel-heading span.clickable:first').parents('.panel').find('.panel-body').slideDown();
            $('.panel-heading span.clickable:first').removeClass('panel-collapsed');
            $('.panel-heading span.clickable:first').closest('.panel-heading').find('.btn-plus').removeClass('fa-plus').addClass('fa-minus');
            $('.panel-heading span.clickable:first').closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up');

            // tangle click
            $(document).on('click', '.clickable,.child-clickable', function (e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.closest('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus');
                } else {
                    $this.closest('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-plus').addClass('fa-minus');
                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }
            });
            //question block add
            $('.question-block-add').on("click",function (e) {
                var q_no = 0;
                var s_id = $(this).closest('.section-panel').find('.section_id').val();
                $(this).closest('.section-panel').find('.q-count').each(function( indx, el ){
                    if(parseInt(el.value) > q_no){
                        q_no = parseInt(el.value);
                    }
                });
                var op_no = 0;
                $(this).closest('.options').find('.option .op-count').each(function( indx, el ){
                    if(parseInt(el.value) > op_no){
                        op_no = parseInt(el.value);
                    }
                });
                q_no = q_no +1;
             var question_block_html  = ' <div class="panel panel-info single-question">';
                 question_block_html += '     <div class="panel-heading">';
                 question_block_html += '         <h3 class="panel-title">';
                 question_block_html += '            <span class="child-clickable"><i class="btn-plus fa fa-minus"> </i></span> ';
                 question_block_html += '         </h3>';
                 question_block_html += '         <span class="pull-right">';
                 question_block_html += '              <button type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-down down-question-block"></i></button>';
                 question_block_html += '              <button type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-up up-question-block"></i></button>';
                 question_block_html += '              <button type="button" class="btn btn-outline-info btn-sm del-question-block"><i class="fa fa-trash "></i></button>';
                 question_block_html += '         </span>';
                 question_block_html += '     </div>';
                 question_block_html += '     <div class="panel-body">';
                 question_block_html += '         <div class="form-group row">';
                 question_block_html += '              <label for="user_id" class="control-label col-sm-2 inline-label">Question</label>';
                 question_block_html += '              <div class="col-sm-10">';
                 question_block_html += '                   <div class="input-group">';
                 question_block_html += '                        <input type="hidden" class="q-count" value="'+q_no+'">';
                 question_block_html += '                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>';
                 question_block_html += '                        <input type="hidden" name="section_'+s_id+'[questions][q'+q_no+'][question_id]">';
                 question_block_html += '                        <input type="text" name="section_'+s_id+'[questions][q'+q_no+'][text]" class="form-control question-text required" placeholder="Question Text Here">';
                 question_block_html += '                   </div>';
                 question_block_html += '             </div>';
                 question_block_html += '        </div>';
                 question_block_html += '        <div class="form-group row ">';
                 question_block_html += '            <label for="user_type" class="control-label col-sm-2 inline-label">Question Type</label>';
                 question_block_html += '            <div class="col-sm-10">';
                 question_block_html += '                <div class="input-group">';
                 question_block_html += '                     <span class="input-group-addon"><i class="fa fa-pencil"></i></span>';
                 question_block_html += '                     <select class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][question_type]">';
                question_block_html += '                           <option value="single"> Single Select</option>';
                question_block_html += '                           <option value="multiple"> Multiple Select</option>';
                question_block_html += '                           <option value="text"> Text</option>';
                question_block_html += '                     </select>';
                question_block_html += '                </div>';
                question_block_html += '            </div>';
                question_block_html += '        </div>';
                question_block_html += '        <div class="form-group row options">';
                question_block_html += '            <label for="user_id" class="control-label col-sm-2 inline-label">';
                question_block_html += '                Options &nbsp;&nbsp;';
                question_block_html += '                <button type="button" class="btn btn-success btn-add-option btn-xs">';
                question_block_html += '                    <i class="fa fa-plus"></i>';
                question_block_html += '                </button>';
                question_block_html += '            </label>';
                question_block_html += '            <div class="col-sm-10 option">';
                question_block_html += '                <div class="single-option">';
                question_block_html += '                    <div class="form-group row">';
                question_block_html += '                         <label for="user_id" class="control-label col-sm-1 inline-label no-padding">Option</label>';
                question_block_html += '                    <div class="col-sm-10">';
                question_block_html += '                <div class="input-group">';
                question_block_html += '                    <span class="input-group-addon option-value">';
                question_block_html += '                         <input type="hidden" value="'+op_no+'" class="op-count">';
                question_block_html += '                         <input type="number" class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][value]" placeholder="Value">';
                question_block_html += '                    </span>';
                question_block_html += '                    <input type="hidden"  name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][option_id]">';
                question_block_html += '                    <input type="text" class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][text]" placeholder="Option Here">';
                question_block_html += '                </div>';
                question_block_html += '            </div>';
                question_block_html += '            <button type="button" class="btn btn-danger btn-xs btn-option-del"><i class="fa fa-trash "></i></button>';
                question_block_html += '        </div>';
                question_block_html += '        <div class="form-group row child-options">';
                question_block_html += '             <label for="user_id" class="control-label col-md-2 inline-label">';
                question_block_html += '                  Child &nbsp;&nbsp;';
                question_block_html += '                 <button type="button" class="btn btn-success btn-xs btn-add-child-option">';
                question_block_html += '                      <i class="fa fa-plus "></i>';
                question_block_html += '                </button>';
                question_block_html += '             </label>';
                question_block_html += '          <div class="col-md-10">';
                question_block_html += '              <input type="hidden" class="child-type-selection" value="">';
                question_block_html += '              <input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="single" class="single-child">';
                question_block_html += '              <label class="control-label" for="">Single</label>';
                question_block_html += '              <input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="multiple" class="multiple-child">';
                question_block_html += '              <label class="control-label" for="">Multiple</label>';
                question_block_html += '              <input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="text" class="text-child">';
                question_block_html += '              <label class="control-label" for="">Text</label>';
                question_block_html += '         </div>';
                question_block_html += '          <div class="col-md-1"></div>';
                question_block_html += '               <div class="col-md-11 child-option">';
                question_block_html += '               </div>';
                question_block_html += '          </div>';
                question_block_html += '       </div>';
                question_block_html += '   </div>';
                question_block_html += '    <input type="hidden" class="combo-selection" value="">';
                 question_block_html += '</div>';
                 question_block_html += '    </div>';
                 question_block_html += '    </div>';

                $(this).closest('.panel-body').append(question_block_html);
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
            //name on header
            $(document).on("change",'.question-text',function (){
               var question_text = $(this).val();
               $(this).closest('.panel-info').find('h3 i').text("  "+question_text);
            });
            //remove question block
            $(document).on("click",'.del-question-block',function () {
                if($('.single-question').length>1) {
                    $(this).closest('.single-question').remove();
                }else{
                    ShowErrorMsg("Only Question",'There must be a Question at least');
                }
            });
            //remove option block
            $(document).on("click",'.btn-option-del',function () {
                if($(this).closest('.single-question').find('.single-option').length>1){
                    $(this).closest('.single-option').remove();
                }else{
                    ShowErrorMsg("Only Option",'There must be a Option at least');
                }
            });

            //remove child option block
            $(document).on("click",'.btn-child-option-del',function () {
               $(this).closest('.single-child-option').remove();
            });
            //add option block
            $(document).on("click",'.btn-add-option',function () {
                var q_no = parseInt($(this).closest('.panel-body').find('.q-count').val());
                var s_id = $(this).closest('.section-panel').find('.section_id').val();
                var op_no = 0;
                $(this).closest('.options').find('.option .op-count').each(function( indx, el ){
                    if(parseInt(el.value) > op_no){
                        op_no = parseInt(el.value);
                    }
                });
                op_no = op_no +1;
                var option_block_html = '';
                option_block_html += '<div class="single-option">'+
                                           '<div class="form-group row">'+
                                            '<label for="user_id" class="control-label col-sm-1 inline-label no-padding">Option</label>'+
                                            '<div class="col-sm-10">'+
                                                '<div class="input-group">'+
                                                    '<span class="input-group-addon option-value">'+
                                                        '<input type="hidden" value="'+op_no+'" class="op-count">'+
                                                        '<input type="number" class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][value]" placeholder="Value">'+
                                                    '</span>'+
                                                    '<input type="hidden"  name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][option_id]">'+
                                                    '<input type="text" class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][text]" placeholder="Option Here">'+
                                                '</div>'+

                                            '</div>'+
                                            '<button type="button" class="btn btn-danger btn-xs btn-option-del"><i class="fa fa-trash "></i></button>'+
                                        '</div>'+
                                        '<div class="form-group row child-options">'+
                                            '<label for="user_id" class="control-label col-md-2 inline-label">'+
                                                'Child &nbsp;&nbsp;'+
                                                '<button type="button" class="btn btn-success btn-xs btn-add-child-option">'+
                                                    '<i class="fa fa-plus "></i>'+
                                                '</button>'+
                                            '</label>'+
                                            '<div class="col-md-10">'+
                                                '<input type="hidden" class="child-type-selection" value="">'+
                                                '<input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="single" class="single-child">'+
                                                '<label class="control-label" for="">Single</label>'+
                                                '<input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="multiple" class="multiple-child">'+
                                                '<label class="control-label" for="">Multiple</label>'+
                                                '<input type="radio" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][child_option_type]" id="" value="text" class="text-child">'+
                                                '<label class="control-label" for="">Text</label>'+
                                            '</div>'+
                                            '<div class="col-md-1"></div>'+
                                            '<div class="col-md-11 child-option">'+
                                            '</div>'+
                                        '</div>'+
                                '</div>';

                $(this).closest('.options').find('.option').append(option_block_html);
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
            //add child option
            $(document).on("click",'.btn-add-child-option',function () {
                var q_no = parseInt($(this).closest('.panel-body').find('.q-count').val());
                var op_no = parseInt($(this).closest('.single-option').find('.op-count').val());
                var s_id = $(this).closest('.section-panel').find('.section_id').val();
                var ch_op_no = 0;
                $(this).closest('.child-options').find('.ch-op-count').each(function( indx, el ){
                    if(parseInt(el.value) > ch_op_no){
                        ch_op_no = parseInt(el.value);
                    }
                });
                ch_op_no = ch_op_no + 1;
                var child_option_html =  '<div class="single-child-option">';
                    child_option_html += '    <div class="form-group row">' ;
                    child_option_html += '         <label for="user_id" class="control-label col-sm-1 inline-label no-padding">Option</label>' ;
                    child_option_html += '          <div class="col-sm-9">' ;
                    child_option_html += '              <div class="input-group">' ;
                    child_option_html += '                 <input type="hidden" value="'+ch_op_no+'" class="ch-op-count">';
                    child_option_html += '                 <span class="input-group-addon option-value">';
                    child_option_html += '                 <input type="number" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][ch_op'+ch_op_no+'][value]" class="form-control required" placeholder="Value"></span>';
                    child_option_html += '                 <input type="hidden"  name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][ch_op'+ch_op_no+'][child_option_id]" >' ;
                    child_option_html += '                 <input type="text" class="form-control required" name="section_'+s_id+'[questions][q'+q_no+'][options][op'+op_no+'][ch_op'+ch_op_no+'][text]" placeholder="Option Here">' ;
                    child_option_html += '              </div>' ;
                    child_option_html += '          </div>' ;
                    child_option_html += '      <button type="button" class="btn btn-danger btn-xs btn-child-option-del"><i class="fa fa-trash "></i></button>' ;
                    child_option_html += '    </div>';
                    child_option_html += '    </div>';
                $(this).closest('.child-options').find('.child-option').append(child_option_html);
            });
            // move up down
//            $('body').on("click",".down-question-block,.up-question-block",function(){
//                alert("eee");
//                var row = $(this);
//                if ($(this).is(".up-question-block")) {
//                    row.insertBefore(row.prev());
//                } else {
//                    row.insertAfter(row.next());
//                }
//            });

            // back button
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                history.back(1);
            });
            //combo selection
            $('.combo-selection').each(function (ind,el) {
               var val = el.value;
                $(this).closest('div').find('select option[value='+val+']').attr('selected','selected');

            });
            //child-type-selection
            $('.child-type-selection').each(function (ind,el) {
                var val = el.value;
                $(this).closest('div').find('.'+val+'-child').prop('checked',true);

            });

            //submit form
            $('#submit').on("click",function (e) {
                if(!Validate("Question was not added","Please check details.")){
                    return 0;
                }
                if(!$('.single-option').length>0){
                    ShowErrorMsg("No question","There must be a Question at least");
                    return 0;
                }
                var data = {};
                var formData = $('form').serializeJSON();
                data['_token'] = $("[name='_token']").val();
                data['data'] = str_to_obj(formData);
//                console.log(data);
//                $('.data-str').val(formData);
                 $.ajax({
                    url: '{{url('/question')}}',
//                    url: '',
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if(result.outcome == 'success'){
                            swal("Question added!", result.msg, "success");
                            location.reload();
                        }else{
                            swal("Error !", result.msg, "warning");
                        }
                    },
                     error:function (result) {
                         if(result.outcome == 'success'){
                                swal("Question added", result.msg, "success");
                             location.reload();
                            }else{
                                swal("Error !", result.msg, "warning");
                             }
                     }
                });
            });
            function str_to_obj(str) {
                str = JSON.parse(str);
                var obj_arr = [];
                for(var key in str){
                    if(key.indexOf('section_') != -1){
                        var obj = {};
                        obj['section_id'] = str[key]['section_id'];
                        var q_arr = [];
                        for(var ques in str[key]['questions']){
                            var que_obj = {};
                            que_obj['question_id'] = str[key]['questions'][ques]['question_id'];
                            que_obj['question_text'] = str[key]['questions'][ques]['text'];
                            que_obj['question_type'] = str[key]['questions'][ques]['question_type'];
                            var ops_arr = [];
                            for(var ops in str[key]['questions'][ques]['options']){
                                var ops_obj = {};
                                ops_obj['option_id'] = str[key]['questions'][ques]['options'][ops]['option_id'];
                                ops_obj['child_option_type'] = str[key]['questions'][ques]['options'][ops]['child_option_type'];
                                ops_obj['option_text'] = str[key]['questions'][ques]['options'][ops]['text'];
                                ops_obj['option_value'] = str[key]['questions'][ques]['options'][ops]['value'];
                                var ch_arr=[];
                                for(var ch_key in str[key]['questions'][ques]['options'][ops]){
                                    if(ch_key.indexOf('ch_op') != -1){
                                        var ch_obj={};
                                        ch_obj['child_option_id'] = str[key]['questions'][ques]['options'][ops][ch_key]['child_option_id'];
                                        ch_obj['child_option_text'] = str[key]['questions'][ques]['options'][ops][ch_key]['text'];
                                        ch_obj['child_option_value'] = str[key]['questions'][ques]['options'][ops][ch_key]['value'];
                                        ch_arr.push(ch_obj);
                                    }
                                }
                                ops_obj['child_options'] = ch_arr;
                                ops_arr.push(ops_obj)
                            }
                            que_obj['options'] = ops_arr;
                            q_arr.push(que_obj);
                        }
                        obj['questions'] = q_arr;
                        obj_arr.push(obj);
                    }
                }
                return obj_arr;
            }
          $(".question_type").on("change",function () {
             if($(this).val() == 'text'){

             }
          });
        });
    </script>
@endsection