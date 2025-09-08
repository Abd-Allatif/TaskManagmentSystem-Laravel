@extends('layouts.my-layout')


@section('content')
    <div class="container">
        <!-- Session Status -->
        <x-auth-session-status class="text" :status="session('status')" />

        <form class="form" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <input placeholder="E-mail" id="email" name="email" type="email" class="input" required="" />
                <x-input-error class="text" :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div>
                <input placeholder="Password" id="password" name="password" type="password" class="input"
                    required="" />
                <x-input-error class="text" :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div>
                <div class="checkbox-wrapper">
                    <input type="checkbox" class="check" id="check1-61" name="remember">
                    <label for="check1-61" class="label">
                        <svg width="30" height="30" viewBox="0 0 95 95">
                            <rect x="30" y="20" width="35" height="35" stroke="#0099ff" fill="none"></rect>
                            <g transform="translate(0,-952.36222)">
                                <path
                                    d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4"
                                    stroke="#0099ff" stroke-width="3" fill="none" class="path1"></path>
                            </g>
                        </svg>
                        <span>Remember me</span>
                    </label>
                </div>
            </div>

            @if (Route::has('password.request'))
                <span class="forgot-password">
                    <a href="{{ route('password.request') }}">Forgot Password ?</a>
                     <a id="createAccount" href="{{ route('register') }}">Don't have account ?</a>
                </span>
            @endif
            

            <input value="Sign In" type="submit" class="login-button" />
        </form>
    </div>

    <style>
        .text{
            color:grey;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 350px;
            background: #f8f9fd;
            background: linear-gradient(0deg,
                    rgb(255, 255, 255) 0%,
                    rgb(244, 247, 251) 100%);
            border-radius: 40px;
            padding: 25px 35px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
            margin: 20px;
        }

        .heading {
            text-align: center;
            font-weight: 900;
            font-size: 30px;
            color: rgb(16, 137, 211);
        }

        .form {
            margin-top: 20px;
        }

        .form .input {
            width: 90%;
            background: white;
            border: none;
            padding: 15px 20px;
            border-radius: 20px;
            margin-top: 15px;
            box-shadow: #cff0ff 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
        }

        .form .input::-moz-placeholder {
            color: rgb(170, 170, 170);
        }

        .form .input::placeholder {
            color: rgb(170, 170, 170);
        }

        .form .input:focus {
            outline: none;
            border-inline: 2px solid #12b1d1;
        }

        .form .forgot-password {
            display: block;
            margin-top: 10px;
            margin-left: 10px;
        }

        .form #createAccount {
            margin-top: 10px;
            margin-left: 45%;
        }

        .form .forgot-password a {
            font-size: 11px;
            color: #0099ff;
            text-decoration: none;
        }

        .form .login-button {
            display: block;
            width: 100%;
            font-weight: bold;
            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;
            margin: 20px auto;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .form .login-button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .form .login-button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            visibility: hidden;
            display: none;
        }

        .checkbox-wrapper *,
        .checkbox-wrapper ::after,
        .checkbox-wrapper ::before {
            box-sizing: border-box;
            user-select: none;
        }

        .checkbox-wrapper {
            position: relative;
            display: block;
            overflow: hidden;

            margin-top: 20px;
        }

        .checkbox-wrapper .label {
            cursor: pointer;
            color: #0099ff;
        }

        .checkbox-wrapper .check {
            width: 25px;
            height: 25px;
            position: absolute;
            opacity: 0;
        }

        .checkbox-wrapper .label svg {
            vertical-align: middle;
        }

        .checkbox-wrapper .path1 {
            stroke-dasharray: 400;
            stroke-dashoffset: 400;
            transition: .5s stroke-dashoffset;
            opacity: 0;
        }

        .checkbox-wrapper .check:checked+label svg g path {
            stroke-dashoffset: 0;
            opacity: 1;
        }
    </style>
@endsection
