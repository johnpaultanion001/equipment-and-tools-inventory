@extends('layouts.admin1')

@section('styles')
<style>
  .background{
    height: 100% !important;
  }
</style>
@endsection
@section('content')
<div class="col-xl-12">
  <div class="row">
      <div class="col-xl-8 mx-auto mt-5">
      <div class="card p-3  d-block mx-auto">
        <div class="py-4">
          <form method="POST" id="myForm" class="form-horizontal ">
            @csrf
            <div class="card-header text-center px-3 px-md-4 py-0">
              <h3 class="card-title title-up  mt-4
              ">Sign up</h3>
              <p style="font-weight: 700; line-height: 1; font-size: 14px;"><b>Getting started is easy. Sign up now.</b></p>
            </div>
            
            <div class="card-body px-4 px-md-5">
                <div class="row">
                  <div class="col-sm-6">
                          <div class="form-group text-uppercase h6">
                          <label>Name:  <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name" autofocus>
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-name"></strong>
                          </span>
                      </div> 
                  </div>
                  <div class="col-sm-6">
                          <div class="form-group text-uppercase h6">
                          <label>School:  <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="school" id="school" placeholder="School">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-school"></strong>
                          </span>
                      </div> 
                  </div>
                  <div class="col-sm-6">
                          <div class="form-group text-uppercase h6">
                          <label>Intern ID:  <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="intern_id" id="intern_id" placeholder="Intern ID">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-intern_id"></strong>
                          </span>
                      </div> 
                  </div>
                  <div class="col-sm-6">
                          <div class="form-group text-uppercase h6">
                          <label>Email:  <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-email"></strong>
                          </span>
                      </div> 
                  </div>
                  <div class="col-sm-12">
                          <div class="form-group text-uppercase h6">
                          <label>Google Drive Link:  <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="google_drive" id="google_drive" placeholder="Google Drive Link">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-google_drive"></strong>
                          </span>
                      </div> 
                  </div>
                  <div class="col-sm-12">
                          <div class="form-group text-uppercase h6">
                          <label>Attach Proof Of Attendance:  <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" name="attach_attendance" id="attach_attendance" placeholder="Attach Proof Of Attendance">
                          <span class="invalid-feedback" role="alert">
                              <strong id="error-attach_attendance"></strong>
                          </span>
                      </div> 
                  </div>
                </div>
              <input type="submit" id="action_button" class="btn btn-main" value="Submit" />
              
            </div>
          </form>
          <p class="text-center mt-3 text-dark" style="font-size: 15px; font-weight: 500;">Already have an account? <a href="/login"><button class="btn btn-sm btn-info" style="font-weight: 700">Login here</button></a></p>
        </div>
        
      </div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $('#myForm').on('submit', function(event){
      event.preventDefault();
      $('.form-control').removeClass('is-invalid')
      var action_url = "/registration";
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
</script>
@endsection