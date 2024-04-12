<?php
namespace Jiny\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * 로그인후 Home 화면입니다.
     */
    public function index() {
        $message = [];

        if(function_exists("is_module")) {
            if(is_module("Site")) {
                $prefix = "www";
                $viewfile = $prefix."::"."home";

                // 우선순위1. www 의 home.blade를 출력
                if (View::exists($viewfile)) {
                    return view($viewfile,[
                        'message' => $message
                    ]);
                }
            }
        }

        if(function_exists("is_package")) {
            if(is_package("jiny/theme")) {
                $themeName = getThemeName();
                if($themeName) {
                    $themeName = str_replace('/','.',$themeName);
                    $viewfile = "theme::".$themeName.".home";
                    if (View::exists($viewfile)) {
                        return view($viewfile,[
                            'message' => $message
                        ]);
                    }
                }

            }
        }


        // 패키지에 존재하는 home을 출력
        $viewfile = "jiny-profile::home.index";

        return view($viewfile,[
            'message' => $message,
            'user' => Auth::user()
        ]);
    }


}
