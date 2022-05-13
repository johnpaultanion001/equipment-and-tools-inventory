@extends('layouts.admin1')

@section('styles')
<style>
    .picture{
        width: 106px;
        height: 106px;
        background-color: #d8d1c9;
        border: 4px solid transparent;
        color: #FFFFFF;
        border-radius: 50%;
        margin: 5px auto;
        overflow: hidden;
        transition: all 0.2s;
        -webkit-transition: all 0.2s;
    }
    .background{
        height: 100% !important;
    }
</style>
@endsection

@section('content')
<div class="col-xl-10 mx-auto mt-2">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <br>
                <h5 class="text-center font-weight-bold">UIP VIRTUAL INTERNSHIP PROGRAM <br> APPLICATION AND CHECKLIST FORM</h5>
            </div>
            <div class="card-header">
                <div class="text-right m-2">
                    @if($application->status != '')
                        <span class="wizard-title font-weight-bold">STATUS: <span class="@if($application->status == 'PENDING') text-warning @elseif($application->status == 'APPROVED') text-success @elseif($application->status == 'COMPLETED')  text-info @endif">{{$application->status ?? ''}}</span></span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <hr>
                            <h5 class="font-weight-bold text-info text-center">INTERNS INFORMATION SECTION:</h5>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" value="{{$application->name ?? ''}}" readonly>
                        </div>

                        <div class="form-group">
                            <label>School:</label>
                            <input type="text" class="form-control" value="{{$application->school ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="picture-container">
                            <div class="form-group">
                                <label>Image:</label>
                                <div class="picture">
                                    <img src="/assets/applicant_picture/{{$application->image}}" class="picture-src" id="wizardPicturePreview" title="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Course:</label>
                            <input type="text" class="form-control" value="{{$application->course ?? ''}}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Contact Number:</label>
                            <input type="text" class="form-control" value="{{$application->contact_number ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Birth Date:</label>
                            <input type="text" class="form-control" value="{{$application->birth_date ?? ''}}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" class="form-control" value="{{$application->address ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Application ID:</label>
                            <input type="text" class="form-control" value="{{$application->application_id ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Advisor Email:</label>
                            <input type="text" class="form-control" value="{{$application->advisor_email ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Required No. of Hours:</label>
                            <input type="text" class="form-control" value="{{$application->required_hours ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Do you need an advance COC?</label>
                            <input type="text" class="form-control" value="{{$application->advance_coc ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Starting Date:</label>
                            <input type="text" class="form-control" value="{{$application->starting_date ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ending Date:</label>
                            <input type="text" class="form-control" value="{{$application->ending_date ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Schedule:</label>
                            <input type="text" class="form-control" value="{{$application->schedule ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->consent == '1' ? 'checked':''}}>
                            <label for="consent" class="form-check-label" style="font-size: 13px;">I am giving consent to the coordinator of this training to collect and process my information for me to receive a proper off boarding process. My information will not be shared with any third-party organization. All documents submitted to the company will only remain on my drive and will not be deleted so that I still have records with the company. The Information will solely be used to report quantitative data of interns and for sending the off-boarding documents and certificates. </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <hr>
                            <h5 class="font-weight-bold text-info text-center">WORK AGREEMENT SECTION:</h5>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name:</label>
                            <input type="text" class="form-control" value="{{$application->company_name ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Address:</label>
                            <input type="text" class="form-control" value="{{$application->company_address ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supervisor Name:</label>
                            <input type="text" class="form-control" value="{{$application->supervisor_name ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supervisor Email Address:</label>
                            <input type="text" class="form-control" value="{{$application->supervisor_email_address ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Supervisor Contact Number:</label>
                            <input type="text" class="form-control" value="{{$application->supervisor_contact_number ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Current Job Title:</label>
                            <textarea class="form-control" readonly>{{$application->current_job_title ?? ''}}</textarea>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Give job title(s) and description for job you hope to have after graduating.</label>
                            <textarea class="form-control" readonly>{{$application->give_job_titles ?? ''}}</textarea>
                        </div> 
                    </div>
                    <div class="col-md-12 mt-2">
                        <hr>
                            <h5 class="font-weight-bold text-info text-center">INTERNSHIP REQUIREMENTS CHECKLIST:</h5>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <p class="text-justify" style="font-size: 18px;">I have completed the following requirements for virtual Internship program:</p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-justify" style="font-size: 18px;">I  <b>{{$application->name}}</b> have read the Internship Handbook. I have discussed each one of the internship requirements with my Academic Advisor Brylle Estrada and MCC, Anafara and Visvis corporation UIP Heads.</p>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist1 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have completed the <a href="">Internship Work Agreement Form</a>  using the most accurate and up-to-date information possible.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist2 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have already submitted the required documents such as Resume, Letter of endorsement and Notarized MOA.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist3 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have completed all the tasks provided by the company and completely uploaded all the files to Drive.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist4 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">My attendance is complete and the hours I need for the internship are done.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist5 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">My attendance logs were checked by HR- Admin.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist6 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have no bad record with the company and did not commit offenses.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist7 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">Immediately upon completion of the internship, I will upload the copy of Certificate of Completion to the submission form.</a>  using the most accurate and up-to-date information possible.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox" class="form-check-input" {{$application->checklist8 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have received an official acceptance letter.</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check ml-4">
                            <input type="checkbox"  class="form-check-input" {{$application->checklist9 == '1' ? 'checked':''}}>
                            <label class="form-check-label" style="font-size: 17px;">I have completed the Off Boarding process</label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label>Proof of attendance: </label>
                            <a href="/assets/applicant_proof_of_attendance/{{$application->proof_of_attendance}}" target="_blank">{{$application->proof_of_attendance}}</a>
                        </div> 
                    </div>
                    <div class="col-md-12 mt-5">
                        <p class="text-justify" style="font-size: 18px;">I <b>{{$application->name}}</b> understand that failure to follow the requirements for the Virtual Internship program listed above, will result in my evaluation form provided by the school OJT coordinator will not be filled out by the company representative. The following requirements must be completed before issuing the Evaluation form.</p>
                    </div>
                                       
                    <div class="col-md-12 mt-5 row">
                        <div class="col-12">
                            <hr>
                            <br>
                        </div>
                        <div class="col-6 text-center">
                        
                            <h6>
                                {{$application->name}}
                            </h6>
                            <h6  style="font-size: 12px;">Intern's Signature</h6>
                        </div>
                        <div class="col-6 text-center">
                            <h6>
                                {{$application->created_at->format('M j , Y ') }}
                            </h6>
                            <h6  style="font-size: 12px;">Date</h6>
                        </div>
                        <div class="col-12">
                            <br>
                            <br>
                        </div>
                        <div class="col-6 text-center">
                            <h6>
                                Mr. Brylle Estrada
                            </h6>
                            <h6  style="font-size: 12px;">UIP ADMINISTRATIVE HEAD’S SIGNATURE</h6>
                        </div>
                        <div class="col-6 text-center">
                            <h6>
                                {{$application->created_at->format('M j , Y ') }}
                            </h6>
                            <h6  style="font-size: 12px;">Date</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer m-5">
                <div class="pull-right">
                  <input type='button' class='btn btn-success btn-wd font-weight-bold status'  status="{{$application->id}}" value='SET STATUS' />   
                </div>
                <div class="pull-left">
                    <a href="/admin/applications" class="btn  btn-default btn-wd font-weight-bold">BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <p class="modal-title  text-uppercase font-weight-bold">SET STATUS</p>
                    <button type="button" class="close " data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase h6" >STATUS: <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select2" style="width: 100%;">
                                    <option value="PENDING">PENDING</option>
                                    <option value="APPROVED">APPROVED</option>
                                    <option value="COMPLETED">COMPLETED</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                                <div class="form-group text-uppercase h6">
                                <label>Attach File: </label>
                                <input type="file" class="form-control" name="attach_file" id="attach_file">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-attach_file"></strong>
                                </span>
                               
                                
                                <h6 class="mt-2">Current file: <a href="" target="_blank" id="attach_file_link"></a></h6>
                            </div> 
                        </div>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                    <input type="hidden" name="action" id="action" value="Add" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="SUBMIT" />
                </div>
        
            </div>
        </div>
    </div>
</form>



@endsection
@section('scripts')
<script>
$(document).on('click', '.status', function(){
    $('#myModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    application_id = $(this).attr('status');

    $.ajax({
        url :"/admin/applications/"+application_id+"/status",
        dataType:"json",
        method:"GET",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);

            $.each(data.result, function(key,value){
                if(key == 'status'){
                    $("#status").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'admin_attach_file'){
                    $("#attach_file_link").prop("href", "/assets/attach_file/"+value)
                    $("#attach_file_link").text(value)
                }
            })
        }
    })
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "/admin/applications/"+application_id+"/status";
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
                                $(window).scrollTop(0);
                                
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