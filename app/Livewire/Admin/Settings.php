<?php

namespace App\Livewire\Admin;

use App\Models\GeneralSetting;
use Livewire\Component;

class Settings extends Component
{
    public $tab = null;
    public $default_tab = "general_settings";
    protected $queryString = ["tab" => ["keep" => true]];
 


    function selectTab($tab) {
        $this->tab = $tab;
    }

    function mount() {
        $this->tab = Request("tab") ? Request("tab") : $this->default_tab;
    }

        public function render()
    {
        return view('livewire.admin.settings');
    }
}
