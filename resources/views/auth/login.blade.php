@extends('layouts.admin1')
@section('content')
<div class="section py-0">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <div class="col-12 col-lg-5 col-md-6 my-auto">
            <div class="card card-signup d-block mx-auto" style="background: transparent; box-shadow: 0 0 0;">
              <div class="card-grey py-4">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="card-header text-center px-3 px-md-4 py-0">
                  
                    <h3 class="card-title title-up color-black">Member Login</h3>
                    <hr>
                  </div>
            
                  <div class="card-body  px-4 px-md-5">
                    
                    <div class="form-group pt-2">
                      <label class="control-label text-uppercase h6" >Email :</label>
                      <input type="email" id="email" name="email" class="classic-input form-control font-weight-bold {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" autofocus >
                      @if($errors->has('email'))
                      <div class="invalid-feedback">
                          {{ $errors->first('email') }}
                      </div>
                      @endif
                    </div>
                    <div class="form-group pt-1">
                      <label class="control-label text-uppercase h6" >Password :</label> 
                      <input type="password" id="password" name="password" class="classic-input form-control font-weight-bold {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                      <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="float: right; margin-right: 10px; margin-top: -25px; position: relative; z-index: 2;"></span>
                      @if($errors->has('password'))
                          <div class="invalid-feedback">
                              {{ $errors->first('password') }}
                          </div>
                      @endif
                    </div>
                    
                    <input type="submit" name="login" id="login" class="btn btn-main" value="Login" />

                    <div class="form-group pt-4">
                        <input type="checkbox">
                        <b >Remember my EmailAddress</b>
                        <br>
                    </div>
                  </div>
                  
                </form>
              </div>
              <p class="text-center mt-3 color-black" style="font-size: 15px; font-weight: 500;">Do not have an account yet? <a href="/register?user_type=Client"><b class="color-black" style="font-weight: 700">Register here</b></a></p>
            </div>
          </div>
          <div class="d-none d-md-block col-md-6 col-lg-7" style="background-image: url('../assets/images/bg11.jpg'); background-size: cover; background-position: top center;">
            
          </div>
        </div>
      </div>
</div>


@endsection
@section('scripts')
<script>

$("body").on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

</script>
@endsection