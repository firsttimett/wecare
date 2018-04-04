@extends('layouts.app')

@section('content')

<div class="container row">
    <p style="font-size: 2em;">Manage Screening Tests</p>
    <div style="margin: auto -30px auto auto;">
        <a href="javascript:;" onclick="addScreeningTest()" class="btn btn-primary" style="margin-left: auto;">Add Screening Test</a>
    </div>
</div>

@if (count($tests) > 0)
    <table class="table table-striped mt-3">
        <tr>
            <th>#</th>
            <th>Screening Test</th>
            <th>Action</th>
        </tr>
        @foreach ($tests as $count => $test)
            <tr>
                <td>{{ $count + 1 }}</td>
                <td>{{ $test->name }}</td>
                <td>
                    <a href="/tests/{{ $test->id }}/edit">
                        <i class="fa fa-lg fa-pencil text-primary" aria-hidden="true" title="Edit"></i>
                    </a>
                    @if (!($loop->last && $count == 0))
                        <a href="javascript:;" data-url="{{ action('ScreeningTestController@toggle', $test->id) }}" data-token="{{ csrf_token() }}"
                            class="toggleTest">
                            @if ( $test->active == 1 )
                                <i class="fa fa-lg ml-3 text-success fa-toggle-on" aria-hidden="true" title="Deactivate"></i>
                            @else
                                <i class="fa fa-lg ml-3 text-success fa-toggle-off" aria-hidden="true" title="Activate"></i>
                            @endif
                        </a>
                        <span class="fa fa-lg fa-trash ml-3 text-danger delete cursor" title="Delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true"
                                data-url="{{ action('ScreeningTestController@destroy', $test->id) }}" data-token="{{ csrf_token() }}" 
                                data-text="Are you sure you want to delete the screening test?">
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@else
    <div class="jumbotron mt-3">
        <h3 class="text-center text-muted">
            No Screening Test
        </h3>
    </div>
@endif

@include('inc.delete')

@endsection

@section('javascript')
    <script>
        function addScreeningTest(){
            if ($("table.table").length == 0){
                $("div.jumbotron").remove();

                $(`<table class="table table-striped mt-3">
                        <tr>
                            <th>No</th>
                            <th>Screening Test</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><input class="form-control" autofocus></td>
                            <td>
                                <i class="fa fa-check fa-lg text-primary cursor mr-2" onclick="saveAddScreeningTest()" 
                                    title="Save" aria-hidden="true"></i>
                                <i class="fa fa-close fa-lg text-muted cursor" onclick="cancelAddScreeningTest()"
                                    title="Cancel" aria-hidden="true"></i>
                            </td>
                        </tr>
                    </table>`).insertAfter($("div.container.row"));
            }
            else
            {
                $("table.table").append(`<tr>
                                            <td>` + ($("table").children().length + 1) + `</td>
                                            <td><input class="form-control" autofocus></td>
                                            <td>
                                                <i class="fa fa-check fa-lg text-primary cursor mr-2" onclick="saveAddScreeningTest()" 
                                                    title="Save" aria-hidden="true"></i>
                                                <i class="fa fa-close fa-lg text-muted cursor" onclick="cancelAddScreeningTest()"
                                                    title="Cancel" aria-hidden="true"></i>
                                            </td>
                                        </tr>`);
            }
        }

        function saveAddScreeningTest(ev){
            if (!ev) {   ev = window.event;   };
            var el = (ev.target || ev.srcElement);

            var parentTD = $(el).parent();
            var previousTD = $(parentTD).prev();
            var previousTD_value = $(previousTD).children("input").val();

            $.ajax({
                type: "POST",
                url: location.href + "/" + previousTD_value,
                dataType: 'json',
                success: function (data) {
                    previousTD.html(previousTD_value);
                    var tableRows = $("tr").length;

                    var HTML = `<a href="/tests/` + data.last_insert_id + `/edit">
                                    <i class="fa fa-lg fa-pencil text-primary" aria-hidden="true" title="Edit"></i>
                                </a>` + ((tableRows == 2) ? "" : getToggleDeleteHTML(location.href, data.last_insert_id));

                    if (tableRows > 2) {
                        var firstRowActionTD = $(el).closest("tr").prev().find("td:eq(2)");
                        var href = $(firstRowActionTD).children("a").attr("href");
                        
                        $(firstRowActionTD).append(getToggleDeleteHTML(location.href, href.substr(7, href.lastIndexOf("/")-7)));
                    }

                    $(parentTD).html(HTML);

                    customAlert(data.message);
                }
            });
        }

        function getToggleDeleteHTML(url, id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            return `<a href="javascript:;" data-url="` + (url + `/` + id) + `/toggle` + `" 
                        data-token="` + csrf_token + `" class="toggleTest">
                        <i class="fa fa-lg ml-3 text-success fa-toggle-off" aria-hidden="true" title="Activate"></i>
                    </a>
                    <span class="fa fa-lg fa-trash ml-3 text-danger delete cursor" title="Delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true"
                        data-url="` + (url + `/` + id) + `" data-token="` + csrf_token + `"
                        data-text="Are you sure you want to delete the screening test?">
                    </span>`;
        }

        function cancelAddScreeningTest(ev){
            if ($("tr").length == 2){
                var table = $("table");

                table.parent().append(`<div class="jumbotron mt-3">
                                        <h3 class="text-center text-muted">
                                            No Screening Test
                                        </h3>
                                    </div>`);
                $("table").remove();
            }
            else
            {
                if (!ev) {   ev = window.event;   };
                var el = (ev.target || ev.srcElement);

                $(el).parent().parent().remove();
            }
        }

        $(".toggleTest").on("click", function(ev){
            var button = $(this);

            $.ajax({
                type: "POST",
                url: button.data('url'),
                data: { _method: 'PUT', _token: button.data("token") },
                dataType: 'text',
                success: function (text) {
                    if (button.children().attr("class") == "fa fa-lg ml-3 text-success fa-toggle-on")
                        button.children().removeClass("fa-toggle-on").addClass("fa-toggle-off");
                    else
                        button.children().removeClass("fa-toggle-off").addClass("fa-toggle-on");

                    customAlert(text);
                }
            });
            ev.preventDefault();
        });
    </script>
@endsection