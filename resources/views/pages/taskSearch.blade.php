@extends('layouts.my-layout')

@section('content')

    <head>
        <div class="AppBar">
            <h1 id="bartitle">Tasks</h1>
        </div>

        <div id="BackButton">
            <button class="backButton" onclick="window.location.href='{{ route('getAllTasks', $userId) }}'">Back</button>
        </div>

        @foreach ($searchResult as $task)
            <div class="container">
                <ul class="taskList">

                    <li class="tasks">
                        <h3 id="task_title">{{ $task->title }}</h3>

                        <div class="categories">
                            <div style="display:flex;flex-direction:row;">
                                <div style="display:flex;flex-direction:row;">
                                    @foreach ($task->categories as $categories)
                                        <div class="categories"
                                            style="color:{{ $categories->color }};padding-left:10px;;padding-top:10px;display:flex;flex-direction:row;">
                                            {{ $categories->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="status">
                                @if ($task->status == 'pending')
                                    <div class="statusContainer">
                                        <h4 id="task_status">{{ $task->status }}</h4>
                                        <div class="orange_dot"></div>
                                    </div>
                                @elseif ($task->status == 'in_progress')
                                    <div class="statusContainer">
                                        <h4 id="task_status">{{ $task->status }}</h4>
                                        <div class="green_dot"></div>
                                    </div>
                                @else
                                    <div class="statusContainer">
                                        <h4 id="task_status">{{ $task->status }}</h4>
                                        <div class="red_dot"></div>
                                    </div>
                                @endif
                            </div>

                            <div class="dates">
                                <h4 id="task_Created_date">Created: {{ $task->create_date }}</h4>
                                <h4 id="task_End_date">Dead Line: {{ $task->deadline }}</h4>
                            </div>

                            <div id="aboutTask">
                                <button class="button"
                                    onclick="window.location.href='{{ route('getClickedTask', $task->id) }}'">View
                                    Details</button>
                            </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </head>

    <style>
        * {
            padding: 0;
            margin: 0;

        }

        .AppBar {
            display: flex;

            flex-direction: row;

            justify-content: center;

            width: 100%;
            height: 75px;
            background: #f8f9fd;
            background: linear-gradient(0deg,
                    rgb(255, 255, 255) 0%,
                    rgb(244, 247, 251) 100%);

            border-bottom: 1px solid rgb(16, 137, 211);

            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 10px 10px -5px;

            margin: 0;
            text-align: center;
        }

        #bartitle {
            align-self: center;
            color: #0099ff;
        }

        #BackButton {
            align-self: flex-start;
            justify-self: flex-start;

            margin-left: 20px;
        }

        .backButton {
            display: block;
            width: 100px;
            font-weight: bold;

            align-self: center;
            justify-self: center;

            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;

            margin-top: 20px;

            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .backButton:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .backButton:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .taskList {
            list-style-type: none;
            padding: 20px;
        }

        .tasks {
            align-self: center;
            justify-self: center;

            width: 500px;
            background: #f8f9fd;
            background: linear-gradient(0deg,
                    rgb(255, 255, 255) 0%,
                    rgb(244, 247, 251) 100%);
            border-radius: 40px;
            padding: 25px 35px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;

            cursor: pointer;
        }

        #task_title {
            margin-left: 20px;

            color: #4ab7ff;
        }

        .categories {
            padding-left: 10px;
        }

        #task_status {
            margin-left: 20px;
            margin-top: 10px;

            color: rgb(177, 177, 177);
        }

        .statusContainer {
            display: flex;
            flex-direction: row;
        }

        .orange_dot {
            background-color: orange;
            height: 10px;
            width: 10px;
            border-radius: 50%;

            margin-top: 15px;
            margin-left: 5px;
        }

        .green_dot {
            background-color: green;
            height: 10px;
            width: 10px;
            border-radius: 50%;

            margin-top: 15px;
            margin-left: 5px;
        }

        .red_dot {
            background-color: red;
            height: 10px;
            width: 10px;
            border-radius: 50%;

            margin-top: 15px;
            margin-left: 5px;
        }

        .dates {
            display: flex;
            flex-direction: row;

            #task_Created_date {
                margin-left: 20px;
                margin-top: 10px;

                color: #6ac2fc;

            }

            #task_End_date {
                margin-left: 30px;
                margin-top: 10px;

                color: #6ac2fc;

            }
        }

        #aboutTask {
            margin-top: 10px;
            margin-left: 20px;
        }

        .button {
            display: block;
            width: 140px;
            font-weight: bold;

            align-self: center;
            justify-self: center;

            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;

            margin-top: 20px;

            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }


        .submitContainer {
            margin-left: 20px;
        }

        .searchButton {
            display: block;
            width: 70px;
            font-weight: bold;

            align-self: center;
            justify-self: center;

            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 10px;


            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .searchButton:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .searchButton:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }
    </style>
@endsection
