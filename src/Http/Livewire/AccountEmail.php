<?php
namespace Jiny\Profile\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountEmail extends Component
{
    public $form;
    public $user_id;
    public $row_id;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;

        if($this->user_id) {
            $row = DB::table('users')
            ->where('id',$this->user_id)
            ->first();

            if($row) {
                $this->row_id = $row->id;
                $this->form = get_object_vars($row);
            }
        }
    }

    public function render()
    {
        $viewFile = 'jiny-profile::livewire.account_email';
        return view($viewFile);
    }

    public function submit()
    {
        $form =  $this->form;
        if($this->row_id) {
            DB::table('users')
                ->where('id',$this->user_id)
                ->update($form);
        }
    }

    public function cancel()
    {
        $this->form = [];
    }

}
