@extends('layouts.app')

@section('content')

<div class="container row mb-2">
    <p class="m-0" style="font-size: 2em;" onclick="editScreeningTestName()">{{ $test->name }}</p>
    <input id="testName" class="form-control display-none" type="text" autofocus="" style="max-width: 211px;">
    <div class="ml-3 display-none" style="padding-top: 6px;">
        <i class="fa fa-check fa-lg text-success cursor mr-3" onclick="saveScreeningTestName()" title="Save" aria-hidden="true"></i>
        <i class="fa fa-close fa-lg text-muted cursor" onclick="cancelEditScreeningTestName()" title="Cancel" aria-hidden="true"></i>
    </div>
</div>

<div class="container text-center" style="margin-bottom: 20px;">
    Language: &nbsp;&nbsp;
    <div class="btn-group" role="group" aria-label="Language Buttons" id="language">
        <button type="button" class="btn btn-outline-info btn-sm active" onclick="changeLanguage()">English</button>
        <button type="button" class="btn btn-outline-info btn-sm" onclick="changeLanguage()">Malay</button>
    </div>
</div>

<div class="row">
    {{--  Questions  --}}
    <div class="col-md-7">
        {{--  English  --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                Questions
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <h4 class="card-title float-left">Questions</h4>
                    <a id="questions_btnAdd" href="javascript:;" onclick="displayInput('qs'); return false;" 
                        class="btn btn-outline-primary btn-sm float-left" style="right: 1.25rem; position: absolute;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp; Add
                    </a>
                </div>
                @if (count($english_questions) > 0)
                    @foreach ($english_questions as $question)
                        <p class="card-text" data-id="{{ $question['id'] }}" onclick="edit(`qs`)">
                            {{($loop->index + 1) . ". " . $question['question']}}
                            @switch ($question['type'])
                                @case (0)
                                    <span class="badge badge-pill badge-info float-right my-1">Anxiety</span>
                                    @break
                                @case (1)
                                    <span class="badge badge-pill badge-danger float-right my-1">Depression</span>
                                    @break
                                @default
                                    <span class="badge badge-pill badge-warning float-right my-1">Stress</span>
                            @endswitch
                        </p>
                        <div class="row mb-3 display-none">
                            <div class="col-md-10 col-lg-10 row">
                                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8">
                                    <input class="form-control" type="text" autofocus="">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-5 col-lg-4">
                                    <select class="form-control typeSelect">
                                        <option>Anxiety</option>
                                        <option>Depression</option>
                                        <option>Stress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="float-right mt-1 ml-3 pr-0">
                                <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('qs')" title="Save" aria-hidden="true"></i>
                                <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                        <h3 class="text-center text-primary">
                            No Question
                        </h3>
                    </div>
                @endif
            </div>
        </div>
        {{--  Malay  --}}
        <div class="card display-none">
            <div class="card-header bg-primary text-white">
                Soalan
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <h4 class="card-title float-left">Soalan</h4>
                    <a id="questions_btnAdd" href="javascript:;" onclick="displayInput('qs'); return false;" 
                        class="btn btn-outline-primary btn-sm float-left" style="right: 1.25rem; position: absolute;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp; Tambah
                    </a>
                </div>
                @if (count($malay_questions) > 0)
                    @foreach ($malay_questions as $question)
                        <p class="card-text" data-id="{{ $question['id'] }}" onclick="edit(`qs`)">
                            {{($loop->index + 1) . ". " . $question['question']}}
                            @switch ($question['type'])
                                @case (0)
                                    <span class="badge badge-pill badge-info float-right my-1">Anxiety</span>
                                    @break
                                @case (1)
                                    <span class="badge badge-pill badge-danger float-right my-1">Depression</span>
                                    @break
                                @default
                                    <span class="badge badge-pill badge-warning float-right my-1">Stress</span>
                            @endswitch
                        </p>
                        <div class="row mb-3 display-none">
                            <div class="col-md-10 col-lg-10 row">
                                <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8">
                                    <input class="form-control" type="text" autofocus="">
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-5 col-lg-4">
                                    <select class="form-control typeSelect">
                                        <option>Anxiety</option>
                                        <option>Depression</option>
                                        <option>Stress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="float-right mt-1 ml-3 pr-0">
                                <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('qs')" title="Save" aria-hidden="true"></i>
                                <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                        <h3 class="text-center text-primary">
                            Tiada Soalan
                        </h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--  End of Questions  --}}

    {{--  Answers  --}}
    <div class="col-md-5">
        {{--  English  --}}
        <div class="card">
            <div class="card-header bg-success text-white">
                Answers
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <h4 class="card-title float-left">Answers</h4>
                    <a id="answers_btnAdd" href="javascript:;" onclick="displayInput('ans'); return false;" 
                        class="btn btn-outline-success btn-sm float-left" style="right: 1.25rem; position: absolute;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp; Add
                    </a>
                </div>
                @if (count($english_choices) > 0)
                    @foreach ($english_choices as $choice)
                        <p class="card-text" data-id="{{ $choice['id'] }}" onclick="edit(`ans`)">
                            {{($loop->index + 1) . ". " . $choice['choice']}}
                            <span class="badge badge-pill badge-success float-right my-1">
                                {{ $choice['marks'] }}
                            </span>
                        </p>
                        <div class="row mb-3 display-none">
                            <div class="col-md-10 col-lg-9 row">
                                <div class="col-sm-9 col-md-12 col-lg-8">
                                    <input class="form-control" type="text" autofocus="">
                                </div>
                                <div class="col-sm-3 col-md-12 col-lg-4">
                                    <input class="form-control marks" type="text" placeholder="Marks">
                                </div>
                            </div>
                            <div class="col-md-3 pt-1 pr-0">
                                <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('ans')" title="Save" aria-hidden="true"></i>
                                <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                        <h3 class="text-center text-success">
                            No Answer
                        </h3>
                    </div>
                @endif
            </div>
        </div>
        {{--  Malay  --}}
        <div class="card display-none">
            <div class="card-header bg-success text-white">
                Jawapan
            </div>
            <div class="card-body">
                <div class="clearfix">
                    <h4 class="card-title float-left">Jawapan</h4>
                    <a id="answers_btnAdd" href="javascript:;" onclick="displayInput('ans'); return false;" 
                        class="btn btn-outline-success btn-sm float-left" style="right: 1.25rem; position: absolute;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        &nbsp; Tambah
                    </a>
                </div>
                @if (count($malay_choices) > 0)
                    @foreach ($malay_choices as $choice)
                        <p class="card-text" data-id="{{ $choice['id'] }}" onclick="edit(`ans`)">
                            {{($loop->index + 1) . ". " . $choice['choice']}}
                            <span class="badge badge-pill badge-success float-right my-1">
                                {{ $choice['marks'] }}
                            </span>
                        </p>
                        <div class="row mb-3 display-none">
                            <div class="col-md-10 col-lg-9 row">
                                <div class="col-sm-9 col-md-12 col-lg-8">
                                    <input class="form-control" type="text" autofocus="">
                                </div>
                                <div class="col-sm-3 col-md-12 col-lg-4">
                                    <input class="form-control marks" type="text" placeholder="Marks">
                                </div>
                            </div>
                            <div class="col-md-3 pt-1 pr-0">
                                <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('ans')" title="Save" aria-hidden="true"></i>
                                <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                        <h3 class="text-center text-success">
                            Tiada Jawapan
                        </h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--  End of Answers  --}}
