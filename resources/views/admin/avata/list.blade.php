<x-wire-table>
    <x-wire-thead>
        {{-- 테이블 제목 --}}
        <th width='100'>사용자</th>
        <th>이미지/설명</th>

        <th width='200'>등록일자</th>

    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            <x-wire-tbody-item :selected="$selected" :item="$item">
                {{-- 테이블 리스트 --}}
                <td width='100'>
                    {{ $item->user_id }}
                </td>
                <td>
                    {{-- {!! $popupEdit($item, $item->title) !!} --}}
                    <x-link-void wire:click="edit({{$item->id}})">
                        {{$item->image}}
                    </x-link-void>
                    {{$item->description}}
                </td>

                <td width='200'>
                    {{ $item->created_at }}
                </td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>
