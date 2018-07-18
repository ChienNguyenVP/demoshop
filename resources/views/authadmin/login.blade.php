<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form method="POST" action="{{ route('admin.login') }}">
                        @csrf
					<form class="login100-form validate-form">
						<span class="login100-form-title p-b-55">
							Login
						</span>

						<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
                                <input id="email" type="email" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<span class="lnr lnr-envelope"></span>
							</span>
						</div>

						<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
							 <input id="password" type="password" class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<span class="lnr lnr-lock"></span>
							</span>
						</div>

						<div class="contact100-form-checkbox m-l-4">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="ckb1">
								Nhớ mật khẩu
							</label>
						</div>
						
						<div class="container-login100-form-btn p-t-25">
							<button class="login100-form-btn">
								Login
							</button>
						</div>

						<div class="text-center w-full p-t-42 p-b-22">
							<span class="txt1">
								Đăng nhập với
							</span>
						</div>
						<a href="#" class="btn-face m-b-10">
							<i class="fa fa-facebook-official"></i>
							Facebook
						</a>

						<a href="#" class="btn-google m-b-10">
							<img src="{{asset('login/images/icons/icon-google.png')}}" alt="GOOGLE">
							Google
						</a>

						<div class="text-center w-full p-t-115">
							<span class="txt1">
								Không phải là thành viên
							</span>

							<a class="txt1 bo1 hov1" href="{{ route('admin.register') }}">
								Đăng kí ngay						
							</a>
						</div>
					</form>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('login/js/main.js')}}"></script>

</body>
</html>