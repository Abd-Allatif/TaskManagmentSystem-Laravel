@extends('layouts.my-layout')

@section('content')
    <div class="container">
        <h1 class="user">Hello {{ $user->name }}</h1>
        <h3 class="text">Please click the url below to verify your email address</h3>

        <a class=".login-button" href={{$url}}>Verify Email Address</a>

        <h4 class="text">Thank You!</h4>
        <h6 class="text">{{env("APP_NAME")}} Team</h6>
    </div>


    </div>

    <style>
        .text {
            color: gray;
        }

        .user {
            color: lightblue;
            margin-top: 10px;

            text-align: center;
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

        .login-button {
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

        .login-button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .login-button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }
    </style>
@endsection
