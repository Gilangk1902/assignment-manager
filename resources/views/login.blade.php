@extends('layouts.main')

@section('container')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h3>Login</h3>
                            <br>
                    
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    <strong>Error:</strong> {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                    
                            <form action="" method="POST">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="email" class="form-label">Enter Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                
                                <div class="mb-3 text-start">
                                    <label for="password" class="form-label">Enter Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>

                                <div class="mb-4 mt-4 d-grid gap-2">
                                    <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
                                </div>
                            </form>
    
                            <p>Don't have an account yet? <a href="/register">Sign up</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection