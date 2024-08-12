# 회원탈퇴 AuthOut

## auth-out 컴포넌트
`auth-out`는 회원 탈퇴 처리를 하는 UI 컴포넌트 입니다.
```php
@livewire('auth-out')
```

## render()
DB에 접근 후 뷰파일을 렌더링합니다.
```php
    public function render()
    {
        $user = Auth::user();

        $row = DB::table("user_outs")
            ->where('user_id', $user->id)
            ->first();
        if($row) {
            $this->member_out = true;
            $message = "회원탈퇴 절차가 진행중에 있습니다.";
        } else {
            $message = null;
        }

        $viewFile = 'jiny-profile::livewire.auth_out';
        return view($viewFile,['message'=>$message]);
    }
```
> DB에서 로그인된 유저의 id에 부합하는 user_outs 테이블의 레코드를 가져와, 
> 해당 객체 유무에 따라 메세지를 $message(로컬변수)에 할당한 뒤 
> 뷰에 배열로 전달한 후 뷰파일을 렌더링합니다.

## popupConfirm() 메서드
팝업을 띄워 랜덤 코드를 입력받습니다.

## popupConfirmClose() 메서드
팝업창을 닫습니다.

## generateRandomCode() 메서드
랜덤한 10자리의 문자를 생성합니다.
```php
    public function generateRandomCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_=+';
        $code = '';
        $length = 10;

        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randIndex = mt_rand(0, $max);
            $code .= $characters[$randIndex];
        }

        return $code;
    }
```
> popupConfirm() 메서드에서 호출합니다.

## submitConfirm() 메서드
회원 탈퇴를 신청합니다.
```php
    public function submitConfirm()
    {
        if($this->confirm_code == $this->randomCode) {
            $user = Auth::user();

            $row = DB::table("user_outs")
                ->where('user_id', $user->id)
                ->first();

            if(!$row) {
                DB::table("user_outs")->insertGetId([
                    'user_id' => $user->id,
                    'email' => $user->email,

                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

                $this->popupConfirm = false;
            } else {
                $this->error = "이미 탈퇴 신청이된 회원입니다.";
            }

        } else {
            $this->error = "확인 코드가 일치하지 않습니다.";
        }

        $this->confirm_code = null;
    }
```
> 입력한 코드와 랜덤 코드가 일치할 시 if문 실행, 불일치할 시 에러처리.
> 회원 탈퇴 '신청' 테이블인 user_outs에서 레코드를 $row로 가져옵니다.
> $row가 null일 시 insertGetId()를 통해 테이블에 배열을 넘겨줘 레코드를 삽입합니다.
> $row가 존재할시 에러 메세지 출력.

## cancelOut() 메서드
회원 탈퇴 신청을 취소합니다.
> user_outs에서 id가 일치하는 레코드를 찾아 삭제합니다.
