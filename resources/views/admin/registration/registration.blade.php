@extends('layouts.admin1')
@section('content')
<div class="col-xl-12">
    <div class="row">
        <div class="col-xl-10 mx-auto mt-5">
        
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                    <table class="table" width="100%" >
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Actions</th>
                                <th>Intern ID</th>
                                <th>Name</th>
                                <th>School</th>
                                <th>Email</th>
                                <th>Google drive link</th>
                                <th>Proof of attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $register)
                                <tr>
                                    <td>
                                        <button class="btn {{$register->status == 'PENDING' ? 'btn-warning status':'btn-danger'}}  btn-wd btn-sm " status="{{$register->id ?? ''}}">
                                            {{$register->status ?? ''}}
                                        </button>
                                    </td>
                                    <td>
                                        {{$register->intern_id ?? ''}}
                                    </td>
                                    <td>
                                        {{$register->name ?? ''}}
                                    </td>
                                    <td>
                                        {{$register->school ?? ''}}
                                    </td>
                                    <td>
                                        {{$register->email ?? ''}}
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{$register->google_drive ?? ''}}">{{$register->google_drive ?? ''}}</a>
                                        
                                    </td>
                                    <td>
                                        
                                        <a target="_blank" href="/assets/attach_attendance/{{$register->attach_attendance ?? ''}}">{{$register->attach_attendance ?? ''}}</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    </div>
                    
                </div>
                
            </div>
          
        </div>
    </div>
</div>
<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-xl  modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">REGISTRATION</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >INTERN ID:</label>
                                <input type="text" name="intern_id" id="intern_id" class="form-control font-weight-bold" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Name:</label>
                                <input type="text" name="name" id="name" class="form-control font-weight-bold" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >School:</label>
                                <input type="text" name="school" id="school" class="form-control font-weight-bold" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Email:</label>
                                <input type="text" name="email_address" id="email_address" class="form-control font-weight-bold" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Google drive link:</label>
                                <a id="google_drive" target="_blank" href=""></a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Proof of attendance:</label>
                                <a id="attach_attendance" target="_blank" href=""></a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                            <b>LOGIN CREDENTIALS</b>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Email: <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control font-weight-bold"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-email"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Password: <span class="text-danger">*</span></label>
                                <input type="text" name="password" id="password" value="password!123" class="form-control font-weight-bold"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-password"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                    <input type="hidden" name="action" id="action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                <input type="button" name="decline_button" id="decline_button" class="text-uppercase btn btn-danger btn-wd" value="DECLINE" />
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-success btn-wd" value="APPROVE" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<form method="post" id="declinedForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="declinedModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-lg  modal-dialog-centered ">
            <div class="modal-content">
               
                <div class="modal-body">
                    <div class="row">
                      
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >Reason:</label>
                                <textarea name="reason" id="reason" class="form-control font-weight-bold"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-reason"></strong>
                                </span>
                            </div>
                        </div>
                    
                      
                     
                       
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="button" id="decline_close" class="text-uppercase btn btn-default btn-wd" value="CLOSE" />
                    <input type="submit" name="decline_action_button" id="decline_action_button" class="text-uppercase btn btn-danger btn-wd" value="DECLINE" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>

$(document).ready(function () {
    $('.table').DataTable({
        bDestroy: true,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],

        buttons: [
            { 
                extend: 'print',
                className: 'd-none',
            }
        ],
    });

});

var id = null;

$(document).on('click', '.status', function(){
    $('#myModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    id = $(this).attr('status');

    $.ajax({
        url :"/admin/registration/"+id,
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
                if(key == 'google_drive'){
                    $('#google_drive').attr('href', value)
                    $('#google_drive').text(value)
                }
                if(key == 'attach_attendance'){
                    $('#attach_attendance').attr('href', '/assets/attach_attendance/'+value)
                    $('#attach_attendance').text(value)
                }
                if(key == 'email'){
                    $('#email_address').val(value);
                }
            })
        }
    })
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "/admin/registration/"+id;
    var type = "post";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").val("LOADING..");
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            $("#action_button").val("APPROVE");

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
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


$(document).on('click', '#decline_button', function(){
    $('#declinedModal').modal('show');
    $('#declinedForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
});

$(document).on('click', '#decline_close', function(){
    $('#declinedModal').modal('hide');
    $('#reason').focus();
});

$('#declinedForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "/admin/registration/"+id+"/declined";
    var type = "post";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#decline_action_button").attr("disabled", true);
            $("#decline_action_button").val("LOADING..");
        },
        success:function(data){
            $("#decline_action_button").attr("disabled", false);
            $("#decline_action_button").val("DECLINE");

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
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
                $('#declinedModal').modal('hide');
                $('#myModal').modal('hide');
            }
            
        }
    });
});



</script>
@endsection