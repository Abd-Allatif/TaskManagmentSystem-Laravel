@extends('layouts.app', ['pageSlug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Edit Category</h5>
                            <h2 class="card-title">Edit {{$category->name}}</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="card-content">
                    <form action="{{ route('editcategory',$category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name">Category Name:</label>
                        <input type="text" class="EditInput" name="name" value="{{$category->name}}">
                        <br><br>
                        <label for="color">Color</label>
                        <input type="color" class="checkboxes" name="color" value="{{$category->color}}">
                        <br><br>
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

    .EditInput {
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

    .checkboxes {
        transform: scale(1.3);
        margin-left: 15px;
        align-self: center;
    }

    .Roles {
        margin-top: 20px;
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
