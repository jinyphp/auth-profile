<div>
@once
    @push('css')
    <style>
        .avata {
            width: {{$width}};
            height: {{$width}};
            overflow: hidden;
            position: relative;
        }
        .avata img {
            width: auto;
            height: 100%;
            object-fit: none;
            object-position: center;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
    @endpush
@endonce

    @if($profile && $profile->image)
    {{-- /account/ --}}
        <img src="{{$profile->image}}"
            class="avata @if($rounded) rounded-circle @endif"/>
    @else
        <div class="avata @if($rounded) rounded-circle @endif bg-gray-300"/>

        </div>
    @endif
</div>
