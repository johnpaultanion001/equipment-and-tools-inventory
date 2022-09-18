@extends('layouts.admin')
@section('sub-title','History')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">History of your attended</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Title</th>
                            <th>Date you attend</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event_attend as $event)
                        <tr class='clickable-row' data-href="/admin/user/{{$event->event->event_id}}">
                            <td>{{$event->event->event_id ?? ''}}</td>
                            <td>{{$event->event->title ?? ''}}</td>
                            <td>{{$event->created_at->format('M j , Y h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
@endsection
