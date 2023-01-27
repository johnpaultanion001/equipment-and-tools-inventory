@extends('layouts.admin')
@section('sub-title','Events')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Events</h1>
        <button class="btn btn-primary" id="create_button">Create Event</button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Budget Of Event</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Is Open?</th>
                            <th>Created At</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr class='clickable-row' data-href="{{ route('admin.events.show', ['event' => $event->event_id ]) }}">
                            <td>{{$event->event_id ?? ''}}</td>
                            <td>{{$event->category ?? ''}}</td>
                            <td>{{$event->title ?? ''}}</td>
                            <td>{{$event->location ?? ''}}</td>
                            <td>{{ number_format($event->budget ?? '' , 0, '.', ',') }}</td>
                            <td>{{$event->date->format('M j , Y') }}</td>
                            <td>{{$event->time->format('h:i A') }}</td>
                            <td><span class="badge {{$event->isOpen == 'NO' ? 'badge-danger' : 'badge-primary'}}">{{$event->isOpen ?? ''}}</span></td>
                            <td>{{$event->created_at->format('M j , Y h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="card shadow mb-4" >
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Event Budget Report</h6>
                
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartEvent"></canvas>
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
                    <p class="modal-title  text-uppercase font-weight-bold">Create Event</p>
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
    var data_event = JSON.parse(`<?php echo $data_results_events; ?>`);
    var chart_event = $("#myAreaChartEvent");

    var data_event = {
            labels: data_event.label,
            datasets: [
            {
                label: "Score:",
                data: data_event.data,

                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                
            }
            ]
    };

    var options = {
        maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
            },
    };

    var chart_events = new Chart(chart_event, {
        type: "line",
        data: data_event,
        options: options
    });

    $(document).on('click', '#create_button', function(){
        $('#myModal').modal('show');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
    });
    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        
        var action_url = '{{ route("admin.events.store") }}';
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
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
@endsection
