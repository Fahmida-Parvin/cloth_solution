@extends('layouts.master')
@section('name', 'Cart Page')
@section('content')
    <section class="login-page">
        <div class="login-form-box">
            <div class="login-title">Login</div>
            <div class="login-form">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="@error('email') has-error @enderror" placeholder="example@gmail.com">
                        @error('email')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password" class="@error('password') has-error @enderror" placeholder="******">
                        @error('password')
                        <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="field">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    
                    <a href="{{route('register')}}">New User? Register Now...</a>

                    @csrf


                </form>
            </div>

        </div>
    </section>
@endsection