
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
<link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset('css/eos.css')}}" rel="stylesheet">
<title>EOS</title>
</head>
<body>
  <div class="fullscreen whitebg">
    <div class="container-fluid h-100">
      <div class="row h-100">
        <div class="col-lg-6 col-md-12 cc-left c-center h-100">
          <div class="login-form col-lg-8 col-md-8 col-sm-8">
            <div class="form-group mb-4"> <img src="{{asset('images/logo.png')}}"> </div>
            <form class="login100-form validate-form login-form" method="POST" action="{{ route('login') }}">
                @csrf
                @if (session('error'))
                  <div class="alert alert-danger" role="alert">
                      {{ session('error') }}
                  </div>
                @endif
            <div class="form-group mb-4 relative limg"> <img src="{{asset('images/email.png')}}">
                <input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
            </div>
            @error('email')
                <p class="invalid-feedback d-block mt-10 validation-error">{{ $message }}</p>
            @enderror
            <div class="form-group mb-4 relative limg"> <img src="{{asset('images/password.png')}}">
                <input class="input100" type="password" name="password" placeholder="Password">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="passwordcheck"></span>              
            </div> 
            @error('password')
                <p class="invalid-feedback d-block mt-10 validation-error">{{ $message }}</p>
            @enderror          
            <div class="form-group mb-4">
              <div class="row">                
                <div class="col-12 forgot">
                  <p><a href="#">Forgot Password?</a></p>
                </div>
              </div>
            </div>
            <div class="form-group mb-4">
                <input class="form-control" type="submit" value="Sign In" />
            </div>
            </form>
            <div class="form-group text-center account">
              <p>Don't have an Account?<a href="customersignup.html"> SIGNUP</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 h-100 p-0">
          <div class="side-fullimg login">            
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
	$(document).on('click','#passwordcheck',function(){
  var x = document.getElementById("password-field");
  if (x.type === "password") {
    $(this).toggleClass("fa-eye fa-eye-slash");
    x.type = "text";
  } else {
    $(this).toggleClass("fa-eye fa-eye-slash");
    x.type = "password";
  }
    });
</script>
</html>