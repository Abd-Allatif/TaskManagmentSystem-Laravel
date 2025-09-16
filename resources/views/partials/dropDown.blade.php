<div class="DropDownContainer">
    <div class="dropdownCustom">
        <input hidden class="sr-only" name="state-{{ $id }}" id="state-{{ $id }}" type="checkbox" />
        <label for="state-{{ $id }}" class="trigger" data-label="{{ $label }}"></label>

        <ul class="list webkit-scrollbar" role="list" dir="auto">
            @isset($cats)
                @foreach ($cats as $category)
                    <li class="listitem" role="listitem">
                        <input type="checkbox" id="category-{{ $category->id }}" name="categories[]"
                            value="{{ $category->id }}"
                            @isset($task)
                                {{ in_array($category->id, $task->categories->pluck('id')->toArray()) ? 'checked' : '' }}
                           @endisset>
                        <label style="color:{{ $category->color }};" for="category-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </li>
                @endforeach
            @endisset

            @isset($uss)
                @foreach ($uss as $user)
                    <li class="listitem" role="listitem">
                        <input id="user-{{ $user->id }}" type="checkbox" name="users[]" value="{{ $user->id }}"
                            @isset($task)
                            {{ in_array($user->id, $task->users->pluck('id')->toArray()) ? 'checked' : '' }}
                        @endisset>
                        <label style="color:#262626" for="user-{{ $user->id }}">
                            {{ $user->name }}
                        </label>
                    </li>
                @endforeach
            @endisset
        </ul>
    </div>
</div>


<style>
    .DropDownContainer {
        width: 300px;
        margin-top: 20px;
        margin-left: 20px;
    }

    .dropdownCustom {
        border: 1px solid #c1c2c5;
        border-radius: 12px;
        transition: all 300ms;
        display: flex;
        flex-direction: column;
        min-height: 58px;
        background-color: white;
        color: #0099ff;

        overflow: hidden;
        position: relative;
        inset-inline: auto;
        width: 100%;
    }

    .dropdownCustom input:where(:checked)~.list {
        opacity: 1;
        transform: translateY(-3rem) scale(1);
        transition: all 500ms ease;
        margin-top: 32px;
        padding-top: 4px;
        margin-bottom: -32px;
    }

    .dropdownCustom input:where(:not(:checked))~.list {
        opacity: 0;
        transform: translateY(3rem);
        margin-top: -100%;
        user-select: none;
        height: 0px;
        max-height: 0px;
        min-height: 0px;
        pointer-events: none;
        transition: all 500ms ease-out;
    }

    .trigger {
        cursor: pointer;
        list-style: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        font-weight: 600;
        color: inherit;
        width: 100%;
        display: flex;
        align-items: center;
        flex-flow: row;
        gap: 1rem;
        padding: 1rem;
        height: max-content;
        position: relative;
        z-index: 99;
        border-radius: inherit;
        background-color: white;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }

    .dropdownCustom input:where(:checked)+.trigger {
        margin-bottom: 1rem;
    }

    .dropdownCustom input:where(:checked)+.trigger:before {
        rotate: 90deg;
        transition-delay: 0ms;
    }

    .dropdownCustom input:where(:checked)+.trigger::after {
        content: "Close";
        color: #262626;
    }

    .trigger:before,
    .trigger::after {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .trigger:before {
        content: "›";
        rotate: -90deg;
        width: 17px;
        height: 17px;
        color: #262626;
        border-radius: 2px;
        font-size: 26px;
        transition: all 350ms ease;
        transition-delay: 85ms;
    }

    .trigger::after {
        content: attr(data-label);
        color: #262626;
    }

    .list {
        height: 100%;
        max-height: 20rem;
        width: calc(100% - calc(var(--w-scrollbar) / 2));
        display: grid;
        grid-auto-flow: row;
        overflow: hidden auto;
        gap: 1rem;
        padding: 0 1rem;
        margin-right: -8px;
        --w-scrollbar: 8px;
    }

    .listitem {
        height: 100%;
        width: calc(100% + calc(calc(var(--w-scrollbar) / 2) + var(--w-scrollbar)));
        list-style: none;
    }

    .article {
        padding: 1rem;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        text-align: justify;
        width: 75%;
        border: 1px solid #c1c2c5;
        display: inline-block;
        background-color: white;
    }

    .webkit-scrollbar::-webkit-scrollbar {
        width: var(--w-scrollbar);
        height: var(--w-scrollbar);
        border-radius: 9999px;
    }

    .webkit-scrollbar::-webkit-scrollbar-track {
        background: #0000;
    }

    .webkit-scrollbar::-webkit-scrollbar-thumb {
        background: #0000;
        border-radius: 9999px;
    }

    .webkit-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #c1c2c5;
    }
</style>
