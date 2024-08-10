# email
회원별 이메일을 관리합니다. 

## profile-email 컴포넌트
`profile-email`는 회원의 이메일을 수정할 수 있도록 하는 UI 컴포넌트 입니다.
```php
@livewire('profile-email')
```

## mount() 메서드
라이브와이어 생성자. livewire 처음 로딩될 때 한 번만 실행.
```php
    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        if($this->user_id) {
            $row = DB::table('users')
            ->where('id',$this->user_id)
            ->first();

            if($row) {
                $this->row_id = $row->id;
                $this->form = get_object_vars($row);
            }
        }
    }
```
>'users' 테이블의 레코드를 가져와, 배열의 형태로 $this->form에 저장합니다.

## render() 메서드
뷰파일을 반환합니다.

## submit() 메서드
폼에 입력받은 이메일 주소를 DB에 업데이트합니다.
```php
    public function submit()
    {
        $form =  $this->form;
        if($this->row_id) {
            DB::table('users')
                ->where('id',$this->user_id)
                ->update($form);
        }
    }
```
