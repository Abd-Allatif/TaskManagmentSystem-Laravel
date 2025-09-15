<form class="form" onsubmit="return false;">
    <input class="SearchInput" type="text" placeholder="Search Categories" id="categorySearch">
</form>
<table class="table" id="categoriesTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th class="text-center">Tasks Count</th>
            @isset($pageSlug)
                @if ($pageSlug == 'category')
                    <th>Edit</th>
                    <th>Delete</th>
                @endif
            @endisset
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
                @isset($pageSlug)
                    @if ($pageSlug == 'category')
                        <td> <a href="{{route('categoryEditPage',$category->id)}}" id="pencilIcon" class="tim-icons icon-pencil"></a></td>
                        <td>
                            <form action="{{route('deleteCategory',$category->id)}}" method="POST">
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
    .form{
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
