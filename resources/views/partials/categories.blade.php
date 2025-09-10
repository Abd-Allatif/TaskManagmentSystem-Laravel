<table class="table">
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
    .colorContainer{
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
