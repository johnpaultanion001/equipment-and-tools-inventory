@extends('layouts.admin1')
@section('content')
<div class="section py-2">
<h3 class="card-title color-red m-2 mb-0 text-uppercase">Manage Appointments</h3>

      <div class="container-fluid">
        <div class="row">
            @foreach($appoitments as $appointment)
            <div class="col-md-6 my-auto">
                <div class="card mx-auto" style="background: transparent; box-shadow: 0 0 0;">
                    <div class="card-grey py-4">
                        <div class="card-header text-center px-3 px-md-4 py-0">
                            <h3 class="card-title title-up color-black">{{$appointment->clinic->name}}</h3>
                            <hr>
                        </div>
                        <div class="card-body  px-4 px-md-8">
                            <div class="form-group pt-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Service: </label>
                                            <h6 class="card-title title-up color-black form-control" style="border: 1px green solid;">{{$appointment->service->name}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Doctor: </label>
                                            <h6 class="card-title title-up color-black form-control" style="border: 1px green solid;">{{$appointment->doctor->name}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Date: </label>
                                            <h6 class="card-title title-up color-black form-control" style="border: 1px green solid;">{{$appointment->date}}</h6>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Time: </label>
                                            <input type="time" value="{{$appointment->time}}" readonly class="card-title title-up color-black form-control" style="border: 1px green solid;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Note: </label>
                                            <h6 class="card-title title-up color-black form-control" style="border: 1px green solid;">{{$appointment->note}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-uppercase  h6" >Status: </label> <br>
                                                <span class="badge badge-lg
                                                                @if($appointment->status == 'PENDING')
                                                                    badge-warning
                                                                @elseif($appointment->status == 'APPROVED')
                                                                    badge-primary
                                                                @elseif($appointment->status == 'COMPLETED')
                                                                    badge-success
                                                                @elseif($appointment->status == 'CANCELED')
                                                                    badge-danger
                                                                @endif">
                                                                {{$appointment->status}}</span>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($appointment->status == "PENDING")
                                <div class="col-12 text-right">
                                    <button class="btn btn-sm btn-info edit" edit="{{$appointment->id}}">EDIT</button>
                                    <button class="btn btn-sm btn-danger cancel" cancel="{{$appointment->id}}">CANCEL</button>
                                </div>
                            @endif
                            
                            
                        </div>
                    </div>
                </div>
           </div>
            @endforeach
          

        </div>
      </div>
</div>


<form method="post" id="appointmentForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="appointmentModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">Appointment Form</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body">
                 <div id="modalbody" class="modalbody">
                        

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase h6" >Clinic</label>
                                    <input type="text" name="clinic" id="clinic" class="form-control font-weight-bold" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-clinic"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase  h6" >Services <span class="text-danger">*</span></label>
                                    <select name="service" id="service" class="form-control select2 font-weight-bold" style="width: 100%">
                                        <option value="" disabled selected>Please Select</option>
                                        
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-service"></strong>
                                    </span>
                                
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase  h6" >Doctors <span class="text-danger">*</span></label>
                                    <select name="doctor" id="doctor" class="form-control select2 font-weight-bold" style="width: 100%">
                                        <option value="" disabled selected>Please Select</option>
                                        
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-doctor"></strong>
                                    </span>
                                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase  h6" >Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date"  autocomplete="off">

                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-date"></strong>
                                    </span>
                                
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase  h6" >Time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="time" name="time"  autocomplete="off">
                                        
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-time"></strong>
                                    </span>
                                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                    <label class="control-label text-uppercase text-danger h6" id="warning_text"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label text-uppercase  h6" >Note</label>
                                    <textarea name="note" id="note" class="form-control font-weight-bold" ></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-note"></strong>
                                    </span>
                                
                                </div>
                            </div>
                           
                        </div>
                        
                       
                        
                        
                    </div>
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="action" id="action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="Update" />
                </div>
        
            </div>
        </div>
    </div>
</form>


@endsection
@section('scripts')
<script>
    var appointment = null;

$(document).on('click', '.edit', function(){
    var form_type   = 'EDIT';
    appointment = $(this).attr('edit');

    $.ajax({
        url: "/admin/appointment/form", 
        type: "get",
        dataType:"json",
        data: {
            appointment:appointment,form_type:form_type,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
                $('.edit').attr('disabled', true);
                $('.remove').attr('disabled', true);
        },
        success: function(data){
           
            var services = '';
            var doctors = '';

            $('#clinic').val(data.clinic);
            
            if(data.warning_text == null){
                $('#warning_text').html(null);
            }else{
                $('#warning_text').html('* ' + data.warning_text);
            }

            services += '<option value="" disabled selected>Please Select</option>';
            $.each(data.services, function(key,value){
                services += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            $('#service').empty().append(services);

            doctors += '<option value="" disabled selected>Please Select</option>';
            $.each(data.doctors, function(key,value){
                doctors += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            $('#doctor').empty().append(doctors);

            $("#service").select2("trigger", "select", {
                data: { id: data.service_id }
            });
            $("#doctor").select2("trigger", "select", {
                data: { id: data.doctor_id }
            });
            $('#date').val(data.date);
            $('#time').val(data.time);
            $('#note').val(data.note);

            $('.edit').attr('disabled', false);
            $('.remove').attr('disabled', false);

            $('#appointmentModal').modal('show');
        }	
    });
})

$(document).on('click', '.cancel', function(){
  var id = $(this).attr('cancel');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to cancel this appointment?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/appointment/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                            $(".cancel").attr("disabled", true);
                      },
                      success:function(data){
                          if(data.success){
                            $.confirm({
                                title: data.success,
                                content: "",
                                type: 'green',
                                buttons: {
                                    confirm: {
                                        text: 'APPOINTMENT',
                                        btnClass: 'btn-green',
                                        keys: ['enter', 'shift'],
                                        action: function(){
                                            location.reload();
                                        }
                                    },
                                }
                            });

                            $(".cancel").attr("disabled", false);
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

$('#appointmentForm').on('submit', function(event){
    event.preventDefault();
    var action_url = "/admin/appointment/"+appointment;
    var type       =  "GET";

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
            $('.form-control').removeClass('is-invalid');

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                            $('#'+key).addClass('is-invalid');
                            $('#error-'+key).html(value);
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
                            text: 'APPOINTMENT',
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