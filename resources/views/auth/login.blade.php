
    <br><br><br><br>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style_login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <title>Login Page</title>
    </head>

    <body>
        <div class="container" id="container">

            <div class="form-container sign-up">
                <form method="post" action="{{route('register')}}">
                    @csrf
                    <h1>Create Account</h1>
                    <input type="text" name= 'name' id="name" placeholder="Name" value="{{old('name')}}" >
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            {{$errors->first('name')}}
                        </div>
                    @endif

                    <input type="email" name="Email" id="Email" placeholder="Email" value="{{old('Email')}}" >
                    @if ($errors->has('Email'))
                        <div class="alert alert-danger">
                            {{$errors->first('Email')}}
                        </div>
                    @endif

                    <input type="password" id="Password" name="Password" placeholder="Password" value="{{old('Password')}}" >
                    @if ($errors->has('Password'))
                        <div class="alert alert-danger">
                            {{$errors->first('Password')}}
                        </div>
                    @endif

                    <input type="password" id="Password_confirmation"  name="Password_confirmation"  placeholder="confirm Password">
                    <x-input-error :messages="$errors->get('Password_confirmation')" class="mt-2" />

                    <button type="submit">Sign Up</button>
                </form>
            </div>






            <div class="form-container sign-in">
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <h1>Sign In</h1>
                    <input type="email"  name="email" placeholder="Email" value="{{old('email')}}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <input type="password" name="password" placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <a href="http://127.0.0.1:8000/forgot-password">Forgot your password?</a>
                    
                    <button type="sumit" >Sign In</button>
                    <br>
                    <div>
                        <div>
                            <a href="/socialite/github" class="PX-3 PY-2"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                            </svg></a>
                            
                            <a href="/socialite/google" ><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                                </svg></a>
                            
                            <a href="/socialite/facebook"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg></a>
                        </div>
                    </div>
                    
                </form>
                
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Friend!</h1>
                        <p>Register with your personal details to use all of site features</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="JS/login.js"></script>
        <script src="JS/bootstrap.bundle.min.js"></script>
    </body>

    </html>
