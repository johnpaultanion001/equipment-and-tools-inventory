@extends('layouts.admin')
@section('sub-title','Account')
@section('styles')
<style>
   
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg- mx-auto mt-3">
          
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row card-row shadow">
                        <div class="col-12">
                            <div>
                                <h5 class="title text-center text-sm-left mb-4">Update Information</h5>
                                <form method="post" id="updateForm" >
                                    @csrf
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p class="label">Name <span class="text-danger">*</span></p>
                                                    <input type="text" name="name" id="name" class="form-control" value="{{$user->name ?? ''}}">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-name"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p class="label">Email <span class="text-danger">*</span></p>
                                                    <input type="email" name="email" id="email" class="form-control" value="{{$user->email ?? ''}}">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-email"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p class="label">Contact Number <span class="text-danger">*</span></p>
                                                    <input type="number" name="contact_number" id="contact_number" class="form-control" value="{{$user->contact_number ?? ''}}">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-contact_number"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p class="label">Address <span class="text-danger">*</span></p>
                                                    <input type="text" name="address" id="address" class="form-control" value="{{$user->address ?? ''}}">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong id="error-address"></strong>
                                                    </span>
                                                    <input type="hidden" id="user_id" value="{{$user->id ?? ''}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <button type="button" class="btn-warning btn" id="changepassword">Change Password</button>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <button type="submit" class="btn-primary btn" id="action_button">Update</button>
                                            </div>
                                        
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>


<form method="post" id="cpForm" class="contact-form">
    @csrf
    <div class="modal fade" id="cpModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="cp-modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                X
            </button>
          </div>
          <div class="modal-body">
        
            <div class="col-sm-12">
                  <div class="form-group">
                      <label class="control-label text-uppercase" >Current Password: </label>
                      <input type="password" name="current_password" id="current_password" class="form-control" />
                      <span class="invalid-feedback" role="alert">
                          <strong id="error-current_password"></strong>
                      </span>
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="form-group">
                      <label class="control-label text-uppercase" >New Password: </label>
                      <input type="password" name="new_password" id="new_password" class="form-control" />
                      <span class="invalid-feedback" role="alert">
                          <strong id="error-new_password"></strong>
                      </span>
                  </div>
              </div>
              
              <div class="col-sm-12">
                  <div class="form-group">
                      <label class="control-label text-uppercase" >Confirm New Password: </label>
                      <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                       <span class="invalid-feedback" role="alert">
                          <strong id="error-confirm_password"></strong>
                      </span>
                  </div>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="cp_action_button" id="cp_action_button" class="btn btn-primary" value="Save" />
          </div>
        </div>
      </div>
    </div>
</form>


@endsection
@section('scripts')
<script>

$(document).on('click', '#changepassword', function(){
    $('#cpModal').modal('show');
    $('#cpForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.cp-modal-title').text('Change Password');
    $('#cp_button').val('Submit');
});

$('#cpForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#user_id').val();
    var action_url = "/admin/users/pass/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#cp_action_button").attr("disabled", true);
        },
        success:function(data){
          $("#cp_action_button").attr("disabled", false);

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
                                text: 'confirm',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            },
                            
                        }
                    });
            }
        
        }
    });
});

$('#updateForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#user_id').val();
    var action_url = "/admin/users/account/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
          $("#action_button").attr("disabled", false);
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
                                text: 'confirm',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function(){
                                    location.reload();
                                }
                            },
                            
                        }
                    });
            }
        
        }
    });
});
</script>
@endsection