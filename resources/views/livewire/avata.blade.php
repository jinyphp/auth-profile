<div>
    <x-loading-indicator/>

    <div class="row">

        <div class="col-2">
            @if($profile && $profile->image)
                <x-avata src="/account/{{$profile->image}}"/>
            @else

            @endif
        </div>
        <div class="col-10">
            <div class="mb-3">
                <label for="fileInput" class="form-label">이미지</label>
                <input type="file" class="form-control" id="fileInput" name="photo" wire:model="photo">
                <small>사용 가능한 형식은  *.jpeg, *.jpg, *.png, *.gif 으로 최대 4MB 사이즈로 제한됩니다.</small>
            </div>
            <div class="mt-4">
                {{-- <button class="btn btn-primary me-2">업로드</button> --}}
            </div>
        </div>
    </div>




    {{-- @pushOnce('scripts')
    <!-- 파일 업로드 아이콘 클릭 시 파일 선택 창 표시 -->
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            // 파일 선택 시 실행할 작업을 여기에 추가할 수 있습니다.
            console.log('Avata 파일이 선택되었습니다.');
        });
    </script>
    @endPushOnce --}}

</div>
