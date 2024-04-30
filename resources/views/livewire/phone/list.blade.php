<table class="w-100 mb-4">
    <tbody>
        @foreach ($rows as $item)
            <tr class="w-100 border-bottom">
                <td class="p-2" width="50">
                    @if($parent['phone_id'] == $item['id'])

                    <button class="bg-info d-flex justify-content-center align-items-center w-5 h-5 text-white rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                        </svg>
                    </button>

                    @else

                    <button class="bg-secondary d-flex justify-content-center align-items-center w-5 h-5 text-white rounded-circle"
                        wire:click="apply({{$item['id']}})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                        </svg>
                    </button>
                    @endif
                </td>
                <td class="p-2" width="50px">
                    {{$item['type']}}
                </td>
                <td class="p-2" width="50px">
                    {{$item['country']}}
                </td>
                <td class="p-2" >
                    <x-click wire:click="edit({{$item['id']}})">
                        <div>{{$item['number']}}</div>
                    </x-click>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
