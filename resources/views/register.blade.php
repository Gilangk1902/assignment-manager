@extends('layouts.main')

@section('container')
    <h3>Register</h3>
    <br>
    <div class="container box">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>                    
                @endforeach
            </ul>
        </div>
        @endif
            
        <form action="" method="POST">
            @csrf
            <div class="form-group my-2">
                <label for="">Enter Your Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group my-2">
                <label for="">Enter Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group my-2">
                <label for="">Enter Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group my-2">
                <label for="">Confirm Password</label>
                <input type="password" name="password confirmation" class="form-control">
            </div>
            <div class="form-group my-2">
                <input type="submit" name="register" class="btn btn-primary" value="register">
            </div>
        </form>
    </div>
@endsection