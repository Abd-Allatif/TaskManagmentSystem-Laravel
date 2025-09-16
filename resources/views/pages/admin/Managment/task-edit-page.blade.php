@extends('layouts.app', ['pageSlug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Edit Task</h5>
                            <h2 class="card-title">Edit {{ $task->title }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="card-content">
                    <form action="{{ route('editTaskAdmin', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="title">Task Title:</label>
                        <input placeholder="Title" id="title" name="title" type="text" class="input"
                            value="{{ $task->title }}" required="" />
                        <br><br>
                        <label for="description">Description</label>
                        <textarea name="description" placeholder="Description" id="description" class="input" required="">{{ $task->description }}</textarea>
                        <br><br>
                        <label for="deadline">Dead Line</label>
                        <input placeholder="Dead Line" id="Deadline" name="deadline" type="date" class="input"
                            value="{{ $task->deadline }}" required="" />
                        <br><br>
                        <div class="checkBox">
                            <input class="radioButton" type="radio" name="status" value="{{ 0 }}"
                                {{ $task->status == \App\enums\Status::Pending ? 'checked' : '' }}>
                            <label for="status">Pending</label>
                            <input id="in_progress" type="radio" name="status" value="{{ 2 }}"
                                {{ $task->status == \App\enums\Status::In_Progress ? 'checked' : '' }}>
                            <label for="status">In Progress</label>
                        </div>
                        <br><br>

                        <div>
                            <label>Sub tasks</label>
                            @foreach ($task->subtask as $sub)
                                <div style="padding-top: 10px;">
                                    <input placeholder="Sub Tasks" id="subtasks" name="subtasks[{{ $sub->id }}]"
                                        type="text" value="{{ $sub->description }}" class="input" required="" />
                                </div>
                            @endforeach
                        </div>

                        <div id="toggleForm" class="showSubtaskForm">
                            <button type="button" class="showFormBtn">
                                Create SubTasks
                            </button>
                        </div>

                        <div id="createSubTask" class="createSubTask">
                            <div id="subtaskList">
                                {{-- <input placeholder="New Sub Task" id="subTask" name="new_subtasks[]"
                                    type="text" class="input" /> --}}
                            </div>

                            <button type="button" id="addSubtaskBtn" class="addMoreBtn">
                                + Add Sub Task
                            </button>
                        </div>

                        @include('partials.dropDown', [
                            'cats' => $categories,
                            'id' => 'categories',
                            'label' => 'Categories',
                        ])
                        @include('partials.dropDown', [
                            'uss' => $users,
                            'id' => 'users',
                            'label' => 'Users',
                        ])

                        <input type="submit" class="button">
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                name="new_subtasks[]" 
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
@endsection

<style>
    .card {
        height: 500px !important;
    }

    .input {
        border-right: 1px solid #0099ff;
        border-left: 1px solid #0099ff;
        border-radius: 10px;

        color: aliceblue;
        align-self: center;
        justify-self: center;

        background: none;

        padding-left: 10px;

        height: 30px;
        width: 250px;

        margin-left: 20px;
    }

    #subtasks {
        width: 500px
    }

    #subTask {
        margin-bottom: 10px;
    }

    #description {
        resize: vertical;
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
        box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .button:hover {
        transform: scale(1.03);
        box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
    }

    .button:active {
        transform: scale(0.95);
        box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 5px 5px -15px;
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
</style>
