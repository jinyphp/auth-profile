<?php
namespace Jiny\Profile\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\On;
//use Livewire\WithFileUploads;

class AvataImage extends Component
{
    private $user_id;
    public $width = "64px";
    public $rounded = true;


    //public $photo;
    //public $filename;

    public function mount($userid=null)
    {
        if($userid) {
            $this->user_id = $userid;
        } else {
            $user = Auth::user();
            if($user) {
                $this->user_id = $user->id;
            }
        }

    }

    public function render()
    {
        if($this->user_id) {
            // 갱신할때 다시 검색하여 출력
            $profile = DB::table('account_avata')
                ->where('user_id',$this->user_id)
                ->first();

            $viewFile = "jiny-profile::livewire.avata_image";
            return view($viewFile, ['profile'=>$profile]);
        }

        $message = "회원 로그인이 필요합니다.";
        return view("jiny-profile::errors.message",[
            'message' => $message
        ]);
    }

    protected $listeners = [
        'avata-image-reflash' => 'avataImageReflash'
    ];

    #[On('avata-image-reflash')]
    public function avataImageReflash()
    {
        // 화면 갱신 호출 event
    }

}
