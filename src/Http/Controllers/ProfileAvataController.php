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

class ProfileAvataController extends ProfileController
{
    public $viewName = "home.avata";

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $message = [];
        $user = Auth::user();

        $viewfile = $this->getViewFile('avata');
        if($viewfile) {
            return view($viewfile,[
                'message' => $message,
                'user' => $user
            ]);
        }

        return "리소스를 찾을 수 없습니다.";
    }


}
