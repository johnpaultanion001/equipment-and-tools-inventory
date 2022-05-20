@extends('layouts.admin1')
@section('content')
    
<div class="container ">
    <div class="card mt-4">
    <div class="col-xl-5 mx-auto" >
            <div class="card-header p-2">
                <h4>
                    Change Password
                </h4>
            
            </div>
            <form method="post" id="cpForm" >
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Current Password<span class="text-danger">*</span></label>
                        <input type="password" name="current_password" id="current_password" class="form-control" autofocus />
                        <span toggle="#current_password-field" class="fa fa-fw fa-eye field_icon toggle-current_password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-current_password"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >New Password<span class="text-danger">*</span></label>
                        <input type="password" name="new_password" id="new_password" class="form-control" />
                        <span toggle="#new_password-field" class="fa fa-fw fa-eye field_icon toggle-new_password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                        
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-new_password"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                        <span toggle="#confirm_password-field" class="fa fa-fw fa-eye field_icon toggle-confirm_password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                        
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-confirm_password"></strong>
                        </span>
                    </div>
                    <div class="card-footer text-right">
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{Auth::user()->id}}" />
                        <input type="submit" class="btn btn-primary" id="action_button" value="SUBMIT">
                    </div>
                </div>
            </form>
    </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
$('#cpForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#hidden_id').val();
    var action_url = "/admin/change_password/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "LOADING..");
        },
        success:function(data){
          $("#action_button").attr("disabled", false);
          $("#action_button").attr("value", "SUBMIT");
            if(data.errors){
                $.each(data.errors, function(key,value){
                if(key == $('#'+key).attr('id')){
                      $('#'+key).addClass('is-invalid')
                      $('#error-'+key).text(value)
                  }
                })
            }
            if(data.success){
                $('.form-control').removeClass('is-invalid');
                $.confirm({
                    title: 'Confirmation',
                    content: data.success,
                    type: 'green',
                    buttons: {
                            confirm: {
                                text: 'STAY LOGGED IN',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            },
                            cancel:  {
                                text: 'LOGOUT',
                                btnClass: 'btn-red',
                                action: function(){
                                    document.getElementById('logoutform').submit();
                                }
                            }
                        }
                    });
            }
        
        }
    });
});
$("body").on('click', '.toggle-current_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#current_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-new_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#new_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-confirm_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#confirm_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});


</script>
@endsection