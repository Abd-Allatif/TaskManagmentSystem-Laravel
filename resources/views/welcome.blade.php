<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
        </style>
    @endif
</head>

<body class="tw-bg-[#FDFDFC] tw-text-[#0099ff] tw-flex tw-p-6 tw-items-center tw-flex-col">
    <header class="w-full text-sm">
        @if (Route::has('login'))
            <nav class="tw-flex tw-items-center tw-justify-end tw-gap-4">
                @auth
                    <a href="{{ route('getAllTasks') }}"
                        class="tw-inline-block tw-px-5 tw-py-1.5 tw-border text-[#0099ff] tw-rounded-sm tw-text-sm">
                        Tasks
                    </a>
                    {{-- <form action="{{route('logout')}}" method="POST">
                    <input value="Logout" class="tw-inline-block tw-px-5 tw-py-1.5 tw-border text-[#0099ff] tw-rounded-sm tw-text-sm" type="submit">
                </form> --}}
                @else
                    <a href="{{ route('admin-login') }}"
                        class="tw-inline-block tw-px-5 tw-py-1.5 tw-border text-[#0099ff] tw-rounded-sm tw-text-sm">
                        Admin
                    </a>

                    <a href="{{ route('login') }}"
                        class="tw-inline-block tw-px-5 tw-py-1.5 tw-border text-[#0099ff] tw-rounded-sm tw-text-sm">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="tw-inline-block tw-px-5 tw-py-1.5 tw-border text-[#0099ff] tw-rounded-sm tw-text-sm">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div class="conatiner">
        <h1 class="text1">Wlecome to Task Management System!</h1>
        <ul>
            <li class="text">Reliable Auth System</li>
            <li class="text">Verification Emails</li>
            <li class="text">Easy Password Reset</li>
            <li class="text">View and Manage Your Tasks With Ease</li>
            <li class="text">View Categories & Related Tasks That Are Managed From Your Admin</li>
            <li class="text">Automated Emails When Tasks Reached Dead Line</li>
            <li class="text">Modern Dashboard For Easy Database Management</li>
            <li class="Laravel12">Built with Laravel 12</li>
        </ul>
    </div>

    <style>
        .conatiner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 450px;
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

        .welcomeText {
            color: lightskyblue;

            text-align: center;
            justify-self: center;

            font-size: 25px;
        }

        .text {
            color: gray;
            margin-top: 10px;

            font-size: 15px;
        }

        .text1 {
            color: lightskyblue;
            margin-top: 10px;

            text-align: center;

            font-size: 25px;
        }

        .Laravel12 {
            color: red;
            margin-top: 10px;

            text-align: center;

            font-size: 15px;
        }

        .Discover {
            color: lightskyblue;
            margin-top: 10px;
            font-size: 15px;
        }
    </style>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
