<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Users" id="userSearch">
</form>
<table class="table" id="usersTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th class="text-center">Tasks Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">{{ $user->tasks->count() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .SearchInput {
        border-right: 1px solid #0099ff;
        border-left: 1px solid #0099ff;
        border-radius: 30px;

        color: aliceblue;
        align-self: center;
        justify-self: center;

        background: none;

        padding-left: 10px;

        height: 30px;

    }

    .SearchInput:focus {
        outline: #0099ff;
        background: none;
        box-shadow: 0 0 4px #0099ff55;
    }
</style>
