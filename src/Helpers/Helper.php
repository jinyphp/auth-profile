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

