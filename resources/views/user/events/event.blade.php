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
                    <div><p class="label">Is Open?</p><span class="badge {{$event->isOpen == 'NO' ? 'badge-danger' : 'badge-primary'}}">{{$event->isOpen ?? ''}}</span></div>
                </div>
                <div class="col-12 col-sm-8 my-2 mb-3">
                    <div><p class="label">Description</p>{{$event->description ?? ''}}</div>
                </div>
                <div class="col-12 col-sm-4 my-2 mb-3">
                    @php
                        $event_attend = App\Models\AttendEvent::where('user_id', auth()->user()->id)
                                                    ->where('event_id', $event->event_id)
                                                    ->first();
                    @endphp
                    @if($event_attend == null)
                        <button class="btn btn-primary btn-sm text-uppercase action_attend" event_id="{{$event->event_id ?? ''}}">Attend</button>
                    @else
                        <a href="/admin/user/{{$event->event_id}}" class="btn btn-secondary btn-sm text-uppercase">
                            Already Attended
                        </a>
                    @endif
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
            @if($event_attend !== null)
                <div class="row">
                    <div class="col-12">
                        <h5 class="title text-center text-sm-left">Attended Event Details</h5>
                    </div>
                </div>
                <div class="row card-row shadow">
                    <div class="col-12 col-sm-4 my-2">
                        <div><p class="label">Name</p>{{$event_attend->user->name ?? ''}}</div>
                    </div>
                    <div class="col-12 col-sm-4 my-2">
                        <div><p class="label">Date you attend</p>{{$event_attend->created_at->format('M j , Y h:i A') }}</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).on('click', '.action_attend', function(){
    var event_id = $(this).attr('event_id')
    var action_url = '{{ route("admin.user.store_event", ":event") }}';
        action_url = action_url.replace(':event', event_id);

    $.ajax({
        url: action_url,
        method:'GET',
        dataType:"json",

        beforeSend:function(){
            $(".action_attend").attr("disabled", true);
        },
        success:function(data){
            $(".action_attend").attr("disabled", false);
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