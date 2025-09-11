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
                <th class="createdBy">Created By</th>
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
        width: 200px;
    }

    .createdBy {
        width: 100px;
    }
</style>



