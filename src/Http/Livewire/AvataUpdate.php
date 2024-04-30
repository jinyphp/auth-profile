<?php
namespace Jiny\Profile\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Livewire\WithFileUploads;

class AvataUpdate extends Component
{
    public $user_id;

    use WithFileUploads;
    public $photo;
    public $filename;

    public function mount()
    {
        $user = Auth::user();
        if($user) {
            $this->user_id = $user->id;
        }
    }

    public function render()
    {
        if($this->user_id) {
            $profile = DB::table('account_avata')
                ->where('user_id',$this->user_id)
                ->first();

            return view('jiny-profile::livewire.avata', ['profile'=>$profile]);
        }

        return view("jiny-profile::errors.message",[
            'message'=>"회원 로그인이 필요합니다."
        ]);
    }


    // photo 프로퍼티가 갱신이 될때 호출되는 livewire 후킹
    public function updatedPhoto()
    {
        if($this->photo) {
            $this->validate([
                'photo' => 'image|max:1024',
            ]);

            // 파일 업로드
            $filename = $this->photo->store('avatas');
            $this->filename = $filename;
        }
    }

    private function updateDatabase($filename)
    {
        $profile = DB::table('account_avata')
                    ->where('user_id',$this->user_id)->first();

        if($profile) {
            // 갱신
            DB::table('account_avata')->where('id',$this->user_id)->update([
                'image' => $filename
            ]);
        }
        // 신규삽입
        else {
            DB::table('account_avata')->insert([
                'user_id' => $this->user_id,
                'image' => $filename
            ]);
        }
    }

    public function submit()
    {
        // DB 갱신
        $this->updateDatabase($this->filename);

        $this->dispatch('avata-image-reflash');
    }

}
