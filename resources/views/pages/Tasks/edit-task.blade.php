@extends('layouts.my-layout')


@section('content')
    <div class="container">
        <x-auth-session-status class="text" :status="session('status')" />

        <form class="form" method="POST" action="{{ route('editTask', [$task->id, $userId]) }}">
            @csrf
            @method('PUT')

            <div>
                <input placeholder="Title" id="title" name="title" type="text" value="{{ $task->title }}"
                    class="input" required="" />
            </div>

            <div>
                <textarea name="description" placeholder="Description" id="description" cols="7" rows="7" class="input"
                    required=""> {{ $task->description }}</textarea>
            </div>

            <div>
                <label class="deadlineLabel" for="deadline">Dead Line</label>
                <input placeholder="Dead Line" id="Deadline" name="deadline" type="date" value="{{ $task->deadline }}"
                    class="input" required="" />
            </div>

            <div class="checkBox">
                <input type="radio" name="status" value="pending" {{ $task->status == 'pending' ? 'checked' : '' }}>
                <label for="status">Pending</label>
                <input id="in_progress" type="radio" name="status" value="in_progress"
                    {{ $task->status == 'in_progress' ? 'checked' : '' }}>
                <label for="status">In Progress</label>
            </div>

            <div>
                <div class="dropdown">
                    <input hidden="" class="sr-only" name="state-dropdown" id="state-dropdown" type="checkbox" />
                    <label aria-label="dropdown scrollbar" for="state-dropdown" class="trigger"></label>

                    <ul class="list webkit-scrollbar" role="list" dir="auto">
                        @foreach ($categories as $category)
                            <li class="listitem" role="listitem">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ in_array($category->id, $task->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label style="color:{{ $category->color }};"
                                    for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @foreach ($task->subtask as $sub)
                <input placeholder="Sub Tasks" id="subtasks" name="subtasks[{{ $sub->id }}]" type="text"
                    value="{{ $sub->description }}" class="input" required="" />
            @endforeach

            <input type="submit" class="CreateTask" />
        </form>
    </div>

    <style>
        .text {
            color: grey;
        }

        .editSubTask {
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
            width: 30%;
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

        .container {
            /* position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%); */

            align-self: center;
            justify-self: center;

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

        /* From Uiverse.io by ilkhoeri */
        .dropdown {
            border: 1px solid #c1c2c5;
            border-radius: 12px;
            transition: all 300ms;
            display: flex;
            flex-direction: column;
            min-height: 58px;
            background-color: white;
            color: #0099ff;

            overflow: hidden;
            position: relative;
            inset-inline: auto;
            width: 100%;
            margin-top: 20px;
        }

        .dropdown input:where(:checked)~.list {
            opacity: 1;
            transform: translateY(-3rem) scale(1);
            transition: all 500ms ease;
            margin-top: 32px;
            padding-top: 4px;
            margin-bottom: -32px;
        }

        .dropdown input:where(:not(:checked))~.list {
            opacity: 0;
            transform: translateY(3rem);
            margin-top: -100%;
            user-select: none;
            height: 0px;
            max-height: 0px;
            min-height: 0px;
            pointer-events: none;
            transition: all 500ms ease-out;
        }

        .trigger {
            cursor: pointer;
            list-style: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            font-weight: 600;
            color: inherit;
            width: 100%;
            display: flex;
            align-items: center;
            flex-flow: row;
            gap: 1rem;
            padding: 1rem;
            height: max-content;
            position: relative;
            z-index: 99;
            border-radius: inherit;
            background-color: white;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        .dropdown input:where(:checked)+.trigger {
            margin-bottom: 1rem;
        }

        .dropdown input:where(:checked)+.trigger:before {
            rotate: 90deg;
            transition-delay: 0ms;
        }

        .dropdown input:where(:checked)+.trigger::after {
            content: "Close";
        }

        .trigger:before,
        .trigger::after {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .trigger:before {
            content: "›";
            rotate: -90deg;
            width: 17px;
            height: 17px;
            color: #262626;
            border-radius: 2px;
            font-size: 26px;
            transition: all 350ms ease;
            transition-delay: 85ms;
        }

        .trigger::after {
            content: "Categories";
        }

        .list {
            height: 100%;
            max-height: 20rem;
            width: calc(100% - calc(var(--w-scrollbar) / 2));
            display: grid;
            grid-auto-flow: row;
            overflow: hidden auto;
            gap: 1rem;
            padding: 0 1rem;
            margin-right: -8px;
            --w-scrollbar: 8px;
        }

        .listitem {
            height: 100%;
            width: calc(100% + calc(calc(var(--w-scrollbar) / 2) + var(--w-scrollbar)));
            list-style: none;
        }

        .article {
            padding: 1rem;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            text-align: justify;
            width: 75%;
            border: 1px solid #c1c2c5;
            display: inline-block;
            background-color: white;
        }

        .webkit-scrollbar::-webkit-scrollbar {
            width: var(--w-scrollbar);
            height: var(--w-scrollbar);
            border-radius: 9999px;
        }

        .webkit-scrollbar::-webkit-scrollbar-track {
            background: #0000;
        }

        .webkit-scrollbar::-webkit-scrollbar-thumb {
            background: #0000;
            border-radius: 9999px;
        }

        .webkit-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #c1c2c5;
        }


        #description {
            resize: vertical;
        }

        .form {
            margin-top: 20px;
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

        .forgot-password {
            display: block;
            margin-top: 10px;
            margin-left: 10px;
        }

        #createAccount {
            margin-top: 10px;
            margin-left: 45%;
        }

        .forgot-password a {
            font-size: 11px;
            color: #0099ff;
            text-decoration: none;
        }

        .CreateTask {
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

        .CreateTask:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .CreateTask:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }

        .checkBox {
            margin-top: 17px;
            margin-left: 7px;

            color: #0099ff;
        }

        .deadlineLabel {
            margin-left: 13px;
            color: #0099ff;
        }
    </style>
@endsection
