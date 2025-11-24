@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <form action="{{route('registrationPost')}}" method="post" style="width: 500px">
            <div class="mb-3">
                <label class="form-label">Full name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
