# home
가입된 회원 로그인의 사용자 화면 입니다.

## 리소스
`home.index` 화면을 기준으로 합니다.

## profile-status
회원의 간략한 상태정보를 출력할 수 있는 라이브와이어 컴포넌트 입니다.

```php
@livewire('profile-status',[
    'viewFile' => "화면"
])
```

## 아바타 이미지
회원 정보의 아바타를 출력 합니다.

```php
@livewire('avata-image',[
    'width'=>"128px"
])
```

`$user_id` : 
특정회원의 아이디를 지정하여 출력할 수 있습니다.
값이 없는 경우에는 로그인된 회원 정보를 기준으로 합니다.








