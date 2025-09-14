<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Users" id="userSearch">
</form>
<table class="table" id="usersTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th class="text-center">Tasks Count</th>
            @isset($pageSlug)
                @if ($pageSlug == 'user-managment')
                    <th>Edit</th>
                    <th>Delete</th>
                @endif
            @endisset
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @isset($user->roles)
                        @foreach ($user->roles as $role)
                            <h5>{{ $role->name }}</h5>
                        @endforeach
                    @endisset
                </td>
                <td class="text-center">{{ $user->tasks->count() }}</td>
                @isset($pageSlug)
                    @if ($pageSlug == 'user-managment')
                        <td> <a href="{{ route('userEditShow', $user->id) }}" id="pencilIcon"
                                class="tim-icons icon-pencil"></a></td>
                        <td>
                            <form action="{{ route('deleteUser', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete"><span id="basketIcon" class="tim-icons icon-basket-simple"></button>
                            </form>
                        </td>
                    @endif
                @endisset
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .form {
        align-self: center;
        justify-self: center;
    }

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

    #pencilIcon {
        cursor: pointer;
    }

    #pencilIcon {
        color: honeydew;
    }

    #pencilIcon:hover {
        color: #0099ff;
    }

    .delete {
        background: none;
        border: none;

        cursor: pointer;
    }

    #basketIcon {
        color: honeydew;
        cursor: pointer;
    }

    #basketIcon:hover {
        color: red;
    }
</style>
