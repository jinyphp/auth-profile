# 페스워드
비밀번호를 변경할 수 있는 컴포넌트 입니다.
```php
@livewire("profile-password")
```

## mount()
Livewire의 생성자. 뷰파일을 프로퍼티에 지정합니다.

## render()
뷰를 반환합니다.
> 프로퍼티인 status가 true일 시 success.blade를, false일 시 password.blade를 반환합니다.

## submit()
사용자 비밀번호를 변경합니다.
> 기존 비밀번호, 신규 비밀번호, 확인 비밀번호의 형식을 확인 후 신규 비밀번호와 확인 비밀번호의 일치 여부, 기존 비밀번호의 일치 여부를 확인합니다.

### 기존 비밀번호 

#### 입력 확인
```php
    $form = $this->form;
    if(!isset($form['old']) || !$form['old']) {
        $this->message['old'] = "기존 비밀번호를 입력해 주세요.";
        return false;
    }
```
> isset($form['old']): 기존 비밀번호 필드가 존재하는지 확인합니다.
> !$form['old']: 비밀번호 필드가 비어 있는지 확인합니다.
> 조건을 만족하지 못하면, 오류 메세지를 설정하고 false를 반환 후 함수를 종료합니다.

#### 입력한 기존 비밀번호 형식 확인
```php
    $type = $this->checkTypePassword($form['old']);
    if(!is_bool($type) || !$type) {
        $this->message['old'] = $type;
        return false;
    }
```
> checkTypePassword는 에러 메세지 또는 True를 반환.
> 이를 로컬 변수 $type에 저장해 먼저 boolean 값인지 확인하고,
> false가 아닌지 검사합니다.
> 조건을 만족하지 못하면 오류 메세지를 설정($this->message의 'old'키에 $type의 값 저장) 후 false를 반환하여 함수를 종료합니다.

### 신규 비밀번호 
#### 입력 확인
#### 입력한 신규 비밀번호 형식 확인
> 위와 동일

### 확인 비밀번호
#### 입력 확인
#### 입력한 확인 비밀번호 형식 확인
> 위와 동일

### 신규 비밀번호와 확인 비밀번호 일치 확인
> 신규 비밀번호와 확인 비밀번호가 일치하지 않을 시, 에러 메세지를 띄우고 재입력을 위한 팝업을 띄우며 함수를 종료합니다.

### 기존 비밀번호 일치 확인
> 기존 비밀번호와 일치한다면 $this->verification을 true로,
> 일치하지 않는다면 $this->error에 에러 메세지를 저장합니다.

###
위의 조건을 모두 만족했다면 
```php
    $this->status = true;
```
설정 후 함수를 종료합니다.

## checkTypePassword($password)
입력받은 비밀번호가 유효한지 검사합니다.
> php의 내장함수들로 8자 이상 20자 이하인지, #@! 중 하나라도 포함했는지, 대문자 알파벳이 포함되었는지 등을 확인 후
> 조건에 맞지 않을 경우 에러 '메세지'를, 모두 부합할 경우 true를 반환합니다.

## popupPasswordClose()
팝업창을 닫습니다.

## submitConfirm()
새로운 비밀번호를 DB에 업데이트합니다.(비밀번호 변경 완료)
```php
    public function submitConfirm()
    {
        $this->popupPassword = false;

        if($this->verification) {
            $user = Auth::user();
            DB::table('users')
                    ->where('id',$user->id)
                    ->update([
                        'password' => Hash::make($this->form['new'])
                    ]);

            $this->form = [];
            $this->success = "비밀번호가 성공적으로 변경되었습니다.";
        }

        $this->verification = false;
    }
```
> 인증에 성공했을 시, DB의 users 테이블에 접근하여 새로운 비밀번호를 해시한 값으로 password 키의 값을 업데이트합니다.
> Hash::make()는 비밀번호를 안전하게 해시하는 Laravel의 내장 메서드로, 해시된 비밀번호는 복호화할 수 없으며, 비교할 때만 사용됩니다.

## checkOldPassword($password) 매서드
DB에 저장된 이전 비밀번호와 사용자가 입력한 비밀번호가 일치하는지 확인
```php
    private function checkOldPassword($password)
    {
        // 사용자가 입력한 비밀번호
        $userInputPassword = $password;

        // 데이터베이스에서 저장된 해시된
        $user = Auth::user();
        $hashedPassword = $user->password; // 예시로 나타냄

        // 비교
        if (Hash::check($userInputPassword, $hashedPassword)) {
            // 비밀번호가 일치하는 경우
            // 로그인 성공 처리
            return true;
        }

        // 비밀번호가 일치하지 않는 경우
        // 로그인 실패 처리
        return false;
    }
```
> $userInputPassword에 사용자가 입력한 비밀번호,
> $hashedPassword는 submitConfirm()에서 해시 처리된 비밀번호.
> Hash::check()로 $userInputPassword와 $hashedPassword의 원래 비밀번호가 일치하는지 확인 후 True or False 반환.
