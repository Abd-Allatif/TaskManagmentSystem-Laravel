@extends('layouts.app', ['pageSlug' => 'edit-User'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Admin Profile</h5>
                            @isset($admin)
                                <h2 class="card-title">{{ $admin->name }}</h2>
                            @endisset
                            <h3 class="text"> {{session('status')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="card-content">
                    <form action="{{ route('edit.adminProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        @isset($admin)
                            <label for="name">Name:</label>
                            <input type="text" class="EditInput" value="{{ $admin->name }}" name="name" required>
                            <br><br>
                            <label for="email">Email:</label>
                            <input type="text" class="EditInput" value="{{ $admin->email }}" name="email" required>
                            <br><br>
                            <label for="oldPassword">Old Password</label>
                            <input type="password" class="EditInput" name="oldPassword" required>
                            <br><br>
                            <label for="newPassword">New Password</label>
                            <input type="password" class="EditInput" name="newPassword" required>
                        @endisset
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

    .text{
        margin-top: 20px;
        margin-left: 20px;
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
