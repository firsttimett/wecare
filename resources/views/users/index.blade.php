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
            <th>No</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    @foreach ($psychologists as $count => $psychologist)
        <tr>
            <td>{{ $count + 1 }}</td>
            <td>{{ $psychologist->email }}</td>
            <td>
                <i class="far fa-trash-alt"></i>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <div class="jumbotron mt-3">
        <h3 class="text-center text-muted">
            No psychologists
        </h3>
    </div>
@endif
@endsection