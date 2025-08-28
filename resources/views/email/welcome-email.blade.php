@extends('layouts.my-layout')

@section('content')
    <div class="container">
        <h1 class="user">Welcome {{ $user->name }}</h1>
        <p class="text">{{env("APP_NAME")}} gives you all what you need to manage your tasks </p>

        <h5 class="text">Best Wishes</h5>
        <h6 class="text">{{env("APP_NAME")}} Team</h6>
    </div>


    </div>

    <style>
        .text {
            color: gray;
        }

        .user {
            color: lightskyblue;
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
    </style>
@endsection
