@extends('layouts.admin1')
@section('content')
<div class="col-xl-12">
    <div class="row">
        @foreach($applications as $application)
            <div class="col-xs-12 col-sm-6 col-md-4 mt-5">
                <div class="card">
                    <div class="card-body text-center">
                        <p><img class="rounded-circle z-depth-2" width="90" height="80" src="/assets/applicant_picture/{{$application->image}}" alt="card image"></p>
                        <h4 class="card-title">{{$application->name}}</h4>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="card-text font-weight-bold">
                                        <i class="fa-solid fa-at" style="color: #63D7FF;"></i> 
                                        {{$application->user->email}}
                                    </p>
                                </div>
                                <div class="col-sm-12">
                                    <p class="card-text font-weight-bold">
                                        <i class="fa-solid fa-phone" style="color: #63D7FF;"></i>
                                        {{$application->contact_number}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="card-text font-weight-bold m-3 badge @if($application->status == 'PENDING') badge-warning @elseif($application->status == 'APPROVED') badge-success @elseif($application->status == 'COMPLETED') badge-info @endif mt-2">
                            {{$application->status}}
                        </p>
                        <br>
                        <button class="btn btn-primary btn-sm font-weight-bold detail btn-wd" detail="{{$application->id}}">FULL DETAILS</button>
                        <button class="btn btn-success btn-sm font-weight-bold status btn-wd"  status="{{$application->id}}">SET STATUS</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">SET STATUS</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >STATUS: <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select2" style="width: 100%;">
                                    <option value="PENDING">PENDING</option>
                                    <option value="APPROVED">APPROVED</option>
                                    <option value="COMPLETED">COMPLETED</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                                <div class="form-group text-uppercase h6">
                                <label>Attach File: </label>
                                <input type="file" class="form-control" name="attach_file" id="attach_file">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-attach_file"></strong>
                                </span>
                               
                                
                                <h6 class="mt-2">Current file: <a href="" target="_blank" id="attach_file_link"></a></h6>
                            </div> 
                        </div>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                    <input type="hidden" name="action" id="action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="SUBMIT" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
$(document).on('click', '.detail', function(){
    var id = $(this).attr('detail');
    window.location.href = '/admin/applications/'+id;
});

var application_id = null;

$(document).on('click', '.status', function(){
    $('#myModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    application_id = $(this).attr('status');

    $.ajax({
        url :"/admin/applications/"+application_id+"/status",
        dataType:"json",
        method:"GET",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);

            $.each(data.result, function(key,value){
                if(key == 'status'){
                    $("#status").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'admin_attach_file'){
                    $("#attach_file_link").prop("href", "/assets/attach_file/"+value)
                    $("#attach_file_link").text(value)
                }
            })
        }
    })
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "/admin/applications/"+application_id+"/status";
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
</script>
@endsection