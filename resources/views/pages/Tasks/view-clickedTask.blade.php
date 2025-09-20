@extends('layouts.my-layout')

@section('content')

    <head>
        <div class="AppBar">
            <div class="barTitleContainer">
                <h1 id="bartitle">Tasks</h1>
            </div>

            <div id="actions">
                @can('Edit Task')
                    @if ($task->created_by != \App\enums\CreatedBy::Admin)
                        <a id="CreateTask" href="{{ route('showEditPage', [$task->id, $task->title]) }}">Edit Task</a>
                    @endif
                @endcan
            </div>
        </div>

        <div id="BackButton">
            <button class="backButton" onclick="window.location.href='{{ route('getAllTasks') }}'">Back</button>
        </div>

        <div class="container">
            <div id="taskTitle">{{ $task->title }}</div>

            <x-auth-session-status class="text" :status="session('status')" />

            <div style="display:flex;flex-direction:row;">
                @foreach ($task->categories as $categories)
                    <div
                        style="color:{{ $categories->color }};padding-left:10px;;padding-top:10px;display:flex;flex-direction:row;">
                        {{ $categories->name }}</div>
                @endforeach
            </div>

            <div class="descriptionContainer">
                <p id="taskDesc">{{ $task->description }}</p>
            </div>

            <div class="status_endflag_container">
                @if ($task->status == \App\enums\Status::Pending)
                    <div class="statusContainer">
                        <h4 id="task_status">Pending</h4>
                        <div class="orange_dot"></div>
                    </div>
                @elseif ($task->status == \App\enums\Status::In_Progress)
                    <div class="statusContainer">
                        <h4 id="task_status">In Progress</h4>
                        <div class="green_dot"></div>
                    </div>
                @elseif ($task->status == \App\enums\Status::Completed)
                    <div class="statusContainer">
                        <h4 id="task_status">Completed</h4>
                        <div class="red_dot"></div>
                    </div>
                @else
                    <div class="statusContainer">
                        <h4 id="task_status">Expired</h4>
                        <div class="red_dot"></div>
                    </div>
                @endif
            </div>

            <form action="{{ route('EndTask', $task->id) }}" method="POST">@csrf <input id="endFlag" name="endflag"
                    value="End Task" type="submit"></form>

            @if ($task->created_by != \App\enums\CreatedBy::Admin)
                <div id="toggleForm" class="showSubtaskForm">
                    <button class="showFormBtn">
                        Create SubTasks
                    </button>
                </div>
            @endif

            <!-- Adding a Sub Task Creation to View Clicked Tasks -->
            <div id="createSubTask" class="createSubTask">
                <form action="{{ route('createSubTask', [$task->id]) }}" method="POST">
                    @csrf
                    <div id="subtaskList">
                        <input placeholder="New Sub Task" id="subTask" name="subtasks[]" type="text" class="input" />
                    </div>

                    <button type="button" id="addSubtaskBtn" class="addMoreBtn">
                        + Add More
                    </button>

                    <input type="submit" class="showFormBtn" value="Create Sub Tasks" />
                </form>

            </div>

            <div>
                @if (count($task->subTask) != 0)
                    <div class="subTask">Sub Tasks</div>
                @endif

                @foreach ($task->subtask as $sub)
                    @if ($sub->id)
                        <div id="subTaskTitle">{{ $sub->title }}</div>
                        <div id="taskDesc">{{ $sub->description }}</div>
                    @endif
                @endforeach
            </div>

            <div class="dates">
                <h4 id="task_Created_date">Created: {{ $task->create_date }}</h4>
                <h4 id="task_End_date">Dead Line: {{ $task->deadline }}</h4>
            </div>

            <form action="{{ route('StartTask', $task->id) }}" method="POST">@csrf <input class="showFormBtn"
                    name="endflag" value="Start Task" type="submit"></form>
        </div>
    </head>

    <script>
        document.getElementById("toggleForm").addEventListener("click", function() {
            let form = document.getElementById("createSubTask");

            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        });

        document.getElementById("addSubtaskBtn").addEventListener("click", function() {
            let list = document.getElementById("subtaskList");

            let div = document.createElement("div");
            div.classList.add("subtask-row");

            div.innerHTML = `
            <input 
                type="text" 
                name="subtasks[]" 
                class="input" 
                placeholder="New Sub Task"
            >
            <button type="removeBtn" class="removeBtn">✕</button>
        `;

            list.appendChild(div);

            // Remove button logic
            div.querySelector(".removeBtn").addEventListener("click", function() {
                div.remove();
            });
        });
    </script>

    <style>
        * {
            padding: 0;
            margin: 0;

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

        .createSubTask {
            display: none;
        }

        .showFormBtn {
            display: block;
            width: 30%;
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

        .text {
            align-self: center;
            justify-self: center;

            padding-top: 15px;

            color: red;
        }

        .showFormBtn:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .showFormBtn:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .addMoreBtn {
            display: block;
            width: 20%;
            font-weight: bold;
            background: linear-gradient(45deg,
                    rgb(16, 204, 211) 0%,
                    rgb(18, 114, 209) 100%);
            color: white;
            padding-block: 15px;
            margin: 20px auto;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .addMoreBtn:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .addMoreBtn:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .removeBtn {
            display: block;
            width: 5%;
            font-weight: bold;
            background: linear-gradient(45deg,
                    rgb(16, 204, 211) 0%,
                    rgb(18, 114, 209) 100%);
            color: white;
            margin: 10px auto;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        #endFlag {
            display: inline;
            width: 15%;
            height: 30px;
            font-weight: bold;
            background: linear-gradient(45deg,
                    rgb(16, 137, 211) 0%,
                    rgb(18, 177, 209) 100%);
            color: white;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;

            margin-top: 12px;
            margin-left: 15px;
        }

        #endFlag:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        #endFlag:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
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

            .barTitleContainer {
                align-self: center;
                justify-self: center;
            }

            #actions {
                position: absolute;
                left: 89%;
                align-self: center;

                #CreateTask {
                    text-decoration: none;
                    color: #0099ff;
                    font-weight: bold;
                }
            }
        }

        #bartitle {
            align-self: center;
            color: #0099ff;
        }

        .container {
            /* position: absolute;
                                                                                top: 50%;
                                                                                left: 50%;
                                                                                transform: translate(-50%, -50%); */

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
            margin: 20px;
        }

        .input {
            width: 90%;
            background: white;
            border: none;
            padding: 15px 20px;
            border-radius: 20px;
            margin-top: 15px;
            box-shadow: #cff0ff 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
        }

        .input::-moz-placeholder {
            color: rgb(170, 170, 170);
        }

        .input::placeholder {
            color: rgb(170, 170, 170);
        }

        .input:focus {
            outline: none;
            border-inline: 2px solid #12b1d1;
        }

        #taskTitle {
            align-self: center;
            justify-self: center;
            color: #0099ff;
        }

        .descriptionContainer {}

        #taskDesc {
            align-self: flex-start;
            justify-self: flex-start;
            color: rgb(177, 177, 177);
            margin-top: 10px;

            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-wrap: break-word;
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
