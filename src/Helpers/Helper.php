<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists("account")) {
    function account($id=null)
    {
        if(!$id) {
            $user = Auth::user();
            $id = $user->id;
        }
        return \Modules\Accounts\Http\Account::instance($id);
    }
}

function getUserPhone($userid=null, $selected=null) {

    if(is_numeric($userid)) {
        // 사용자 지정됨
    } else {
        // 사용자 지정을 하지 않은경우,
        // 현재의 로그인 사용자
        $userid = Auth::user()->id;

        // 첫번째 인자가 숫자가 아닌 경우,
        // 첫번째 인자를 생략하고, 두번째 인자로 처리
        if($userid) {
            $selected = $userid;
        }
    }


    // 로그인 사용자 id가 있는 경우에만, DB 조회
    // 비로그인 회원은 동작X
    if($userid) {
        $db = DB::table("account_phone")
            ->where('user_id', $userid);

        if($selected) {
            $db->whereNotNull('selected');
            $row = $db->first();
            return $row;

        } else {
            $rows = $db->get();
            return $rows;
        }

    }

    return false;
}

