@extends('layouts.my-layout')

@section('content')

    <head>
        <div class="AppBar">
            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">@csrf <input class="logoutBtn" type="submit" value="Logout">
                </form>
            </div>

            <div class="barTitleContainer">
                <h1 id="bartitle">{{ $userName }}s Tasks</h1>
            </div>

            <div id="actions">
                @can('Create Task')
                    <a id="CreateTask" href="{{ route('createTaskUser') }}">Create Task</a>
                @endcan
            </div>
        </div>

        @can('View Category')
            <div class="Categories">
                <ul class="categoryList">
                    <div>
                        <h3 id="CategoryH4">Categories</h3>
                        <div class="categoriesList">
                            @foreach ($categories as $category)
                                <button class="categoryBtn" style="color: {{ $category->color }}"
                                    onClick="window.location.href='{{ route('getClickedCategory', [$category->id, $category->name]) }}'">
                                    {{ $category->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </ul>
            </div>
        @endcan

        <form class="form" method="POST" action="{{ route('searchTask') }}">
            @csrf

            <button>
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-labelledby="search">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>

            <input class="input" name="searchQuery" id="searchQuery" placeholder="Search" required="" type="text">

            <button class="reset" type="reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="submitContainer">
                <input type="submit" class="searchButton" value="Search">
            </div>
        </form>

        <x-auth-session-status class="text" :status="session('status')" />

        <div class="container">
            @can('view Task')
                <ul class="taskList">
                    @foreach ($tasks as $task)
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

                                <div class="dates">
                                    <h4 id="task_Created_date">Created: {{ $task->create_date }}</h4>
                                    <h4 id="task_End_date">Dead Line: {{ $task->deadline }}</h4>
                                </div>

                                <div id="aboutTask">
                                    <button class="button"
                                        onclick="window.location.href='{{ route('getClickedTask', [$task->id, $task->title]) }}'">View
                                        Details</button>
                                </div>
                        </li>
                    @endforeach
                    {{ $tasks->links('pagination::default') }}
                </ul>
            @endcan
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

            .barTitleContainer {
                align-self: center;
                justify-self: center;
            }

            #bartitle {
                align-self: center;
                color: #0099ff;
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

            .logout {
                position: absolute;
                right: 89%;
                align-self: center;

                .logoutBtn {
                    border: none;
                    background: none;
                    text-decoration: none;
                    color: #0099ff;
                    font-weight: bold;

                    cursor: pointer;
                }
            }
        }

        .Categories {
            position: absolute;

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

        .categoriesList {
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            direction: rtl;
            width: 100px;
            height: 250px;
            margin-top: 20px;
            padding: 10px;
        }

        #CategoryH4 {
            color: #0099ff;
            padding-top: 15px;
            padding-left: 15px;
        }

        .categoryBtn {
            margin-left: 20px;
            margin-top: 20px;
            padding: 5px;
            cursor: pointer;
            background: none;
            border: none;
            border-radius: 10px;
        }

        .categoryBtn:hover {
            background: #c0e6ff;
        }


        /* From Uiverse.io by satyamchaudharydev */
        /* From uiverse.io by @satyamchaudharydev */
        /* removing default style of button */

        .form button {
            border: none;
            background: none;
            color: #8b8ba7;
        }

        .text {
            align-self: center;
            justify-self: center;

            padding-top: 15px;

            color: red;
        }


        /* styling of whole input container */
        .form {
            --timing: 0.3s;
            --width-of-input: 200px;
            --height-of-input: 40px;
            --border-height: 2px;
            --input-bg: #f0f0f0;
            --border-color: #0099ff;
            --border-radius: 30px;
            --after-border-radius: 1px;
            position: relative;
            width: var(--width-of-input);
            height: var(--height-of-input);
            display: flex;
            align-items: center;
            padding-inline: 0.8em;
            border-radius: var(--border-radius);
            transition: border-radius 0.5s ease;
            background: var(--input-bg, #fff);

            align-self: center;
            justify-self: center;

            margin-top: 25px;
        }

        /* styling of Input */
        .input {
            font-size: 0.9rem;
            background-color: transparent;
            width: 150px;
            height: 100%;
            padding-inline: 0.5em;
            padding-block: 0.7em;
            border: none;
        }

        /* styling of animated border */
        .form:before {
            content: "";
            position: absolute;
            background: var(--border-color);
            transform: scaleX(0);
            transform-origin: center;
            width: 100%;
            height: var(--border-height);
            left: 0;
            bottom: 0;
            border-radius: 1px;
            transition: transform var(--timing) ease;
        }

        /* Hover on Input */
        .form:focus-within {
            border-radius: var(--after-border-radius);
        }

        input:focus {
            outline: none;
        }

        /* here is code of animated border */
        .form:focus-within:before {
            transform: scale(1);
        }

        /* styling of close button */
        /* == you can click the close button to remove text == */
        .reset {
            border: none;
            background: none;
            opacity: 0;
            visibility: hidden;
        }

        /* close button shown when typing */
        input:not(:placeholder-shown)~.reset {
            opacity: 1;
            visibility: visible;
        }

        /* sizing svg icons */
        .form svg {
            width: 17px;
            margin-top: 3px;
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
            margin: 20px;

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
            box-shadow: #85bdd7e0 0px 23px 10px -20px;
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
