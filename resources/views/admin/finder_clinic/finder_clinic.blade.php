@extends('layouts.admin1')
@section('content')
<div class="row m-1">
    <div class="col-sm-6">
        <div style="height: 850px;" id="map"></div>
    </div>
    <div class="col-sm-6">
        <div class="card d-block mx-auto px-5" style="background: transparent; box-shadow: 0 0 0;">
                    <div class="card-header">
                      
                        <h3 class="card-title color-red title-big mt-4 mb-0">FINDER CLINIC</h3>
                      

                    </div>
                    <div class="card-body">
                    <!-- Tab panes -->
                        <form method="post" id="clinics_search" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                   <input type="text" name="search" id="search"  class="form-control font-weight-bold" placeholder="SEARCH CLINIC OR ADDRESS HERE">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-search"></strong>
                                    </span>
                                </div>
                                
                            </div>
                        </form>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="scrollable">
                                <h6 class="color-red">LIST OF AVAILABLE CLINICS</h6>
                                    <div id="clinics_list">
                                        @foreach ($clinics as $clinic)
                                        <div class="col-sm-11 btn btn-outline-primary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-dark font-weight-bold">{{$clinic->name}}</h5>
                                                    <h5 class="text-dark">{{$clinic->description}}</h5>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-left">
                                                    <h5 class="text-dark font-weight-bold">Available Services:</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        @foreach($clinic->services()->get() as $service)
                                                            <div class="col-md-4">
                                                                <button service="{{$service->id}}" class="service btn btn-sm  btn-success text-white">{{$service->name}}</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <hr class="my-2 bg-primary">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-sm btn-primary" id="view_clinics" address="{{$clinic->name}}" lat="{{$clinic->lat}}" lng="{{$clinic->lng}}" dplay="{{$clinic->address}}">
                                                    <i class="now-ui-icons location_pin" style="font-size: 25px"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="Sumbit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

@endsection
@section('scripts')

<script>
$('#clinics_search').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('finder_clinic.search') }}";
    var type = "GET";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#search').addClass('is-invalid');
            $('#error-search').text('LOADING...');
        },
        success:function(data){
            $('#search').removeClass('is-invalid');
            
            if(data.errors){
                $.each(data.errors, function(key,value){
                   if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
          
            var clinics = '';
            $.each(data.clinics, function(key,value){
                clinics += ' <div class="col-sm-11 btn btn-outline-primary">';
                    clinics += '<div class="row">'
                        clinics += '<div class="col-12">'
                            clinics += '<h5 class="text-dark font-weight-bold">'+value.name+'</h5>'
                        clinics += '</div>'
                        clinics += '<div class="col-12 text-left">'
                            clinics += '<h5 class="text-dark font-weight-bold">Available Services:</h5>'
                        clinics += '</div>'
                        clinics += '<div class="col-12">'
                            clinics += '<div class="row">'
                                $.each(value.services, function(key,value){
                                    clinics += '<div class="col-4">'
                                        clinics += '<button service="'+value.id+'" class="service btn btn-sm  btn-success text-white">'+value.name+'</button>'
                                    clinics += '</div>'
                                });
                            clinics += '</div>'
                        clinics += '</div>'

                        clinics += '<hr class="my-2 bg-primary">'
                        clinics += '<div class="col-12 text-right">'
                            clinics += '<button class="btn btn-sm btn-primary" id="view_clinics" address="'+value.name+'" lat="'+value.lat+'" lng="'+value.lng+'" dplay="'+value.address+'">'
                                clinics += '<i class="now-ui-icons location_pin" style="font-size: 25px"></i>'
                            clinics += '</button>'

                        clinics += '</div>'
                    clinics += '</div>'
                clinics += '</div>';
            });
            $('#clinics_list').empty().append(clinics);

        },
        error:function(){
            $('#search').addClass('is-invalid');
            $('#error-search').text('NO DATA RESULT');
        } 
    });
});

$(document).on('click', '#view_clinics', function(){
    var address = $(this).attr('address');
    var lat = parseFloat($(this).attr('lat'));
    var lng = parseFloat($(this).attr('lng'));
    var dplay = $(this).attr('dplay');
    $('#address').val(address);
    $('#address').focus();

    var options = {
        zoom: 15,
        center: {lat:lat, lng:lng}
    }

    var map = new google.maps.Map(document.getElementById('map'), options);
    addMarker({
            coords:{lat:lat, lng:lng},
            content: dplay,
    });

    function addMarker(props){
    var marker = new google.maps.Marker({
        position:props.coords,
        map:map
    });

    //check content
    if(props.content){
        var infoWindow = new google.maps.InfoWindow({
            content: props.content
        })

        marker.addListener('click', function(){
            infoWindow.open(map, marker);
        });
    }
    }

})

function initMap(){
    var clinics = <?php print_r(json_encode($clinics)) ?>;

    var options = {
        zoom: 8,
        center: {lat:14.6255, lng:121.1245}
    }

    var map = new google.maps.Map(document.getElementById('map'), options);
    $.each( clinics, function( index, value ){
        addMarker({
            coords:{lat:parseFloat(value.lat), lng:parseFloat(value.lng)},
            content: value.address,
        });
        
    });

    function addMarker(props){
        var marker = new google.maps.Marker({
            position:props.coords,
            map:map
        });

        //check content
        if(props.content){
            var infoWindow = new google.maps.InfoWindow({
                content: props.content
            })

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
            });
        }
    }
}


$(document).on('click', '.service', function(){
    var form_type   = 'ADD';
    var service = $(this).attr('service');

    $.ajax({
        url: "/admin/appointment/form", 
        type: "get",
        dataType:"json",
        data: {
            service:service,form_type:form_type,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
                $('.service').attr('disabled', true);
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

            $('.service').attr('disabled', false);
            $('#appointmentModal').modal('show');
        },	
        error:function(){
            window.location.href = "/admin/appointment";
        } 
    });
  
    
})

$('#appointmentForm').on('submit', function(event){
    event.preventDefault();
    var action_url =  "{{ route('admin.appointment.store') }}";
    var type       =  "POST";

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
                                window.location.href = "/admin/appointment";
                            }
                        },
                    }
                });
            }
        }
    });
});


</script>
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRuaXzf2jNaX7t6im3kt7vR9aKksgkhmg&libraries=places&callback=initMap&language=en&region=GB" async defer></script>
@endsection