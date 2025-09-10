<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Create Date</th>
            <th>Dead Line</th>
            <th>Created By</th>
            <th>Category</th>
            <th>Sub Tasks</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->create_date }}</td>
                <td>{{ $task->deadline }}</td>
                <td>{{ $task->created_by }}</td>
                <td class="category">
                    @foreach ($task->categories as $category)
                        <h5>{{ $category->name }}</h5>
                    @endforeach
                </td>
                <td class="subtask">
                    @foreach ($task->subTask as $subtask)
                        <h5>[{{ $subtask->title }}]</h5>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .category {
        overflow-x: auto;
    }

    .subtask {
        overflow-x: auto;
    }
</style>
