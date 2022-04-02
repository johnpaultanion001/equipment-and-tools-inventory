@extends('layouts.admin1')
@section('content')
    
<div class="card">
    
   <div class="col-xl-5 mx-auto">
        <div class="card-header p-2">
            <h4>
                EDIT ACCOUNT
            </h4>
           
        </div>
        <form method="post" id="myForm" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="control-label text-uppercase" >EMAIL<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{auth()->user()->email}}" readonly/>
                   
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        value="@if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){{auth()->user()->clinic->name}}@elseif(auth()->user()->roles()->pluck('id')->implode(', ') == 3){{auth()->user()->client->name}}@endif"
                        class="form-control" autofocus />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-name"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Contact Number<span class="text-danger">*</span></label>
                    <input type="number" name="contact_number" id="contact_number"
                        value="@if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){{auth()->user()->clinic->contact_number}}@elseif(auth()->user()->roles()->pluck('id')->implode(', ') == 3){{auth()->user()->client->contact_number}}@endif"
                        class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-contact_number"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label text-uppercase" >Address<span class="text-danger">*</span></label>
                    <input type="text" name="address" id="address"
                        value="@if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){{auth()->user()->clinic->address}}@elseif(auth()->user()->roles()->pluck('id')->implode(', ') == 3){{auth()->user()->client->address}}@endif"
                        class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-address"></strong>
                    </span>
                </div>
                @if(auth()->user()->roles()->pluck('id')->implode(', ') == 2)
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Location(LATITUDE)<span class="text-danger">*</span></label>
                        <input type="text" name="lat" id="lat"
                            value="{{auth()->user()->clinic->lat ?? ''}}"
                            class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-lat"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Location(LONGITUDE)<span class="text-danger">*</span></label>
                        <input type="text" name="lng" id="lng"
                            value="{{auth()->user()->clinic->lng ?? ''}}"
                            class="form-control" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-lng"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >UPLOAD( BUSINESS PERMIT )<span class="text-danger">*</span></label>
                        <input type="file" name="business_permit" id="business_permit" class="form-control" accept="image/*" />
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-business_permit"></strong>
                        </span>
                        <div class="current_img pt-4">
                            <div class="row">
                                <div class="col-6">
                                <br>
                                <br>
                                <br>
                                    <h6>Current Image:</h6>
                                </div>
                                <div class="col-6">
                                    <a target="_blank" href="/assets/images/business_permit/{{auth()->user()->clinic->business_permit ?? ''}}">
                                        <img style="vertical-align: bottom;" id="current_image"  height="100" width="100" src="/assets/images/business_permit/{{auth()->user()->clinic->business_permit ?? ''}}" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-uppercase" >Appointment ( Warning Text)</label>
                        <textarea name="warning_text" id="warning_text" class="form-control">{{auth()->user()->clinic->warning_text ?? ''}}</textarea>
                        <span class="invalid-feedback" role="alert">
                            <strong id="error-warning_text"></strong>
                        </span>
                    </div>
                @endif
              
                <div class="card-footer text-right">
                    <input type="hidden" name="hidden_id" id="hidden_id" value="@if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){{auth()->user()->clinic->id}}@elseif(auth()->user()->roles()->pluck('id')->implode(', ') == 3){{auth()->user()->client->id}}@endif" />
                    <input type="button" class="btn btn-danger" id="cancel_button" value="CANCEL">
                    <input type="submit" class="btn btn-primary" id="action_button" value="SUBMIT">
                </div>
            </div>
        </form>
   </div>
       
   
</div>

@endsection
@section('scripts')
<script>
$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#hidden_id').val();
    var action_url = "/admin/edit_account/"+id;
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
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


$(document).on('click', '#cancel_button', function(){
    window.location.href = '/admin/announcements';
});

</script>
@endsection