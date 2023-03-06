<?php

namespace App\Http\Livewire\DriverSalaries;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
class DriverContract extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$driver_id;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->tittle='Driver Contracts';
        $this->showForm=false;
    }
    public function render()
    {
        $results=Driver::paginate();
        return view('livewire.driver-salaries.driver-contract',[
            'results'=>$results,
        ])->extends('layouts.master');
    }
  
}
