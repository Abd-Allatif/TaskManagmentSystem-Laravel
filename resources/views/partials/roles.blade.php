<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Roles" id="rolesSearch">
</form>
<table class="table" id="rolesTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Guard</th>
            <th class="text-center">Users Count</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach ($role->Permissions as $permission)
                        <h5>{{ $permission->name }}</h5>
                    @endforeach
                </td>
                <td>{{$role->guard_name}}</td>
                <td class="text-center">{{ $role->users->count() }}</td>
                <td> <a href="{{route('roleEditPage',$role->id)}}" id="pencilIcon" class="tim-icons icon-pencil"></a>
                </td>
                <td>
                    <form action="{{route('deleteRole',$role->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="guard" value="{{$role->guard_name}}">
                        <button class="delete"><span id="basketIcon" class="tim-icons icon-basket-simple"></button>
                    </form>
                </td>
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
