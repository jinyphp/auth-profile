# Social
다양한 소셜 링크를 지정합니다.

## profile-social 컴포넌트
```php
@livewire('profile-social')
```

## mount() 메서드
라이브와이어 생성자. livewire 처음 로딩될 때 한 번만 실행.
```php
    if($this->user_id) {
        $row = DB::table('account_social')
        ->where('user_id',$this->user_id)
        ->first();

        if($row) {
            $this->row_id = $row->id;
            $this->form = get_object_vars($row);
        } else {
            $this->form['user_id'] = $user->id;
        }
    } else {
        $this->form['user_id'] = $user->id;
    }
```
>account_social 테이블의 로우를 가져와 배열로 $this->form에 저장하거나, 현재 저장된 로우가 없다면 form 배열의 'user_id' 키에 $user->id 값을 넣어줍니다.

## render() 메서드
뷰파일을 지정합니다.

## submit() 메서드
입력받은 소셜 링크를 DB에 업데이트하거나 새로 저장합니다.
```php
    public function submit()
    {
        $form =  $this->form;
        if($this->row_id) {
            DB::table('account_social')
                ->where('id',$this->user_id)
                ->update($form);
        } else {
            $form['user_id'] = $this->user_id;
            DB::table('account_social')
                ->insert($form);
        }
    }
```
