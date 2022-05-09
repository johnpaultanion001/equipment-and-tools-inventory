@extends('layouts.admin1')
@section('styles')

<link href="{{ asset('/assets/css/paper-bootstrap-wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/demo.css') }}" rel="stylesheet" />

<link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="{{ asset('/assets/css/themify-icons.css') }}" rel="stylesheet">


@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mx-auto">
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizardProfile">
                        <form id="myForm" method="post">
                            @csrf
                            <div class="wizard-header text-center">
                                <h3 class="wizard-title font-weight-bold">OFFBOARDING PROCESS</h3>
                            </div>
                            <div class="wizard-navigation">
                                <div class="progress-with-circle">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                </div>
                                <ul>
                                    <li>
                                        <a href="#step1" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            STEP 1
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step2" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            STEP 2
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step3" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            STEP 3
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="step1">
                                    <h5 class="text-center font-weight-bold">UIP VIRTUAL INTERNSHIP PROGRAM <br> APPLICATION AND CHECKLIST FORM</h5>
                                    
                                    <h6 class="text-center text-success font-weight-bold">
                                        @if(Auth()->user()->application->status == 'PENDING') 
                                            YOUR APPLICATION IS IN PROCESS. PLEASE WAIT FOR THE ADMIN TO VERIFY YOUR APPLICATION.
                                        @else
                                        
                                        @endif
                                    </h6>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-12 mt-2">
                                            
                                            <h6 class="font-weight-bold">INTERNS INFORMATION SECTION:</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name: <span class="text-danger">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" placeholder="Alexis C Bianzon" value="{{Auth()->user()->application->name ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-name"></strong>
                                                </span>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label>School: <span class="text-danger">*</span></label>
                                                <input id="school" name="school" type="text" class="form-control" placeholder="Manuel S Enverga University Foundation" value="{{Auth()->user()->application->school ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-school"></strong>
                                                </span>
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div class="picture-container">
                                                <div class="form-group">
                                                    <label>Insert Image Here: <span class="text-danger">*</span></label>
                                                    <div class="picture">
                                                        <img src="@if(Auth()->user()->application->image != '') /assets/applicant_picture/{{Auth()->user()->application->image}} @else {{ asset('/assets/images/default-avatar.jpg') }}  @endif " class="picture-src" id="wizardPicturePreview" title="" />
                                                        <input type="file" id="wizard-picture" name="image_file" accept="image/*" >
                                                    </div>
                                                    <span>
                                                        <strong style="color: #dc3545;" id="error-wizard-picture"></strong>
                                                    </span>
                                                </div>
                                                
                                           
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Course: <span class="text-danger">*</span></label>
                                                <input id="course" name="course" type="text" class="form-control" placeholder="BSBA/ Marketing" value="{{Auth()->user()->application->course ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-course"></strong>
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label>Contact Number: <span class="text-danger">*</span></label>
                                                <input id="contact_number" name="contact_number" type="number" class="form-control" placeholder="09197075776" value="{{Auth()->user()->application->contact_number ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-contact_number"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date: <span class="text-danger">*</span></label>
                                                <input id="birth_date" name="birth_date" type="date" class="form-control" value="{{Auth()->user()->application->birth_date ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-birth_date"></strong>
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label>Address No. Inc. Bldg. Name / Street / Subdivision: <span class="text-danger">*</span></label>
                                                <input id="address" name="address" type="text" class="form-control" placeholder="Pag-asa/Ibabang-Dupay/Lucena City" value="{{Auth()->user()->application->address ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-address"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Application ID:</label>
                                                <input id="application_id" name="application_id" type="text" class="form-control" value="{{Auth()->user()->application->application_id ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-application_id"></strong>
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label>Student's Email: <span class="text-danger">*</span></label>
                                                <input id="email" name="email" type="email" class="form-control" value="{{Auth()->user()->email ?? ''}}" placeholder="Alexisbianzon18@gmail.com" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-email"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label>Student's Advisor: <span class="text-danger">*</span></label>
                                                <input id="student_advisor" name="student_advisor" type="text" class="form-control" placeholder="Flormando Baldovino" value="{{Auth()->user()->application->student_advisor ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-student_advisor"></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Advisor Email: </label>
                                                <input id="advisor_email" name="advisor_email" type="email" class="form-control" value="{{Auth()->user()->application->advisor_email ?? ''}}" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-advisor_email"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Required No. of Hours: <span class="text-danger">*</span></label>
                                                <input id="required_hours" name="required_hours" type="text" class="form-control" value="{{Auth()->user()->application->required_hours ?? ''}}" placeholder="600" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-required_hours"></strong>
                                                </span>
                                            </div> 
                                            <div class="form-group">
                                                <label>Starting Date: <span class="text-danger">*</span></label>
                                                <input id="starting_date" name="starting_date" type="date" class="form-control" value="{{Auth()->user()->application->starting_date ?? ''}}"/>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-starting_date"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Schedule: <span class="text-danger">*</span></label>
                                                <input id="schedule" name="schedule" type="text" class="form-control" value="{{Auth()->user()->application->schedule ?? ''}}" placeholder="MTWTTHF/8am to 5 pm" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-schedule"></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Ending Date: <span class="text-danger">*</span></label>
                                                <input id="ending_date" name="ending_date" type="date" class="form-control" value="{{Auth()->user()->application->ending_date ?? ''}}"  />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-ending_date"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group form-check ml-4">
                                                <input type="checkbox" class="form-check-input" {{Auth()->user()->application->consent == '1' ? 'checked':''}} name="consent" id="consent">
                                                <label for="consent" class="form-check-label" style="font-size: 13px;">I am giving consent to the coordinator of this training to collect and process my information for me to receive a proper off boarding process. My information will not be shared with any third-party organization. All documents submitted to the company will only remain on my drive and will not be deleted so that I still have records with the company. The Information will solely be used to report quantitative data of interns and for sending the off-boarding documents and certificates. </label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-consent"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 text-center mt-5">
                                            <h6 class="text-danger text-uppercase">* please double check all the information before you submit it </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="step2">
                                    step 2
                                   
                                </div>
                                <div class="tab-pane" id="step3">
                                    step 3
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='submit' class='btn btn-fill btn-info btn-wd' id="action_button"value='Submit' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script src="{{ asset('/assets/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>


<script src="{{ asset('/assets/js/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/paper-bootstrap-wizard.js') }}" type="text/javascript"></script>

<!--  More information about jquery.validate here: https://jqueryvalidation.org/	 -->
<script src="{{ asset('/assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>

<script>
$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.user.offboarding.application') }}";
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
            $("#action_button").attr("value", "Loading..");
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Submit");
        
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                    if(key == 'image_file'){
                        $('#wizard-picture').addClass('is-invalid')
                        $('#error-wizard-picture').text(value)
                    }
                })
            }
            if(data.success){
                location.reload();
            }
            
        }
    });
});


</script>
@endsection