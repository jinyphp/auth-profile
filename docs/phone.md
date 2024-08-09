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

## mount() 메소드
라이브와이어 생성자. livewire 처음 로딩될 때 한 번만 실행.

## render() 메소드
사용자 전화번호 목록 가져와 배열로 view에 전달.
>화면 갱신될 때마다 실행.
```php
    public function render()
    {
        $userid = Auth::user()->id;
        $this->user_id = $userid;

        ## 사용자 정보
        $this->userAccount($userid);

        ## 사용자 전화번호 목록
        $phones = $this->userPhone($userid);
        //dd($rows);
        return view($this->viewFile,[
            'rows' => $phones
        ]);
    }
```
>view는 객체를 접근할 수 없기 때문에 배열로 변환해서 전달하는데, 이는 서버와 AJAX 통신을 하는 livewire가 객체를 전달할 수 없기 떄문입니다.

## userAccount() 헬퍼함수
DB에서 지정한 사용자의 정보를 조회해 배열의 형태로 프로퍼티에 저장하는 헬퍼함수입니다.
```php
    // 사용자 정보 조회
    public function userAccount($userid)
    {
        $row = DB::table("accounts")
                ->where('user_id', $userid)
                ->first();

        if($row) {
            $this->account = get_object_vars($row);
        }
    }
```
>Livewire의 프로퍼티는 객체를 저장할 수 없기 때문에 객체를 배열 형식으로 변환하여 저장합니다.
>어떤 회원의 전화번호인지 기록하여 1:N 관계 처리를 위해 불러옵니다.

## userPhone() 헬퍼함수
DB에서 지정한 사용자의 연락처 정보 목록을 읽어 오는 헬퍼함수입니다.
```php
    public function userPhone($userid)
    {
        $rows = DB::table("account_phone")
            ->where('user_id', $userid)
            ->get();

        return $rows;
    }
```
>account_phone DB에 매번 직접 접속하는 대신, method를 통하여 간접 접속을 합니다.
>account_phone의 이름이 변경됐을 때 코드에 적용하기 편리합니다.

현재 로그인된 사용자의 연락처
```php
$rows = userPhone();
```

기본 설정된 값만 가지고 올경우
```php
$row = userPhone('checked');
```

특정 지정된 사용자의 phone 연락처 목록을 얻어 올 수 있습니다.
```php
$rows = getUserPhone(1);
```

## selected($value)
디폴트 전화번호 레코드를 지정합니다.
```php
    public function selected($value)
    {
        // 사용자 전화번호 전체 초기화
        DB::table("account_phone")
            ->where('user_id',$this->user_id)
            ->update([
                'selected'=>null
            ]);

        // dd($value);
        // 선택
        DB::table("account_phone")
            ->where('id',$value)
            ->update([
                'selected'=> "checked"
            ]);
    }
```
>DB로 접근하여 원래 선택되어 있던 default 전화번호를 해제(초기화, 복수 선택 안되기 때문)하고, 
>$value와 일치하는 id의 전화번호의 selected 컬럼을 checked로 변경합니다.

## create()
팝업창을 띄우고 입력폼을 초기화합니다.

## close()
팝업창을 닫고 입력폼을 초기화합니다.

## store()
입력된 폼을 사용자의 전화번호 목록 DB에 추가합니다.
```php
    public function store()
    {
        $form = $this->form;
        $form['user_id'] = Auth::user()->id;

        $nested_id = DB::table("account_phone")->insertGetId($form);

        $this->close();
    }
```
>insertGetId()는 Laravel의 Eloquent ORM에서 제공하는 함수이며, 데이터베이스에 새로운 레코드를 삽입하고 그 레코드의 기본 키(primary key) 값을 반환합니다.

## edit($id)
수정하고픈 레코드의 id를 통해 해당 레코드를 배열로 받아와 입력폼에 출력합니다.

## update()
입력받은 폼으로 DB의 레코드를 변경(update)합니다.
```php
    public function update()
    {
        $form = $this->form;

        DB::table("account_phone")
                ->where('id',$this->edit_id)
                ->update($form);

        $this->popupForm = false;
        $this->edit_id = null;
    }
```
>update($form)은 Laravel의 DB 관련 내장 함수입니다.

## delete()
선택된 전화번호를 삭제합니다.
```php
    public function delete($id=null)
    {
        $this->popupForm = false;

        if(!$id) {
            if($this->edit_id) {
                $id = $this->edit_id;
                $this->edit_id = null;
            }
        }

        if($id) {
            // 선택된 전화번호 삭제
            DB::table("account_phone")
                ->where('id', $id)
                ->delete();
        }

        // 입력폼 초기화
        $this->form = [];
    }
```
>$id가 null이면, $id를 $this->edit_id로 초기화한 후 $this->edit_id를 null로 설정합니다.
>Laravel의 DB 관련 내장 함수인 delete()를 통해 선택된 전화번호 레코드를 삭제합니다.
