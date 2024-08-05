# phone
회원별 복수의 전화번호를 지원합니다. 

## profile-phone 컴포넌트
`profile-phone`는 회원별 복수의 전화번호를 관리할 수 있도록 목록을 관리하는 UI 컴포넌트 입니다.

```php
@livewire('profile-phone')
```

### 화면 주입하기
컴포넌트에 화면을 주입할 수 있습니다.

```php
@livewire('profile-phone',[
    'viewFile' => "컴포넌트 레이아웃",
    `viewList` => "목록 테이블",
    'viewForm' => "입력폼 화면"
])
```

## getUserPhone() 헬퍼함수
DB에서 지정한 사용자의 연락처 정보 목록일 읽어 오는 헬퍼함수입니다.

현재 로그인된 사용자의 연락처
```php
$rows = getUserPhone();
```

기본 설정된 값만 가지고 올경우

```php
$row = getUserPhone('checked');
```


특정 지정된 사용자의 phone 연락처 목록을 얻어 올 수 있습니다.
```php
$rows = getUserPhone(1);
```

