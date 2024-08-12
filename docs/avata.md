# 아바타 설정

## 아바타 이미지 출력
사용자 아바타 이미지를 출력합니다.

```php
@livewire('avata-image',['width'=>"128px"])
```

### mount() 메서드
현재 로그인된 유저의 id를 프로퍼티에 저장합니다.

### render() 메서드
DB에서 아바타 이미지를 가져와 배열로 뷰에 전달하고 뷰파일을 렌더링, 로그인되어 있지 않을 시 오류 처리.

### $listeners
Livewire에서 특정 이벤트가 발생할 때 호출될 메서드들을 정의합니다.
```php
    protected $listeners = [
        'avata-image-reflash' => 'avataImageReflash'
    ];

    #[On('avata-image-reflash')]
    public function avataImageReflash()
    {
        // 화면 갱신 호출 event
    }
```
> AvataUpdate.php의 submit()에서 'avata-image-reflash'를 발생시키면 avataImageReflash() 메서드를 실행.
> avataImageReflash()는 화면 갱신 호출 이벤트입니다.






## 아바타 이미지 변경
라이브와이어 컴포넌트를 통하여 아바타 이미지를 변경할 수 있습니다.

```php
@livewire('avata-update')
```

### mount() 메서드
현재 유저 정보를 가져와 프로퍼티에 저장

### render() 메서드
DB에 저장된 아바타 이미지를 프로퍼티에 가져와 뷰파일에 배열 형태로 전달하고, 뷰를 반환합니다.
>로그인이 되어있지 않을 경우 에러 처리

### updatedPhoto()
사용자가 업로드한 사진 파일을 처리
```php
    public function updatedPhoto()
    {
        if($this->photo) {
            $this->validate([
                'photo' => 'image|max:1024',
            ]);

            // 파일 업로드
            $filename = $this->photo->store('avatas');
            $this->filename = $filename;
        }
    }
```
> 사용자가 사진을 업로드하거나 변경했을 때 실행되는 메서드입니다.

#### validate()
파일의 유효성 검사
```php
    $this->validate([
        'photo' => 'image|max:1024',
    ]);
```
> 'image': 업로드된 파일이 이미지 형식인지 확인합니다 (예: JPEG, PNG, GIF 등).
> 'max:1024': 업로드된 파일의 최대 크기가 1024킬로바이트(1MB) 이하인지 확인합니다.
> 유효성 검사에 실패하면 Laravel이 자동으로 예외를 던져 오류 메시지를 반환합니다. 유효성 검사를 통과하면 다음 단계로 진행됩니다.

#### 파일 업로드
```php
    $filename = $this->photo->store('avatas');
    $this->filename = $filename;
```
> store() 메서드는 파일을 지정된 디렉토리('avatas')에 저장합니다.
> 파일이 저장되면 해당 파일의 경로(storage/app/avatas)가 반환됩니다.
> 이후 $this->filename(프로퍼티, 속성)에 저장되어 객체 외부에서도 파일 경로에 접근할 수 있습니다.

### updateDatabase($filename) 메서드
DB 업데이트
```php
    private function updateDatabase($filename)
    {
        $profile = DB::table('account_avata')
                    ->where('user_id',$this->user_id)
                    ->first();

        if($profile) {
            // 갱신
            DB::table('account_avata')->where('id',$this->user_id)->update([
                'image' => $filename
            ]);
        }
        // 신규삽입
        else {
            DB::table('account_avata')->insert([
                'user_id' => $this->user_id,
                'image' => $filename
            ]);
        }
    }
```
> $filename(매개변수)에 파일 경로를 받아 해당 파일로 DB를 업데이트하거나, 신규 삽입을 합니다.

### submit() 메서드
updateDatabase를 호출하여 DB를 갱신하고 화면에 새로운 이미지를 띄웁니다.
```php
    public function submit()
    {
        // DB 갱신
        $this->updateDatabase($this->filename);

        $this->dispatch('avata-image-reflash');
    }
```
> dispatch() 메서드는 특정 이벤트나 함수를 실행하는 Livewire의 내장 메서드로, 'avata-image-reflash' 이벤트를 발생시킵니다.
