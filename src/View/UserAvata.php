<?php
namespace Jiny\Profile\View;

use Illuminate\View\Component;

class UserAvata extends Component
{
    public $user_id;

    public function __construct($id=null)
    {
        $this->user_id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jiny-profile::components.avata', [
            'user_id'=>$this->user_id
        ]);
    }
}
