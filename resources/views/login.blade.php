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
                <input type="password" class="form-control" name="password">
            </div>

            <div class="mb-3">
                {!! NoCaptcha::display() !!}
                @if ($error->has('g-recaptcha-response'))
                    <span class="text-danger">
                        {{$errors->first('g-recaptcha-response')}}

                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
