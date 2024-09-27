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

/**
 * 로그인 사용자 Home 화면
 */
use Jiny\Site\Http\Controllers\SiteController;
class HomeController extends SiteController
{
    public $viewName = "home.index";

    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);
    }


    public function index(Request $request)
    {

        ## 우선순위1
        ## actions에서 설정된 값이 최우선 적용됨
        /*
        if(!isset($this->actions['view']['layout'])) {
            ## 우선순위2, slot 데이터
            if($slot = www_slot()) {
                $viewFile = "www::".$slot.".".$this->viewName;
                if (View::exists($viewFile)) {
                    $this->actions['view']['layout'] = $viewFile;
                }
            }

            ## 우선순위3, 테마 데이터
            if($themeName = getThemeName()) {
                $themeName = str_replace('/','.',$themeName);
                $viewFile = "theme::".$themeName.".".$this->viewName;
                if (View::exists($viewFile)) {
                    $this->actions['view']['layout'] = $viewFile;
                }
            }

            ## 우선순위4, 페키지 데이터
            $package = "jiny-profile";
            $viewFile = $package."::".$this->viewName;
            if (View::exists($viewFile)) {
                $this->actions['view']['layout'] = $viewFile;
            }

        }
        */

        // 기본 Layout 화면 지정
        $this->viewFileLayout = "jiny-profile::home.index";

        return parent::index($request);
    }


}
