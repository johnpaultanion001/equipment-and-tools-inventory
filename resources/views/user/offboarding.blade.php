@extends('layouts.admin1')
@section('styles')

<link href="{{ asset('/assets/css/paper-bootstrap-wizard.css') }}" rel="stylesheet" />
<link href="{{ asset('/assets/css/demo.css') }}" rel="stylesheet" />

<link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="{{ asset('/assets/css/themify-icons.css') }}" rel="stylesheet">

<style>
  .background{
    height:100% !important;
    width: 100% !important;
  }
</style>
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
                            <div class="wizard-header text-right">
                                @if(Auth()->user()->application->status != '')
                                    <span class="wizard-title font-weight-bold">STATUS: <span class="@if(Auth()->user()->application->status == 'PENDING') text-warning @elseif(Auth()->user()->application->status == 'APPROVED') text-success @elseif(Auth()->user()->application->status == 'COMPLETED')  text-info @endif">{{Auth()->user()->application->status ?? ''}}</span></span>
                                @endif
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
                                    <li class="{{Auth()->user()->application->status == 'APPROVED' ? 'active':''}}">
                                        <a href="#step2" data-toggle="tab"  {{Auth()->user()->application->status == 'PENDING' || Auth()->user()->application->status == '' ? 'style=pointer-events:none':''}}>
                                            <div class="icon-circle">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            STEP 2
                                        </a>
                                    </li>
                                    <li class="{{Auth()->user()->application->status == 'COMPLETED' ? 'active':''}}">
                                        <a href="#step3" data-toggle="tab" {{Auth()->user()->application->status == 'PENDING' || Auth()->user()->application->status == '' ? 'style=pointer-events:none':''}}>
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
                                            <hr>
                                                <h5 class="font-weight-bold text-info text-center">INTERNS INFORMATION SECTION:</h5>
                                            <br>
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

                                            <div class="form-group">
                                                <label>Schedule: <span class="text-danger">*</span></label>
                                                <input id="schedule" name="schedule" type="text" class="form-control" value="{{Auth()->user()->application->schedule ?? ''}}" placeholder="MTWTTHF/8am to 5 pm" />
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-schedule"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Do you need an advance COC? <span class="text-danger">*</span></label>
                                                <select name="advance_coc" id="advance_coc" class="form-control">
                                                    <option value="">...</option>
                                                    <option value="YES" {{Auth()->user()->application->advance_coc == 'YES' ? 'selected':''}}>YES</option>
                                                    <option value="NO" {{Auth()->user()->application->advance_coc == 'NO' ? 'selected':''}}>NO</option>
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-advance_coc"></strong>
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
                                        
                                        <div class="col-md-12 mt-2">
                                            <hr>
                                                <h5 class="font-weight-bold text-info text-center">WORK AGREEMENT SECTION:</h5>
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name: <span class="text-danger">*</span></label>
                                                <input id="company_name" name="company_name" type="text" class="form-control" value="{{Auth()->user()->application->company_name ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-company_name"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Address: <span class="text-danger">*</span></label>
                                                <input id="company_address" name="company_address" type="text" class="form-control" value="{{Auth()->user()->application->company_address ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-company_address"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Supervisor Name: <span class="text-danger">*</span></label>
                                                <input id="supervisor_name" name="supervisor_name" type="text" class="form-control" value="{{Auth()->user()->application->supervisor_name ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-supervisor_name"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Supervisor Email Address: <span class="text-danger">*</span></label>
                                                <input id="supervisor_email_address" name="supervisor_email_address" type="email" class="form-control" value="{{Auth()->user()->application->supervisor_email_address ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-supervisor_email_address"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Supervisor Contact Number: <span class="text-danger">*</span></label>
                                                <input id="supervisor_contact_number" name="supervisor_contact_number" type="number" class="form-control" value="{{Auth()->user()->application->supervisor_contact_number ?? ''}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-supervisor_contact_number"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Current Job Title: <span class="text-danger">*</span></label>
                                                <textarea name="current_job_title" id="current_job_title" class="form-control" placeholder=" Brief Description ">{{Auth()->user()->application->current_job_title ?? ''}}</textarea>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-current_job_title"></strong>
                                                </span>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Give job title(s) and description for job you hope to have after graduating. <span class="text-danger">*</span></label>
                                                <textarea name="give_job_titles" id="give_job_titles" class="form-control" placeholder="Title: &#10;Brief Description ">{{Auth()->user()->application->give_job_titles ?? ''}}</textarea>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-give_job_titles"></strong>
                                                </span>
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
                                            <p class="text-justify" style="font-size: 18px;">I  <b>{{Auth()->user()->application->name}}</b> have read the Internship Handbook. I have discussed each one of the internship requirements with my Academic Advisor Brylle Estrada and MCC, Anafara and Visvis corporation UIP Heads.</p>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist1" id="checklist1" {{Auth()->user()->application->checklist1 == '1' ? 'checked':''}}>
                                                <label for="checklist1" class="form-check-label" style="font-size: 17px;">I have completed the <a href="">Internship Work Agreement Form</a>  using the most accurate and up-to-date information possible.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist1"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist2" id="checklist2" {{Auth()->user()->application->checklist2 == '1' ? 'checked':''}}>
                                                <label for="checklist2" class="form-check-label" style="font-size: 17px;">I have already submitted the required documents such as Resume, Letter of endorsement and Notarized MOA.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist2"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist3" id="checklist3" {{Auth()->user()->application->checklist3 == '1' ? 'checked':''}}>
                                                <label for="checklist3" class="form-check-label" style="font-size: 17px;">I have completed all the tasks provided by the company and completely uploaded all the files to Drive.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist3"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist4" id="checklist4" {{Auth()->user()->application->checklist4 == '1' ? 'checked':''}}>
                                                <label for="checklist4" class="form-check-label" style="font-size: 17px;">My attendance is complete and the hours I need for the internship are done.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist4"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist5" id="checklist5" {{Auth()->user()->application->checklist5 == '1' ? 'checked':''}}>
                                                <label for="checklist5" class="form-check-label" style="font-size: 17px;">My attendance logs were checked by HR- Admin.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist5"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist6" id="checklist6" {{Auth()->user()->application->checklist6 == '1' ? 'checked':''}}>
                                                <label for="checklist6" class="form-check-label" style="font-size: 17px;">I have no bad record with the company and did not commit offenses.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist6"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist7" id="checklist7" {{Auth()->user()->application->checklist7 == '1' ? 'checked':''}}>
                                                <label for="checklist7" class="form-check-label" style="font-size: 17px;">Immediately upon completion of the internship, I will upload the copy of Certificate of Completion to the submission form.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist7"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist8" id="checklist8" {{Auth()->user()->application->checklist8 == '1' ? 'checked':''}}>
                                                <label for="checklist8" class="form-check-label" style="font-size: 17px;">I have received an official acceptance letter.</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist8"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check ml-4">
                                                <input type="checkbox" class="form-check-input" name="checklist9" id="checklist9" {{Auth()->user()->application->checklist9 == '1' ? 'checked':''}}>
                                                <label for="checklist9" class="form-check-label" style="font-size: 17px;">I have completed the Off Boarding process</label>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-checklist9"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                              <div class="form-group">
                                                <label>Proof of your attendance: <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="proof_of_attendance" id="proof_of_attendance">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-proof_of_attendance"></strong>
                                                </span>
                                                <a href="/assets/applicant_proof_of_attendance/{{Auth()->user()->application->proof_of_attendance}}" target="_blank">{{Auth()->user()->application->proof_of_attendance}}</a>
                                            </div> 
                                        </div>
                                       
                                        <div class="col-md-12 mt-5">
                                            <p class="text-justify" style="font-size: 18px;">I <b>{{Auth()->user()->application->name}}</b> understand that failure to follow the requirements for the Virtual Internship program listed above, will result in my evaluation form provided by the school OJT coordinator will not be filled out by the company representative. The following requirements must be completed before issuing the Evaluation form.</p>
                                        </div>
                                       
                                        <div class="col-md-12 mt-5 row">
                                            <div class="col-12">
                                                <hr>
                                                <br>
                                            </div>
                                            <div class="col-6 text-center">
                                           
                                                <h6>
                                                    {{Auth()->user()->application->name}}
                                                </h6>
                                                <h6  style="font-size: 12px;">Intern's Signature</h6>
                                            </div>
                                            <div class="col-6 text-center">
                                                <h6>
                                                    {{ Auth()->user()->application->created_at->format('M j , Y ') }}
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
                                                    {{ Auth()->user()->application->created_at->format('M j , Y ') }}
                                                </h6>
                                                <h6  style="font-size: 12px;">Date</h6>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-12 text-center mt-5">
                                            <h6 class="text-danger text-uppercase">* please double check all the information before you submit it </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane {{Auth()->user()->application->status == 'APPROVED' ? 'active':''}}" id="step2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-justify font-weight-bold" style="font-size: 18px;">Please download the attached <a href="/assets/attach_file/{{Auth()->user()->application->admin_attach_file ?? ''}}" target="_blank">file</a> and upload it to your google drive. Send the link of your drive to our partner shop below. </p>
                                            <p class="text-justify font-weight-bold text-center" style="font-size: 18px;">Partner Shop: <a target="_blank" href="https://shopee.ph/product/299893127/11121762967?fbclid=IwAR2m1xM1KRXmcuID70GUZgrpgHQK9dml3tFw_rXrJ8OeNlUzeKupOoXquLo">Partner Shop Link</a> </p>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <p>After you send the link to our partner shop, please wait 3-5 business days for your COC hardcopy. </p>
                                                <h6 class="text-danger text-uppercase"> NOTE: Click on the "Receive" button below once you received your COC hardcopy from our partner shop. If you don't need one of it, just click on the "Next" button to proceed.</h6>
                                            <button id="receive_status" class="{{Auth()->user()->application->receive_status == '0' ? 'btn-warning':'btn-default'}} btn btn-fill btn-wd">{{Auth()->user()->application->receive_status == '0' ? 'Receive':'Received'}}</button>
                                        </div>
                                        
                                        
                                        <div class="col-md-12 text-center mt-5">
                                            <h6 class="text-danger text-uppercase">* Please make sure to give access to anyone with the link</h6>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="tab-pane {{Auth()->user()->application->status == 'COMPLETED' ? 'active':''}}" id="step3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Questions:</b>
                                            <p>1. How would you describe the culture of the company?</p>
                                            <p>2. Can you tell me some of the good and bad experiences you had while working in this company?</p>
                                            <p>3. Are your satisfied with your overall internship experience.</p>
                                            <p>4. What are the skills that you gained that you can use to your future profession?</p>
                                            <p>5. Do you have any suggestions on what areas of function would need to be changed?</p>
                                                
                                        </div>
                                        <div class="col-md-12">
                                              <div class="form-group">
                                                <label>Attach your answer: <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control" name="answer_video" id="answer_video" accept="video/mp4,video/x-m4v,video/*">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="error-answer_video"></strong>
                                                </span>
                                                <a id="answer_link" href="/assets/applicant_answer_video/{{Auth()->user()->application->answer_video}}" target="_blank">{{Auth()->user()->application->answer_video}}</a>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    @if(Auth()->user()->application->status == 'PENDING' || Auth()->user()->application->status == '')
                                        <input type='submit' class='btn btn-fill btn-info btn-wd' id="action_button"value='Submit' />
                                    @else
                                        <input type='button' class='btn btn-next btn-fill btn-info btn-wd' name='next' value='Next' />   
                                    @endif
                                    <button type="button" class="btn btn-fill btn-success btn-wd btn-finish">Finish</button>
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <br><br><br>
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                           <p>
                                Congratulations
                           </p>
                        </div>
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                        <button type="button" class="btn  btn-white text-uppercase" data-dismiss="modal"></button>
                        <button type="button" class="btn  btn-white text-uppercase" data-dismiss="modal">Close</button>
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
                $(window).scrollTop(0);
            }
            
        }
    });
});


$(document).on('click', '#receive_status', function(){
        $.ajax({
            url:"/admin/user/offboarding/receive_status",
            method:'PUT',
            dataType:"json",
            data: {
                          _token: '{!! csrf_token() !!}',
                      },
            beforeSend:function(){
                $("#receive_status").attr("disabled", true);
            },
            success:function(data){
                location.reload();
            }
        })

});

$(document).on('click', '.btn-finish', function(){
       var answer_video = $("#answer_video").prop("files")[0]; 

       var form_data = new FormData();
                form_data.append("answer_video", answer_video);
                form_data.append("_token", '{{csrf_token()}}');

        $.ajax({
            url :"/admin/user/offboarding/answer_video",
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            method: "post",
            beforeSend:function(){
                $('.btn-finish').attr('disabled', true);
            },
            success:function(data){
                $('.btn-finish').attr('disabled', false);
                if(data.error){
                    $('#answer_video').addClass('is-invalid')
                    $('#error-answer_video').text(data.error)
                }
                if(data.success){
                    $('#answer_video').removeClass('is-invalid')
                    $('#answer_link').attr('href', '/assets/applicant_answer_video/' + data.success);
                    $('#answer_link').text(data.success);
                    $('#myModal').modal('show');
                }
            }
      });       
});


</script>
@endsection