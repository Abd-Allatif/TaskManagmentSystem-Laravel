<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Categories" id="categorySearch">
</form>
<table class="table" id="categoriesTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th class="text-center">Tasks Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <div class="colorContainer">{{ $category->color }} <div class="dot"
                            style="background-color: {{ $category->color }};"></div>
                    </div>
                </td>
                <td class="text-center">{{ $category->tasks->count() }}</td>
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

    .colorContainer {
        display: flex;
        flex-direction: row;
    }

    .dot {
        display: block;
        height: 10px;
        width: 10px;
        border-radius: 50%;

        margin-left: 5px;
        margin-top: 5px;
    }
</style>
