@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                    Personal Information
                    <button id="dashboard_btnEdit" class="btn btn-outline-info py-0" style="float: right;">
                        <i class="fa fa-edit fa-lg" aria-hidden="true"></i>Edit
                    </button>
                </div>

                <div class="card-body">
                    <form id="dashboard_form" method="POST" action="{{ action('UserController@dashboard_update', $user->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" 
                                        value="{{ empty(old('name')) ? $user->name : old('name') }}" required autofocus disabled>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ empty(old('email')) ? $user->email : old('email') }}" required disabled>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="checkbox_cp" class="col-md-4 col-form-label text-md-right">Change password</label>
                            <div class="col-md-6 col-form-label">
                                <input id="checkbox_cp" name="changePassword" type="checkbox" disabled>
                            </div>
                        </div>

                        <div class="form-group row pwd-edit display-none">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control pwd-edit{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                        name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row pwd-edit display-none">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control pwd-edit{{ $errors->has('new-password') ? ' is-invalid' : '' }}" 
                                        name="new-password">

                                @if ($errors->has('new-password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row pwd-edit display-none">
                            <label for="new-password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="new-password_confirmation" type="password" class="form-control pwd-edit" name="new-password_confirmation">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="btn-group-edit display-none">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        Save
                                    </button>
                                    <a id="dashboard_btnCancel" href="javascript:;" class="btn btn-outline-secondary">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                        &nbsp;&nbsp;Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        var defaultName = null, defaultEmail = null, defaultPwd = null;
        $("#dashboard_form").submit(function(ev){
            if ($("#checkbox_cp").is(":checked")){
                if ($("input#password").val().length < 6){
                    $("input#password").addClass("is-invalid");
                    if ($("input#password").parent().find(".invalid-feedback").length == 0){
                        $("input#password").parent().append(`<span class='invalid-feedback'>
                                                                <strong>The password must be at least 6 characters.</strong>
                                                            </span>`);
                    }
                    ev.preventDefault();
                }
                else{
                    $("input#password").removeClass("is-invalid");
                    $("input#password").parent().find(".invalid-feedback").remove();
                }

                if ($("input#new-password").val().length < 6){
                    $("input#new-password").addClass("is-invalid");
                    if ($("input#new-password").parent().find(".invalid-feedback").length == 0){
                        $("input#new-password").parent().append(`<span class='invalid-feedback'>
                                                                    <strong>The password must be at least 6 characters.</strong>
                                                                </span>`);
                    }
                    ev.preventDefault();
                }
                else{
                    $("input#new-password").removeClass("is-invalid");
                    $("input#new-password").parent().find(".invalid-feedback").remove();
                }

                if ($("input#new-password").val() != $("input#new-password_confirmation").val()){
                    $("input#new-password_confirmation").addClass("is-invalid");
                    if ($("input#new-password_confirmation").parent().find(".invalid-feedback").length == 0){
                        $("input#new-password_confirmation").parent().append(`<span class='invalid-feedback'>
                                                                                    <strong>The password confirmation does not match.</strong>
                                                                                </span>`);
                    }
                    ev.preventDefault();
                }
                else{
                    $("input#new-password_confirmation").removeClass("is-invalid");
                    $("input#new-password_confirmation").parent().find(".invalid-feedback").remove();
                }
            }
        });

        $("#dashboard_btnEdit").on("click", function(ev){
            $(this).addClass("display-none");

            $(".btn-group-edit").removeClass("display-none");

            $("input#name").removeAttr('disabled');
            $("input#email").removeAttr('disabled');
            $("input#checkbox_cp").removeAttr('disabled');

            defaultName = $("input#name").val();
            defaultEmail = $("input#email").val();

            ev.preventDefault();
        });

        $("#dashboard_btnCancel").on("click", function(ev){
            $("#dashboard_btnEdit").removeClass("display-none");

            $(".btn-group-edit").addClass("display-none");

            if ($("#checkbox_cp").is(":checked"))
                $("#checkbox_cp").trigger("click");

            $("input#name").prop('disabled', true);
            $("input#email").prop('disabled', true);
            $("input#checkbox_cp").prop('disabled', true);

            $("input#name").val(defaultName);
            $("input#email").val(defaultEmail);

            ev.preventDefault();
        });

        function resetPasswordInputs(){
            $("input#password").removeClass("is-invalid");
            $("input#password").siblings().remove();
            $("input#password").val("");

            $("input#new-password").removeClass("is-invalid");
            $("input#new-password").siblings().remove();
            $("input#new-password").val("");

            $("input#new-password_confirmation").removeClass("is-invalid");
            $("input#new-password_confirmation").siblings().remove();
            $("input#new-password_confirmation").val("");
        }

        $("#checkbox_cp").on("click", function(ev){
            if ($("#checkbox_cp").is(":checked")){
                $("div.pwd-edit").removeClass("display-none");
                $("input.pwd-edit").attr("required", "required");
            }
            else{
                $("div.pwd-edit").addClass("display-none");
                $("input.pwd-edit").removeAttr("required");
                resetPasswordInputs();
            }
        });

        $(document).ready(function(){
            if ($("input#email").siblings().length == 1)
                $("#dashboard_btnEdit").click();
            else if ($("input#password").siblings().length == 1){
                $("#dashboard_btnEdit").click();
                $("#checkbox_cp").click();
                $(".pwd-edit").find("strong").html("The password is incorrect.");
            }
        });
        // End For Dashboard
    </script>
@endsection