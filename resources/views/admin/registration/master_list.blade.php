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
                                <th>Intern ID</th>
                                <th>Name</th>
                                <th>School</th>
                                <th>Email</th>
                                <th>Google drive link</th>
                                <th>Proof of attendance</th>
                                <th>Approved At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $register)
                                <tr>
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
                                    <td>
                                        {{ \Carbon\Carbon::parse($register->updated_at)->isoFormat('h:s A / MMM D YYYY')}}
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



</script>
@endsection