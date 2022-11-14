@extends('layouts.admin')
@section('sub-title','Dashboard')
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
                    <h4 class="title text-center text-sm-left">Dashboard</h4>
                </div>
            </div>
            <div class="row card-row shadow">
                <div class="col-12 col-sm-4 my-2">
                    <div class="text-center"><h6 class="text-primary">{{$members ?? ''}}</h6> <p class="label">Total Members</p></div>
                </div>
                <div class="col-12 col-sm-4 my-2">
                    <div class="text-center"><h6 class="text-primary">{{$events->count() ?? ''}}</h6> <p class="label">Total Events</p></div>
                </div>
                <div class="col-12 col-sm-4 my-2">
                    <div class="text-center"><h6 class="text-primary">{{$events_attend ?? ''}}</h6> <p class="label">Total Attended</p></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h6 class="title text-center text-sm-left">Filter by event</h6>
                    <select id="filter_event" class="form-control">
                        @foreach($events as $event1)
                            <option value="{{$event1->event_id}}" {{$event1->event_id == $event->event_id ? 'selected' : '' }}>{{$event1->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-12 col-lg- mx-auto mt-3">
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
            </div>
        </div>
    </div>
   
</div>

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

    $('#filter_event').on('change', function() {
        location.href = '/admin/dashboard/'+this.value;
    });
  
});
</script>
@endsection