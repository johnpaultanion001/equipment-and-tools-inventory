@extends('layouts.admin')
@section('sub-title','Event')
@section('styles')
<style>
   
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg- mx-auto mt-3">
            <div class="row">
                <div class="col-12">
                    <h5 class="title text-center text-sm-left">Event Details</h5>
                </div>
            </div>
            <div class="row card-row shadow">
                <div class="col-12 col-sm-4 my-2">
                    <div><p class="label">Event ID</p>{{$event->event_id ?? ''}}</div>
                </div>
                <div class="col-12 col-sm-4 my-2">
                    <div><p class="label">Title</p>{{$event->title ?? ''}}</div>
                </div>
                <div class="col-12 col-sm-4 my-2">
                    <div><p class="label">Category</p>{{$event->category ?? ''}}</div>
                </div>
            </div>
            <div class="row card-row shadow">
               
                <div class="col-12 col-sm-4 my-2 mb-3">
                    <div><p class="label">Location</p>{{$event->location ?? ''}}</div>
                </div>
                <div class="col-12 col-sm-4 my-2 mb-3">
                    <div><p class="label">Date & Time</p>{{$event->date->format('M j , Y') }} At {{$event->time->format('h:i A') }}</div>
                </div>
                <div class="col-12 col-sm-4 my-2 mb-3">
                    <div><p class="label">Is Open?</p><span event_id="{{$event->event_id ?? ''}}" class="btn action_is_open btn-sm mt-2 {{$event->isOpen == 'NO' ? 'btn-danger' : 'btn-primary'}}">{{$event->isOpen ?? ''}}</span></div>
                </div>
                <div class="col-12 col-sm-4 my-2 mb-3">
                    <div><p class="label">Description</p>{{$event->description ?? ''}}</div>
                </div>
                <div class="col-12 col-sm-4 my-2 mb-3 mx-auto">
                    <div>
                        <button class="btn btn-success edit" edit="{{$event->id}}">EDIT DETAIL</button>
                    </div>
                </div>
            </div>
            <div class="row card-row shadow">
                <div class="col-12 col-sm-4 my-2 mb-3">
                    <div><p class="label">Budgets</p>
                        @foreach($event->budgets()->get() as $budget)
                            {{$budget->title ?? ''}} <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Members already Attended</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Member Id</th>
                            <th>Name</th>
                            <th>Attended At</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($event->attended()->get() as $evt)
                       <tr>
                            <td>{{$evt->user->id ?? ''}}</td>
                            <td>{{$evt->user->name ?? ''}}</td>
                            <td>{{$evt->created_at ?? ''}}</td>
                       </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg  modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">Edit Event</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Title: <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-title"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Category: <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-control select2" style="width: 100%;">
                                    <option value="Event">Event</option>
                                    <option value="Activity">Activity</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-category"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Location: <span class="text-danger">*</span></label>
                                <input type="text" name="location" id="location" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-location"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Date: <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="date" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-date"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Time: <span class="text-danger">*</span></label>
                                <input type="time" name="time" id="time" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-time"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Budget: <span class="text-danger">*</span></label>
                                <input type="number" name="budget" id="budget" class="form-control">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-budget"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Description:</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-description"></strong>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <input type="hidden" readonly name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="SUBMIT" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $(document).on('click', '.action_is_open', function(){
        var event_id = $(this).attr('event_id')
        var action_url = '{{ route("admin.events.isopen", ":event") }}';
            action_url = action_url.replace(':event', event_id);

        $.ajax({
            url: action_url,
            method:'GET',
            dataType:"json",

            beforeSend:function(){
                $(".action_is_open").attr("disabled", true);
            },
            success:function(data){
                $(".action_is_open").attr("disabled", false);
                if(data.success){
                    $.confirm({
                        title: data.success,
                        content: "",
                        type: 'green',
                        buttons: {
                            confirm: {
                                text: '',
                                btnClass: 'btn-green',
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

    $(document).on('click', '.edit', function(){
        $('#myModal').modal('show');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
        var id = $(this).attr('edit');

        $.ajax({
            url :"/admin/events/"+id+"/edit",
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

    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var id = $('#hidden_id').val();
        var action_url = "/admin/events/" + id;
        var type = "PUT";

        $.ajax({
            url: action_url,
            method:type,
            data: $(this).serialize(),
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
                    $.confirm({
                        title: data.success,
                        content: "",
                        type: 'green',
                        buttons: {
                            confirm: {
                                text: '',
                                btnClass: 'btn-green',
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
  
});
</script>
@endsection