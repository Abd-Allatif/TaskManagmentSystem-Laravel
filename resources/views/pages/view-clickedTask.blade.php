@extends('layouts.my-layout')

@section('content')

    <head>
        <div class="AppBar">
            <h1 id="bartitle">Tasks</h1>
        </div>

        <div class="container">
            @foreach ($task as $taskContent)
                <div id="taskTitle">{{ $taskContent->title }}</div>

                <div style="display:flex;flex-direction:row;">
                    @foreach ($taskContent->categories as $categories)
                        <div
                            style="color:{{ $categories->color }};padding-left:10px;;padding-top:10px;display:flex;flex-direction:row;">
                            {{ $categories->name }}</div>
                    @endforeach
                </div>

                <div id="taskDesc">{{ $taskContent->description }}</div>

                <div class="status_endflag_container">
                    @if ($taskContent->status == 'pending')
                        <div class="statusContainer">
                            <h4 id="task_status">{{ $taskContent->status }}</h4>
                            <div class="orange_dot"></div>
                        </div>
                    @elseif ($taskContent->status == 'in_progress')
                        <div class="statusContainer">
                            <h4 id="task_status">{{ $taskContent->status }}</h4>
                            <div class="green_dot"></div>
                        </div>
                    @else
                        <div class="statusContainer">
                            <h4 id="task_status">{{ $taskContent->status }}</h4>
                            <div class="red_dot"></div>
                        </div>
                    @endif

                    <input id="endflag" name="endflag" type="checkbox">
                    <label id="endflaglabel" name="endflag">End Task</label>
                </div>

                <div>
                    @if (count($taskContent->subTask) != 0)
                        <div class="subTask">Sub Tasks</div>
                    @endif

                    @foreach ($taskContent->subtask as $sub)
                        @if ($sub->id)
                            <div id="subTaskTitle">{{ $sub->title }}</div>
                            <div id="taskDesc">{{ $sub->description }}</div>
                        @endif
                    @endforeach
                </div>

                <div class="dates">
                    <h4 id="task_Created_date">Created: {{ $taskContent->create_date }}</h4>
                    <h4 id="task_End_date">Dead Line: {{ $taskContent->deadline }}</h4>
                </div>
            @endforeach
        </div>
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

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 500px;
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

        #taskTitle {
            align-self: center;
            justify-self: center;
            color: #0099ff;
        }

        #taskDesc {
            align-self: center;
            justify-self: center;
            color: rgb(177, 177, 177);
            margin-top: 10px;
        }

        .status_endflag_container {
            display: flex;
            flex-direction: row;
        }

        #task_status {
            margin-left: 20px;
            margin-top: 10px;

            color: #4ab7ff;
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

        #endflag {
            margin-top: 11.5px;
            margin-left: 30px;
        }

        #endflaglabel {
            color: #0099ff;
            margin-top: 11.5px;
            margin-left: 10px;

        }

        .dates {
            display: flex;
            flex-direction: row;

            #task_Created_date {
                margin-left: 20px;
                margin-top: 20px;

                color: #6ac2fc;
            }

            #task_End_date {
                margin-left: 85px;
                margin-top: 20px;

                color: #fc6a6a;
            }
        }

        .subTask {
            text-align: center;

            align-self: center;
            justify-self: center;

            margin-top: 10px;
            margin-bottom: 10px;

            color: #5791b8;
        }

        #subTaskTitle {
            color: #72b3e2;
            align-self: center;
            justify-self: center;

            margin-top: 10px;
        }
    </style>
@endsection
