<?php
namespace Jiny\Profile\Http;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Account
{
    private static $Instance;

    /**
     * 싱글턴 인스턴스를 생성합니다.
     */
    public static function instance($id=null)
    {
        if (!isset(self::$Instance)) {
            // 자기 자신의 인스턴스를 생성합니다.
            self::$Instance = new self();
        } else {
            // 인스턴스가 중복
        }

        $user = DB::table('users')->where('id',$id)->first();
        foreach($user as $key => $value) {
            self::$Instance->$key = $value;
        }

        return self::$Instance;
    }





}
