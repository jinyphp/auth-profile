# address
회원별 복수의 주소를 지원합니다. 

## profile-address 컴포넌트
`profile-address`는 회원별 복수의 주소를 관리할 수 있도록 목록을 관리하는 UI 컴포넌트 입니다.
```php
@livewire('profile-address')
```

### 화면 주입하기
컴포넌트에 화면을 주입할 수 있습니다.
```php
@livewire('profile-address',[
    'viewFile' => "컴포넌트 레이아웃",
    `viewList` => "목록 테이블",
    'viewForm' => "입력폼 화면"
])
```

## mount() 메소드
라이브와이어 생성자. livewire 처음 로딩될 때 한 번만 실행.
>viewFile, viewList, viewForm으로 화면 설정

## render() 메소드
사용자 주소 목록 가져와 배열로 view에 전달.
>화면 갱신될 때마다 실행.
```php
    public function render()
    {
        $userid = Auth::user()->id;
        $this->user_id = $userid;

        ## 사용자 정보
        $this->userAccount($userid);

        ## 사용자 주소 목록
        $addresses = $this->userAddress($userid);
        //dd($rows);
        return view($this->viewFile,[
            'rows' => $addresses
        ]);
    }
```
>view에 객체를 배열로 변환해서 전달하는데, 이는 서버와 AJAX 통신을 하는 livewire가 객체를 전달할 수 없기 떄문입니다.

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
>어떤 회원의 주소인지 기록하여 1:N 관계 처리를 위해 불러옵니다.

## userAddress() 헬퍼함수
DB에서 지정한 사용자의 연락처 정보 목록을 읽어 오는 헬퍼함수입니다.
```php
    public function userAddress($userid)
    {
        $rows = DB::table("account_address")
            ->where('user_id', $userid)
            ->get();

        return $rows;
    }
```
>DB에 매번 직접 접속하는 대신, method를 통하여 간접 접속을 합니다.
>account_address의 이름이 변경됐을 때 코드에 적용하기 편리합니다.
>get() 함수는 쿼리를 실행하고 결과를 객체의 컬렉션 형태로 반환합니다.
>$row 변수에는 해당 사용자 ID와 일치하는 모든 레코드가 객체 형태로 담깁니다.


## selected($value)
기본(default) 주소를 지정합니다.
```php
    public function selected($value)
    {
        // 사용자 주소 전체 초기화
        DB::table("account_address")
            ->where('user_id',$this->user_id)
            ->update([
                'selected'=>null
            ]);

        // dd($value);
        // 선택
        DB::table("account_address")
            ->where('id',$value)
            ->update([
                'selected'=> "checked"
            ]);
    }
```
>DB로 접근하여 원래 선택되어 있던 default 주소를 해제(초기화, 복수 선택 안되기 때문)하고, 
>$value와 일치하는 id의 주소의 selected 컬럼을 checked로 변경합니다. 

## create()
팝업창을 띄우고 입력폼을 초기화합니다.

## close()
팝업창을 닫고 입력폼을 초기화합니다.

## store()
입력된 폼을 사용자의 주소 목록 DB에 추가합니다.
```php
    public function store()
    {
        $form = $this->form;
        $form['user_id'] = Auth::user()->id;

        $nested_id = DB::table("account_address")->insertGetId($form);

        $this->close();
    }
```
>insertGetId()는 Laravel의 Eloquent ORM에서 제공하는 함수이며, 데이터베이스에 새로운 레코드를 삽입하고 그 레코드의 기본 키(primary key) 값을 반환합니다.

## edit($id)
수정하고픈 레코드를 배열로 받아와 입력폼에 출력합니다.

## update()
입력받은 폼으로 DB의 레코드를 변경(update)합니다.
```php
    public function update()
    {
        $form = $this->form;

        DB::table("account_address")
                ->where('id',$this->edit_id)
                ->update($form);

        $this->popupForm = false;
        $this->edit_id = null;
    }
```
>update($form)은 Laravel의 DB 관련 내장 함수입니다.

## delete()
선택된 주소를 삭제합니다.
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
            // 선택된 주소 삭제
            DB::table("account_address")
                ->where('id', $id)
                ->delete();
        }

        // 입력폼 초기화
        $this->form = [];
    }
```
>$id가 null이면, $id를 $this->edit_id로 초기화한 후 $this->edit_id를 null로 설정합니다.
>Laravel의 DB 관련 내장 함수인 delete()를 통해 선택된 주소 레코드를 삭제합니다.
