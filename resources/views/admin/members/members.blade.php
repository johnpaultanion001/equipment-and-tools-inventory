@extends('layouts.admin')
@section('sub-title','Members')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <div class="card shadow mb-4">
        
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Members</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Register At</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($users as $user)
                                        <tr class='clickable-row' data-href="/admin/users/account/{{$user->id}}">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roles()->pluck('title')->implode(', ')}}</td>
                                            <td>{{$user->created_at}}</td>
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