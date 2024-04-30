<?php
namespace Jiny\Profile\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileAddress extends Component
{
    public $actions=[];

    //private $table_name = "accounts";
    public $parent = [];

    //private $nest_table_name = "account_address";

    public $user_id;
    public $row_id;

    public $rows = [];
    public $edit_id;
    public $form = [];

    public $popupForm = false;

    public function mount()
    {
        // $user = Auth::user();
        // $this->user_id = $user->id;
        $this->actions['table'] = "accounts";

        $this->actions['nested']['tablename'] = "account_address";
        $this->actions['nested']['key'] = "address_id";

        $this->actions['nested']['view_table'] = 'jiny-profile::livewire.address.table';
        $this->actions['nested']['view_list'] = 'jiny-profile::livewire.address.list';
        $this->actions['nested']['view_form'] = 'jiny-profile::livewire.address.form';

    }

    public function render()
    {
        $user_id = Auth::user()->id;

        // 부모 테이블 정보
        $table_name = $this->actions['table'];
        $parent = DB::table($table_name)
                ->where('user_id', $user_id)
                ->first();
        $this->parent = get_object_vars($parent);

        // 자식 테이블 목록
        $nasted_table_name = $this->actions['nested']['tablename'];
        $rows = DB::table($nasted_table_name)
            ->where('user_id', $user_id)
            ->get();
        if($rows) {
            // 배열로 변환
            $this->rows = [];
            foreach($rows as $row) {
                $this->rows []= get_object_vars($row);
            }

        } else {
            $rows = [];
        }

        $viewFile = $this->actions['nested']['view_table'];
        return view($viewFile);
    }

    public function create()
    {
        $this->popupForm = true;
        $this->form = [];
    }

    public function close()
    {
        $this->popupForm = false;
        $this->form = [];
    }

    public function store()
    {
        $form =  $this->form;
        $form['user_id'] = Auth::user()->id;

        $nasted_table_name = $this->actions['nested']['tablename'];
        $nested_id = DB::table($nasted_table_name)->insertGetId($form);

        $this->close();
    }

    public function edit($id)
    {
        $this->popupForm = true;
        $this->edit_id = $id;

        $nasted_table_name = $this->actions['nested']['tablename'];
        $row = DB::table($nasted_table_name)
            ->where('id', $id)
            ->first();

        $this->form = get_object_vars($row);
    }

    public function update()
    {
        $form =$this->form;

        $nasted_table_name = $this->actions['nested']['tablename'];
        DB::table($nasted_table_name)
                ->where('id',$this->edit_id)
                ->update($form);

        $this->popupForm = false;
        $this->edit_id = null;
    }

    public function cancel()
    {
        $this->close();
    }

    public function delete($id=null)
    {
        $this->popupForm = false;

        if(!$id) {
            if($this->edit_id) {
                $id = $this->edit_id;
                $this->edit_id = null;
            }
        }

        if($id) {
            $nasted_table_name = $this->actions['nested']['tablename'];
            $nest = DB::table($nasted_table_name)
                ->where('id', $id)->first();

            DB::table($nasted_table_name)
                ->where('id', $id)
                ->delete();

            $key = $this->actions['nested']['key'];
            $table_name = $this->actions['table'];
            if($this->parent[$key] == $nest->id) {
                DB::table($table_name)
                    ->where('user_id', $nest->user_id)->update([
                        $key => 0
                    ]);
            }

        }

        $this->form = [];
    }


    public function apply($id)
    {
        $user_id = Auth::user()->id;

        $key = $this->actions['nested']['key'];
        $table_name = $this->actions['table'];
        DB::table($table_name)
            ->where('user_id', $user_id)->update([
                $key => $id
            ]);
    }

}
