<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Admin" id="adminSearch">
</form>
<table class="table" id="adminTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            @isset($pageSlug)
                @if ($pageSlug == 'admins')
                    @can('Edit Admins')
                        <th>Edit</th>
                    @endcan
                    @can('Delete Admins')
                        <th>Delete</th>
                    @endcan
                @endif
            @endisset
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @isset($admin->roles)
                        @foreach ($admin->roles as $role)
                            <h5>{{ $role->name }}</h5>
                        @endforeach
                    @endisset
                </td>
                @isset($pageSlug)
                    @if ($pageSlug == 'admins')
                        @can('Edit Admins')
                            <td> <a href="{{ route('adminEditPage', $admin->id) }}" id="pencilIcon"
                                    class="tim-icons icon-pencil"></a>
                            </td>
                        @endcan
                        @can('Delete Admins')
                            <td>
                                <form action="{{ route('deleteAdmin', $admin->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete"><span id="basketIcon" class="tim-icons icon-basket-simple"></button>
                                </form>
                            </td>
                        @endcan
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
