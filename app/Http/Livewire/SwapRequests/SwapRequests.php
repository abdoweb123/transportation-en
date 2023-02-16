<?php

namespace App\Http\Livewire\SwapRequests;

use App\Models\SublierCotractRoute;
use Livewire\Component;
use App\Models\SwapRequest;
use App\Models\Station;
use App\Models\Route;
use App\Models\BookingRequest;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class SwapRequests extends Component
{
    use WithFileUploads;
    public $ids,$showIndex,$showForm,$type,$tittle,$stations,$routes,$swap_id ;
    public $collection_point_to_id,$collection_point_from_id,$route_id,$date,$time;
    public function mount()
    {
        $this->tittle ='SwapRequest';
    }
    public function render()
    { 
        $results=SwapRequest::with('employee:id,name')->where('is_done','N')->paginate();
        $resultsRejected=SwapRequest::with('employee:id,name')->where('is_done','R')->paginate();
        $resultsDone=SwapRequest::with('employee:id,name')->where('is_done','Y')->paginate();
        return view('livewire.swap-requests.swap-requests',compact('results','resultsRejected','resultsDone'))->extends('layouts.master');
    }
    public function defin_booking_request($id)
    {
        $swap=SwapRequest::find($id);
        // dd($swap);
        $this->swap_id=$id;

        $data=BookingRequest::find($swap->booking_request_id);
        $this->ids=$data->id;
        $this->collection_point_to_id=$data->collection_point_to_id;
        $this->collection_point_from_id=$data->collection_point_from_id;
        $this->route_id=$data->route_id;
        $this->date=$swap->date;
        $this->time=$swap->time;

        $this->stations=Station::select('id','name')->get();
        $this->routes=Route::select('id','name')->get();
        $this->emit('show_modal');
    }
    public function store_edit()
    {
        $validate=$this->validate([
            'collection_point_to_id'=>'required',
            'collection_point_from_id'=>'required',
            'route_id'=>'required',
            'date'=>'required',
            'time'=>'required',
        ]);
        $data=BookingRequest::find($this->ids);
        $data->collection_point_to_id=$this->collection_point_to_id;
        $data->collection_point_from_id=$this->collection_point_from_id;
        $data->route_id=$this->route_id;
        $data->date=$this->date;
        $data->time=$this->time;
        $check=$data->save();
        if ($check) {
            $swap=SwapRequest::find($this->swap_id);
            $swap->is_done='Y';
            $swap->save();
        }
        $this->emit('hide_modal');

    }
}
