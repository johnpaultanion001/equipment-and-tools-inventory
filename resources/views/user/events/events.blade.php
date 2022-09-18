@extends('layouts.admin')
@section('sub-title','Events')
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
                    <h5 class="title text-center text-sm-left">Available Events</h5>
                </div>
            </div>
            <div class="row">
                
                    @foreach($events as $event)
                    <div class="col-md-6 mx-auto">
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
                            <div class="col-12 col-sm-5 my-2">
                                <div><p class="label">Description</p>{{$event->description ?? ''}}</div>
                            </div>
                            <div class="col-12 col-sm-3 my-2">
                                @php
                                    $event_attend = App\Models\AttendEvent::where('user_id', auth()->user()->id)
                                                        ->where('event_id', $event->event_id)
                                                        ->first();
                                @endphp
                                <div><p class="label">Status</p>
                                    <span class="text-uppercase {{$event_attend == null ? 'text-danger':'text-primary'}}">{{$event_attend == null ? 'Not Attended':'Attended'}}</span>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-4 my-2">
                                <a href="/admin/user/{{$event->event_id}}" class="btn btn-primary btn-sm text-uppercase">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

            </div>
           
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>

</script>
@endsection