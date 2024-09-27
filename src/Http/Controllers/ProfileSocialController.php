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

use Jiny\Site\Http\Controllers\SiteController;
class ProfileSocialController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);
    }

    public function index(Request $request)
    {
        $this->setLayout("home.social");
        $this->setLayoutDefault("jiny-profile::home.social");

        return parent::index($request);
    }



}
