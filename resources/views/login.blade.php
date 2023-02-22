@extends('layout')

@section('title')
    Login | WE Management
@endsection

@section('content')
    <section id="loginSection">
        <div class="login_inner">
            <div class="row">
                <div class="col-lg-4">
                    @if(session('success'))
                        <div class="form-group checkbox text-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="form-group checkbox text-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="form-group checkbox text-danger">
                            @foreach ($errors->all() as $error)
                                <span class="d-block">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('user.login') }}" method="post">
                        @csrf
                        <div class="form-group checkbox">
                            Online Management Systeem (alléén voor geregistreerde gebruikers)
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control-input" name="email">
                            <label class="label-control">E-mailadres</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control-input" name="password">
                            <label class="label-control">Wachtwoord</label>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" name="remember_me"> Onthoud mij
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">INLOGGEN</button>
                        </div>
                    </form>
                    <a class="checkbox" href="{{ route('forgot.form') }}">Forgot password</a>
                </div> <!-- end of col -->
                <div class="col-lg-8">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('assets/img/login-img.jpg') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div>
        </div>
    </section>
@endsection
