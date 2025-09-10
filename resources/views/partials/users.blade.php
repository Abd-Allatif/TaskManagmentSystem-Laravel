<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th class="text-center">Tasks Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">{{ $user->tasks->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
