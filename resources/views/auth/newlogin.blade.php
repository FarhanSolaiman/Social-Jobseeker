<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SOCIALCLIMB</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/test.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    
</head>
<body>
    <div class="container-fluid first p-0">
        <div class="navi">
            <div class="row m-0">
                <div class="col-lg-2 logophoto">
                    <img src="images/logotext.png"></img>
                </div>
                <div class="col-lg-10">
                    
                </div>
            </div>
        </div>
        <div class="content">
            <section class="user">
              <div class="user_options-container">
                <div class="user_options-text">
                  <div class="user_options-unregistered">
                    <h2 class="user_unregistered-title">Don't have an account?</h2>
                    <p class="user_unregistered-text">Build a social life in the comfort of your work.</p>
                    <button class="user_unregistered-signup" id="signup-button">Sign up</button>
                  </div>

                  <div class="user_options-registered">
                    <h2 class="user_registered-title">Have an account?</h2>
                    <p class="user_registered-text">Where business meets social life.</p>
                    <button class="user_registered-login" id="login-button">Login</button>
                  </div>
                </div>

                <div class="user_options-forms" id="user_options-forms">
                  <div class="user_forms-login">
                    <h2 class="forms_title">Login</h2>
                    <form class="forms_form" action="{{ route('login') }}" method="POST">
                        {{ @csrf_field() }}
                      <fieldset class="forms_fieldset">
                        <div class="forms_field">
                          <input type="email" placeholder="Email" class="forms_field-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus />
                          @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="forms_field">
                          <input type="password" placeholder="Password" name="password" class="forms_field-input{{ $errors->has('password') ? ' is-invalid' : '' }}" required />
                          @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                      </fieldset>
                      <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                      <div class="forms_buttons">
                        <a href="{{ route('password.request') }}" class="forms_buttons-forgot btn">Forgot password?</a>
                        <input type="submit" value="Log In" class="forms_buttons-action">
                      </div>
                    </form>
                  </div>
                  <div class="user_forms-signup">
                    <h2 class="forms_title">Sign Up</h2>
                    <form method="POST" class="forms_form" action="{{ route('register') }}">
                      {{@csrf_field()}}
                      <fieldset class="forms_fieldset">
                        <div class="forms_field" style="display: inline;">
                          <input type="text" placeholder="First Name" class="forms_field-input{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" style="width: 49%" required />
                          @if ($errors->has('firstname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="forms_field" style="display: inline;">
                          <input type="text" placeholder="Last Name" class="forms_field-input{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" style="width: 50%" required />
                          @if ($errors->has('lastname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="forms_field" style="margin-top: 20px;">
                          <input type="email" placeholder="Email" class="forms_field-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required />
                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="forms_field">
                          <input type="password" placeholder="Password" class="forms_field-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                         <div class="forms_field">
                          <input type="password" placeholder="Confirm Password" class="forms_field-input" name="password_confirmation" required />
                        </div>
                      </fieldset>
                      <div class="forms_buttons">
                        <input type="submit" value="Sign up" class="forms_buttons-action">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              {{-- mobile login and register --}}
<div class="mobilelogin">
    <div class="optionbtns">
        <button id="loginbtn">LOGIN</button>
        <button id="signupbtn">SIGNUP</button>
    </div>
    <div class="login2">
        <div class="logform">
            <div class="logging">
                <form class="forms_form" action="{{ route('login') }}" method="POST">
                    {{ @csrf_field() }}
                <p class="form-title">LOGIN</p>
                <input type="email" placeholder="Email" class="form_field-input{{ $errors->has('email') ? ' is-invalid' : '' }}  mb-2" name="email" value="{{ old('email') }}" required autofocus />
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <input type="password" placeholder="Password" name="password" class="form_field-input{{ $errors->has('password') ? ' is-invalid' : '' }} my-2" required />
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <input class="forms-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label mb-2" for="remember">Remember me</label>
                <div class="forms_buttons">
                    <a href="{{ route('password.request') }}" id="form_buttons-forgot" class="btn">Forgot password?</a>
                    <input type="submit" value="Log In" id="form_buttons-action" class="float-right">
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="signup2" style="display: none;">
        <div class="signform">
            <div class="signing">
                <form method="POST" class="forms_form" action="{{ route('register') }}">
                {{@csrf_field()}}
                <p class="form-title">SIGNUP</p>
                <input type="text" placeholder="First Name" class="form_field-input{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" style="width: 49%;display: inline;" required />
                @if ($errors->has('firstname'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
                @endif
                <input type="text" placeholder="Last Name" class="form_field-input{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" style="width: 49%;display: inline;" required />
                @if ($errors->has('lastname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
                <input type="email" placeholder="Email" class="form_field-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required />
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" placeholder="Password" class="form_field-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <input type="password" placeholder="Confirm Password" class="form_field-input mb-2" name="password_confirmation" required />
                <input type="submit" value="Sign up" id="form2_buttons-action" class="float-right">
                </form>
            </div>
        </div>
    </div>
</div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript">

    const signupButton = document.getElementById("signup-button"),
          loginButton = document.getElementById("login-button"),
          userForms = document.getElementById("user_options-forms");

    /**
     * Add event listener to the "Sign Up" button
     */
    signupButton.addEventListener("click", () => {
        userForms.classList.remove("bounceRight");
        userForms.classList.add("bounceLeft");
      }, 
      false 
      );

    /**
     * Add event listener to the "Login" button
     */
    loginButton.addEventListener("click", () => {
        userForms.classList.remove("bounceLeft");
        userForms.classList.add("bounceRight");
      },
      false
    );

        $(document).on('click','#loginbtn', function () {
        $('#loginbtn').css('color','black');
        $('#loginbtn').css('background-color','#F9D4C3');
        $('#signupbtn').css('background-color','transparent');
        $('#signupbtn').css('color','#F9D4C3');
        $('.login2').show();
        $('.signup2').hide();
    });


    $(document).on('click','#signupbtn', function () {
        $('#signupbtn').css('color','black');
        $('#loginbtn').css('color','#F9D4C3');
        $('#loginbtn').css('background-color','transparent');
        $('#signupbtn').css('background-color','#F9D4C3');
        $('.login2').hide();
        $('.signup2').show();
    });

    </script>
</body>
</html>
