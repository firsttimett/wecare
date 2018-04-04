@extends('layouts.app')

@section('content')

<div class="container row">
    <p style="font-size: 2em;">Manage Psychologists</p>
    <div style="margin: auto -30px auto auto;">
        <a href="/users/create" class="btn btn-primary" style="margin-left: auto;">Add Psychologist</a>
    </div>
</div>

@if (count($psychologists) > 0)
    <table class="table table-striped mt-3">
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach ($psychologists as $count => $psychologist)
            <tr>
                <td>{{ $count + 1 }}</td>
                <td>{{ $psychologist->email }}</td>
                <td>
                    <a href="/users/{{ $psychologist->id }}/edit">
                        <i class="fa fa-lg fa-pencil text-primary" aria-hidden="true" title="Edit"></i>
                    </a>
                    <a href="javascript:;" data-url="{{ action('UserController@toggle', $psychologist->id) }}" data-token="{{ csrf_token() }}"
                        class="toggleUser">
                        @if ( $psychologist->active == 1 )
                            <i class="fa fa-lg ml-3 text-success fa-toggle-on" aria-hidden="true" title="Deactivate"></i>
                        @else
                            <i class="fa fa-lg ml-3 text-success fa-toggle-off" aria-hidden="true" title="Activate"></i>
                        @endif
                    </a>
                    <span class="fa fa-lg fa-trash ml-3 text-danger delete cursor" title="Delete" data-toggle="modal" data-target="#deleteModal" aria-hidden="true"
                            data-url="{{ action('UserController@destroy', $psychologist->id) }}" data-token="{{ csrf_token() }}"
                            data-text="Are you sure you want to delete the user?">
                    </span>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <div class="jumbotron mt-3">
        <h3 class="text-center text-muted">
            No psychologist
        </h3>
    </div>
@endif

@include('inc.delete')

@endsection

@section('javascript')
    <script>
        $(".toggleUser").on("click", function(ev){
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