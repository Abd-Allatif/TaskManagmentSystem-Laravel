<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Tasks" id="taskSearch">
</form>

<div class="table-responsive">
    <table class="table" id="tasksTable">
        <thead style="color: #0099ff;">
            <tr>
                <th>Title</th>
                <th class="description">Description</th>
                <th>Create Date</th>
                <th>Dead Line</th>
                <th>Status</th>
                <th class="createdBy">Created By</th>
                <th>Category</th>
                <th>Sub Tasks</th>
                <th>Users</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td class="create_date">{{ $task->create_date }}</td>
                    <td class="create_date">{{ $task->deadline }}</td>
                    <td>
                        @if ($task->status == \App\enums\Status::Pending)
                            <div class="statusContainer">
                                <h6 id="task_status">Pending</h6>
                                <div class="orange_dot"></div>
                            </div>
                        @elseif ($task->status == \App\enums\Status::In_Progress)
                            <div class="statusContainer">
                                <h6 id="task_status">In Progress</h6>
                                <div class="green_dot"></div>
                            </div>
                        @elseif ($task->status == \App\enums\Status::Completed)
                            <div class="statusContainer">
                                <h6 id="task_status">Completed</h6>
                                <div class="red_dot"></div>
                            </div>
                        @else
                            <div class="statusContainer">
                                <h6 id="task_status">Expired</h6>
                                <div class="red_dot"></div>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if ($task->created_by == \App\enums\CreatedBy::User)
                            <h5>User</h5>
                        @else
                            <h5>Admin</h5>
                        @endif
                    </td>
                    <td>
                        @foreach ($task->categories as $category)
                            <h5>{{ $category->name }}</h5>
                        @endforeach
                    </td>
                    <td>
                        @if (count($task->subTask) == 0)
                            <h5>None</h5>
                        @else
                            @foreach ($task->subTask as $subtask)
                                <h5>-({{ $subtask->title }})</h5>
                            @endforeach
                        @endif
                    </td>
                    <td class="users">
                        @foreach ($task->users as $user)
                            <h5>-({{ $user->name }})</h5>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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


    .category {
        overflow-x: auto;
    }

    .subtask {
        overflow-x: auto;
    }

    .description {
        width: 150px;
    }

    .create_date {
        width: 100px;
    }

    .createdBy {
        width: 100px;
    }

    .users {
        width: 140px;
    }

    .orange_dot {
        background-color: orange;
        height: 10px;
        width: 10px;
        border-radius: 50%;

        margin-top: 15px;
        margin-left: 5px;
    }

    .green_dot {
        background-color: green;
        height: 10px;
        width: 10px;
        border-radius: 50%;

        margin-top: 15px;
        margin-left: 5px;
    }

    .red_dot {
        background-color: red;
        height: 10px;
        width: 10px;
        border-radius: 50%;

        margin-top: 15px;
        margin-left: 5px;
    }
</style>
