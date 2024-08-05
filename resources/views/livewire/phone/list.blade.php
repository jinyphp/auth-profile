<table class="w-100 mb-4">
    <tbody>
        @foreach ($rows as $item)
            <tr class="w-100 border-bottom">
                <td class="p-2" width="50px">
                    {{$item->type}}
                </td>
                <td class="p-2" width="50px">
                    {{$item->country}}
                </td>
                <td class="p-2" >
                    <x-click wire:click="edit({{$item->id}})">
                        <div>{{$item->number}}</div>
                    </x-click>
                </td>
                <td width="100px">
                    @if($item->selected)
                        <x-badge-primary class="cursor-pointer"
                            wire:click="selected({{$item->id}})">
                            default
                        </x-badge-primary>
                    @else
                        <x-badge-secondary class="cursor-pointer"
                            wire:click="selected({{$item->id}})">
                            default
                        </x-badge-secondary>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
