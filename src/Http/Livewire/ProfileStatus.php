<?php
namespace Jiny\Profile\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileStatus extends Component
{
    public $viewFile;
    public $user = [];
    public $userType;
    public $lastLog;

    private $user_id;

    // 생성자
    public function mount()
    {
        if(!$this->viewFile) {
            $this->viewFile = "jiny-profile::livewire.status";
        }

        // 회원 로그인 검사
        $user = Auth::user();
        if($user) {
            $this->user_id = $user->id;
            $this->user['name'] = $user->name;
            $this->user['email'] = $user->email;

            // 유저 타입 및 권환
            $this->userType = $user->utype;

            $this->lastLog = userLastLog();
        }
    }

    // 화면
    public function render()
    {
        // 회원 로그인 검사
        if($this->user_id ) {
            return view($this->viewFile);
        }

        return view("jiny-profile::livewire.status_error");
    }



}