</div>

@endsection

@section('javascript')
    <script>
        function editScreeningTestName(ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            $(el).addClass("display-none");

            $("#testName").removeClass("display-none");
            $("#testName").val($(el).html());

            $(el).next().next().removeClass("display-none");
        }
        
        function saveScreeningTestName(){
            var newName = $("#testName").val();
            $.ajax({
                type: "POST",
                url: location.href.substring(0, location.href.length - 5),
                data: { _method: 'PUT', 
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        name: newName },
                dataType: 'text',
                success: function (text) {
                    $("#testName").prev().html(newName);
                    cancelEditScreeningTestName();
                    customAlert(text);
                }
            });
        }

        function cancelEditScreeningTestName(){
            $("#testName").addClass("display-none");
            $("#testName").prev().removeClass("display-none");
            $("#testName").next().addClass("display-none");
        }

        function displayInput(type){
            var div_cardbody = (type == "qs")   ?   ($("button.active").html() == "English")
                                                    ? $("div.card-body:eq(0)") : $("div.card-body:eq(1)")
                                                :   ($("button.active").html() == "English")
                                                    ? $("div.card-body:eq(2)") : $("div.card-body:eq(3)");

            if ( div_cardbody.children("div.jumbotron").length == 1 ){
                div_cardbody.children("div.jumbotron").remove();
            }
            else if (div_cardbody.children("div.row:not(.display-none)").length != 0){
                div_cardbody.children("div.row:not(.display-none)").find("input").focus();
                return;
            }
            appendInput(type);
        }

        function appendInput(type){
            if (type == "qs"){
                if ($("button.active").html() == "English"){
                    $("div.card-body:eq(0)").append(`<div class="row mb-3">
                                                        <div class="col-md-10 col-lg-10 row">
                                                            <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8">
                                                                <input class="form-control" type="text" autofocus>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-5 col-lg-4">
                                                                <select class="form-control typeSelect">
                                                                    <option>Anxiety</option>
                                                                    <option>Depression</option>
                                                                    <option>Stress</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="float-right mt-1 ml-3 pr-0">
                                                            <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('qs')" title="Save" aria-hidden="true"></i>
                                                            <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                                                        </div>
                                                    </div>`);
                }
                else{
                    $("div.card-body:eq(1)").append(`<div class="row mb-3">
                                                        <div class="col-md-10 col-lg-10 row">
                                                            <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8">
                                                                <input class="form-control" type="text" autofocus>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-5 col-lg-4">
                                                                <select class="form-control typeSelect">
                                                                    <option>Anxiety</option>
                                                                    <option>Depression</option>
                                                                    <option>Stress</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="float-right mt-1 ml-3 pr-0">
                                                            <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('qs')" title="Save" aria-hidden="true"></i>
                                                            <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                                                        </div>
                                                    </div>`);
                }
            }
            else{
                if ($("button.active").html() == "English"){
                    $("div.card-body:eq(2)").append(`<div class="row mb-3">
                                                        <div class="col-md-10 col-lg-9 row">
                                                            <div class="col-sm-9 col-md-12 col-lg-8">
                                                                <input class="form-control" type="text" autofocus>
                                                            </div>
                                                            <div class="col-sm-3 col-md-12 col-lg-4">
                                                                <input class="form-control marks" type="text" placeholder="Marks">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 pt-1 pr-0">
                                                            <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('ans')" title="Save" aria-hidden="true"></i>
                                                            <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                                                        </div>
                                                    </div>`);
                }
                else{
                    $("div.card-body:eq(3)").append(`<div class="row mb-3">
                                                        <div class="col-md-10 col-lg-9 row">
                                                            <div class="col-sm-9 col-md-12 col-lg-8">
                                                                <input class="form-control" type="text" autofocus>
                                                            </div>
                                                            <div class="col-sm-3 col-md-12 col-lg-4">
                                                                <input class="form-control marks" type="text" placeholder="Marks">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 pt-1 pr-0">
                                                            <i class="fa fa-check fa-lg text-primary cursor mr-3" onclick="add('ans')" title="Save" aria-hidden="true"></i>
                                                            <i class="fa fa-close fa-lg text-muted cursor mr-3" onclick="cancel_add()" title="Cancel" aria-hidden="true"></i>
                                                        </div>
                                                    </div>`)
                }
            }
        }
        
        function edit(type, ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);
            
            $("div.row.mb-3").each(function(){
                $(this).prev().removeClass("display-none");
                $(this).addClass("display-none");
            })

            $(el).addClass("display-none");
            var div_row = $(el).next();
            var p_html = $(el).html();
            
            if (type == 'qs'){
                $(div_row).find("select").val(
                    p_html.substring(p_html.indexOf('>') + 1, p_html.lastIndexOf('<'))
                );
                $(div_row).find("input").val(
                    p_html.substring(p_html.indexOf(". ") + 2, p_html.indexOf('<span')).trim()
                );
            }
            else{
                $(div_row).find("input.marks").val(
                    p_html.substring(p_html.indexOf(">") + 1, p_html.lastIndexOf('<')).trim()
                );
                $(div_row).find("input:eq(0)").val(
                    p_html.substring(p_html.indexOf(". ") + 2, p_html.indexOf('<span')).trim()
                );
            }

            $(div_row).removeClass("display-none");
            $(div_row).find("input").eq(0).focus();

            var div_action = $(div_row).children("div.mt-1").length != 0
                                    ? $(div_row).children("div.mt-1")
                                    : $(div_row).children("div.pt-1");

            if ($(div_action).children().length == 2){
                $(div_action).append('<i class="fa fa-trash fa-lg text-danger cursor" onclick="delete_this(`' +
                                        type +
                                    '`)" title="Delete" aria-hidden="true"></i>');
            }
        }

        function add(type, ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            var div_row = $(el).parent().parent();
            var input_value = div_row.find("input").val();

            // If value is not empty, store/update accordingly
            if (input_value)
            {
                var all_div_row = div_row.parent().children("div.row");
                var index = all_div_row.index(div_row);

                // New => Store
                if ($(div_row).prev().hasClass("row") || $(div_row).prev().hasClass("clearfix"))
                {
                    if (type == "qs"){
                        var question_type = $(div_row).find("select").val();
                        var badge_color = null, type_id = null;

                        switch (question_type){
                            case "Depression":
                                badge_color = "danger";
                                type_id = 1;
                                break;
                            case "Stress":
                                badge_color = "warning";
                                type_id = 2;
                                break;
                            default:
                                badge_color = "info";
                                type_id = 0;
                                break;
                        }

                        $.ajax({
                            type: "POST",
                            url: location.href.substring(0, location.href.length - 4) + "add_question",
                            data: {
                                question    :   input_value,
                                type        :   type_id,
                                language_id :   ($("#language").children(".active").html() == "English") ? 1 : 2,
                                _token      :   $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function (data) {
                                $("<p class='card-text' data-id='" + data.last_insert_id + "' onclick='edit(`" + type + "`)'>" 
                                    + (index + 1) + ". " + input_value 
                                    + "<span class='badge badge-pill badge-" + badge_color + " float-right my-1'>" + $(div_row).find("select").val() + "</span>"
                                    + "</p>")
                                    .insertBefore(div_row);

                                customAlert(data.message);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown){
                                console.log("Opps: AJAX error");
                            }
                        });  
                    }
                    else {
                        if ($(div_row).find("input.marks").val() == ""){
                            window.alert("The marks for answer is empty.");
                            return;
                        }
                        else if (!isFinite($(div_row).find("input.marks").val())){
                            window.alert("The marks for answer is invalid.");
                            return;
                        }
                        var choice_marks = div_row.find("input.marks").val();

                        $.ajax({
                            type: "POST",
                            url: location.href.substring(0, location.href.length - 4) + "add_choice",
                            data: {
                                choice      :   input_value,
                                marks       :   choice_marks,
                                language_id :   ($("#language").children(".active").html() == "English") ? 1 : 2,
                                _token      :   $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function (data) {
                                $("<p class='card-text' data-id='" + data.last_insert_id + "' onclick='edit(`" + type + "`)'>" 
                                    + (index + 1) + ". " + input_value 
                                    + "<span class='badge badge-pill badge-success float-right my-1'>" + choice_marks + "</span>"
                                    + "</p>")
                                    .insertBefore(div_row);

                                customAlert(data.message);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown){
                                console.log("Opps: AJAX error");
                            }
                        });  
                    }
                }
                else// Update
                {
                    if (type == "qs"){
                        var question_type = $(div_row).find("select").val();
                        var badge_color = null, type_id = null;

                        switch (question_type){
                            case "Depression":
                                badge_color = "danger";
                                type_id = 1;
                                break;
                            case "Stress":
                                badge_color = "warning";
                                type_id = 2;
                                break;
                            default:
                                badge_color = "info";
                                type_id = 0;
                                break;
                        }

                        var p = $(div_row).prev();

                        $.ajax({
                            type: "POST",
                            url: location.href.substring(0, location.href.length - 4) + "update_question",
                            data: {
                                question_id :   $(p).data('id'),
                                question    :   input_value,
                                type        :   type_id,
                                _method     :   'PUT',
                                _token      :   $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (text) {
                                $(p).html(
                                    $(p).html().substr(0, $(p).html().indexOf(". ") + 2)+ input_value
                                    + "<span class='badge badge-pill badge-" + badge_color + " float-right my-1'>" 
                                    + question_type + "</span>"
                                );

                                customAlert(text);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown){
                                console.log("Opps: AJAX error");
                            }
                        });
                    }
                    else{
                        var choice_marks = div_row.find("input.marks").val();
                        var p = $(div_row).prev();
                        
                        $.ajax({
                            type: "POST",
                            url: location.href.substring(0, location.href.length - 4) + "update_choice",
                            data: {
                                choice_id   :   $(p).data('id'),
                                choice      :   input_value,
                                marks       :   choice_marks,
                                _method     :   'PUT',
                                _token      :   $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (text) {
                                $(p).html(
                                    $(p).html().substr(0, $(p).html().indexOf(". ") + 2) + input_value
                                    + "<span class='badge badge-pill badge-success float-right my-1'>" 
                                    + choice_marks + "</span>"
                                );

                                customAlert(text);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown){
                                console.log("Opps: AJAX error");
                            }
                        });
                    }
                    $(div_row).prev().removeClass("display-none");
                }
                $(all_div_row[index]).addClass("display-none");
            }
            else
                cancel_add(ev);
        }

        function cancel_add(ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            var div_row = $(el).parent().parent();

            // New
            if ($(div_row).prev().hasClass("row") || $(div_row).prev().hasClass("clearfix"))
            {
                if ($(div_row).prev().hasClass("clearfix"))
                {
                    if ($("div.card-body:eq(0)").html() == $(div_row).parent().html()
                        || $("div.card-body:eq(1)").html() == $(div_row).parent().html())
                        appendJumbotron("qs");
                    else
                        appendJumbotron("ans");
                }

                $(div_row).remove();
            }
            else if ($(div_row).prev().hasClass("card-text"))
            {
                $(div_row).addClass("display-none");
                $(div_row).prev().removeClass("display-none");
            }
        }
        
        function delete_this(type, ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            var div_row = $(el).parent().parent();
            var p = $(div_row).prev();
            var html_p = $(p).html();
            var input_value = html_p.substring(html_p.indexOf(". ") + 2);

            $.ajax({
                type: "POST",
                url: location.href.substring(0, location.href.length - 4) + ((type == "qs") ? "destroy_question" : "destroy_choice"),
                data: {
                    data_id     :   $(p).data('id'),
                    _method     :   'DELETE',
                    _token      :   $('meta[name="csrf-token"]').attr('content')
                },
                success: function (text) {
                    // Remove <input> and <p>
                    $(div_row).prev().remove();
                    $(div_row).remove();
                    
                    // Reset the question number
                    var first = null, arrayLength = null;

                    if (type == "qs"){
                        var i = 0;

                        if ($("button.active").html() != "English")
                            i++;
                        first = $("div.card-body:eq(" + i + ") > p").first();
                        arrayLength = $("div.card-body:eq(" + i + ") > p").length;
                    }
                    else{
                        var i = 0;

                        if ($("button.active").html() != "English")
                            i++;
                        first = $("div.card-body:eq(" + (2 + i) + ") > p").first();
                        arrayLength = $("div.card-body:eq(" + (2 + i) + ") > p").length;
                    }

                    var current_p = first;

                    for (var i = 0; i < arrayLength; i++){
                        if (i != 0)
                            current_p = $(current_p).next().next();
                        var current_p_html = $(current_p).html();
                        $(current_p).html( (i + 1) + ". " + current_p_html.substr(current_p_html.indexOf(". ") + 2));
                    }
                    // End of Reset

                    if (arrayLength == 0)
                        appendJumbotron(type);

                    customAlert(text);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log("Opps: AJAX error");
                }
            });
        }

        function appendJumbotron(type){
            if (type == "qs"){
                if ($("button.active").html() == "English"){
                    $("div.card-body:eq(0)").append(`<div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                                                        <h3 class="text-center text-primary">
                                                            No Question
                                                        </h3>
                                                    </div>`);
                }
                else{
                    $("div.card-body:eq(1)").append(`<div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                                                        <h3 class="text-center text-primary">
                                                            Tiada Soalan
                                                        </h3>
                                                    </div>`);
                }
            }
            else{
                if ($("button.active").html() == "English"){
                    $("div.card-body:eq(2)").append(`<div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                                                        <h3 class="text-center text-info">
                                                            No Answer
                                                        </h3>
                                                    </div>`);
                }
                else{
                    $("div.card-body:eq(3)").append(`<div class="jumbotron mb-0" style="padding: 1.8rem 0;">
                                                        <h3 class="text-center text-info">
                                                            Tiada Jawapan
                                                        </h3>
                                                    </div>`);
                }
            }
        }

        function changeLanguage(ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            if ($(el).html() == "English"){
                $(el).next().removeClass("active");
                $(el).addClass("active");

                $("div.card:eq(1)").fadeOut(300, function(){
                    $("div.card:eq(0)").fadeIn("slow");
                });
                $("div.card:eq(3)").fadeOut(300, function(){
                    $("div.card:eq(2)").fadeIn("slow");
                });
            }
            else{
                $(el).prev().removeClass("active");
                $(el).addClass("active");

                $("div.card:eq(0)").fadeOut(300, function(){
                    $("div.card:eq(1)").fadeIn("slow");
                });
                $("div.card:eq(2)").fadeOut(300, function(){
                    $("div.card:eq(3)").fadeIn("slow");
                });
            }
        }
    </script>
@endsection