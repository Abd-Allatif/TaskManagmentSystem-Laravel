@extends('layouts.app', ['pageSlug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Create Task</h5>
                            <h2 class="card-title">Create New Task</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="card-content">
                    <form action="{{ route('createTask') }}" method="POST">
                        @csrf
                        <label for="title">Task Name:</label>
                        <input placeholder="Title" id="title" name="title" type="text" class="input"
                            required="" />
                        <br><br>
                        <label for="description">Description</label>
                        <textarea name="description" placeholder="Description" id="description" cols="7" rows="7" class="input"
                            required=""></textarea>
                        <br><br>
                        <label for="deadline">Dead Line</label>
                        <input placeholder="Dead Line" id="Deadline" name="deadline" type="date" class="input"
                            value="{{ $deadline }}" required="" />
                        <br><br>
                        <div class="checkBox">
                            <input class="radioButton" type="radio" name="status" value="{{ 0 }}" checked>
                            <label for="status">Pending</label>
                            <input id="in_progress" type="radio" name="status" value="{{ 2 }}">
                            <label for="status">In Progress</label>
                        </div>
                        <br><br>
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
</style>
