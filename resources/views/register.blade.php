@extends('layouts.main')

@section('container')
    <div class="container box">
        <h3>Register</h3>
        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Enter Your Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Enter Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Enter Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
        
            <div class="mb-3">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
@endsection