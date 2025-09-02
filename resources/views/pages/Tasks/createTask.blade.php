@extends('layouts.my-layout')


@section('content')
    <div class="container">
        <x-auth-session-status class="text" :status="session('status')" />

        <form class="form" method="POST" action="">
            @csrf

            <div>
                <input placeholder="Title" id="title" name="title" type="text" class="input" required="" />
                <x-input-error class="text" :messages="$errors->get('email')" />
            </div>

            <div>
                <textarea name="description" placeholder="Description" id="description" cols="7" rows="7" class="input" required=""></textarea>
                <x-input-error class="text" :messages="$errors->get('email')" />
            </div>

            <div>
                <input placeholder="Dead Line" id="Deadline" name="deadline" type="date" value="{{$deadLine}}" class="input" required="" />
                <x-input-error class="text" :messages="$errors->get('email')" />
            </div>

            <div class="checkBox">
                <input type="radio" name="status" value="pending" checked>
                <label for="status">Pending</label>
                <input id="in_progress" type="radio" name="status" value="in_progress">
                <label for="status">In Progress</label>
            </div>

            <div>
                <textarea name="subTask" placeholder="Sub Task (Optional)" id="subTask" cols="7" rows="7" class="input"></textarea>
                <x-input-error class="text" :messages="$errors->get('email')" />
            </div>

            <input value="Create" type="submit" class="CreateTask" />
        </form>
    </div>

    <style>
        .text {
            color: grey;
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

        #description {
            resize: vertical;
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

        .form .CreateTask {
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

        .form .CreateTask:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .form .CreateTask:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .checkBox{
            margin-top: 17px;
            margin-left: 7px;

            color:#0099ff;
        }
    </style>
@endsection
