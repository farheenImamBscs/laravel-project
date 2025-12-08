@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <form action="{{route('loginPost')}}" method="post" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password">

                <div style="text-align:right; margin-top:5px;">
                    <span onclick="togglePassword()" style="cursor:pointer;">
                        <i id="eyeIcon" class="fa fa-eye"></i> Show Password
                    </span>
                </div>
            </div>


            <hr>

            <div class="text-center mt-3">
                <a href="{{ route('auth.google.redirect') }}" class="btn btn-danger w-100">
                    <i class="fab fa-google me-2"></i> Login with Google
                </a>
            </div>

            <div class="mb-3">
                {!! NoCaptcha::display() !!}
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        function togglePassword(){
            const field = document.getElementById("password");

            if (field.type === "password"){
                field.type = "text";
            }else{
                field.type = "password";
            }
        }
    </script>

{{--    Render the captcha--}}
    {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::renderJs() !!}
@endsection
