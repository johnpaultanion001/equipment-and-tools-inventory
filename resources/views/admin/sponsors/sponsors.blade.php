@extends('layouts.admin')
@section('sub-title','Dashboard')
@section('styles')
<style>
    .detail{
        cursor: pointer;
    }
   .detail:hover{
        border: solid 1px #4e73df;
   }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sponsors</h1>
        <button class="btn btn-primary" id="create_record">Create Sponsor</button>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg- mx-auto mt-3">
            <div class="row">
                @foreach($sponsors as $sponsor)
                <div class="card-row shadow ml-2 col-md-3 detail" detail="{{$sponsor->id}}">
                    <div class="my-1">
                        <div class="text-center">
                            <img src="{{ asset('/assets/img/sponsors/'.$sponsor->image) }}" width="120"  height="100" alt="{{$sponsor->image ?? ''}}"> 
                            <p class="label mt-2">{{$sponsor->title ?? ''}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            
            
           
        </div>
    </div>
</div>

<form method="post" id="myForm" class="contact-form">
    @csrf
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-uppercase">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="bmd-label-floating">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-title"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image" class="bmd-label-floating">Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control image" accept="image/*" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-image"></strong>
                            </span>
                            <div class="current_img pt-4">
                                <div class="row">
                                    <div class="col-6">
                                    <br>
                                    <br>
                                    <br>
                                        <small>Current Image:</small>
                                    </div>
                                    <div class="col-6">
                                        <img style="vertical-align: bottom;" id="current_image"  height="100" width="100" src="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
              
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-danger  text-uppercase remove">Remove</button>
            <input type="submit" name="action_button" id="action_button" class="btn btn-primary text-uppercase" value="Save" />
          </div>
        </div>
      </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var action_url = "{{ route('admin.sponsors.store') }}";
        var type = "POST";

        if($('#action').val() == 'Edit'){
            var id = $('#hidden_id').val();
            action_url = "sponsors/update/" + id;
            type = "POST";
        }

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
                $("#action_button").attr("value", "Loading..");
            },
            success:function(data){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Submit");
                }
                if(data.errors){
                    $.each(data.errors, function(key,value){
                        if(key == $('#'+key).attr('id')){
                            $('#'+key).addClass('is-invalid')
                            $('#error-'+key).text(value)
                        }
                        if(key == 'image'){
                            $('.image').addClass('is-invalid')
                            $('#error-image').text(value)
                        }
                    })
                }
                if(data.success){
                    $('.form-control').removeClass('is-invalid')
                    $('#myForm')[0].reset();
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
                    $('#formModal').modal('hide');
                }
                
            }
        });
    });

    $(document).on('click', '.remove', function(){
        var id = $('#hidden_id').val();
        $.confirm({
            title: 'Confirmation',
            content: 'You really want to remove this record?',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        return $.ajax({
                            url:"sponsors/"+id,
                            method:'DELETE',
                            data: {
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType:"json",
                            beforeSend:function(){
                            },
                            success:function(data){
                                if(data.success){
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
                        })
                    }
                },
                cancel:  {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],
                }
            }
        });

    });

    $(document).on('click', '#create_record', function(){
        $('#formModal').modal('show');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid')
        $('.modal-title').text('Add Sponsor');
        $('#action_button').val('Submit');
        $('#action').val('Add');
        $('.current_img').hide();
        $('.remove').hide();
    });

    $(document).on('click', '.detail', function(){
        $('#formModal').modal('show');
        $('.modal-title').text('Sponsor Detail');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.current_img').show();
        $('.remove').show();
        var id = $(this).attr('detail');

        $.ajax({
            url :"/admin/sponsors/"+id+"/edit",
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").attr("value", "Loading..");  
            },
            success:function(data){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Submit");
                }
                $.each(data.result, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).val(value)
                    }
                    if(key == 'image'){
                        $('#current_image').attr("src", '/assets/img/sponsors/'  + value);
                    }
                })
                $('#hidden_id').val(id);
                $('#action_button').val('Update');
                $('#action').val('Edit');
            }
        })
    });
});
</script>
@endsection