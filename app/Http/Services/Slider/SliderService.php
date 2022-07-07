<?php


namespace App\Http\Services\Slider;


use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request){
        try{
            #$request->except('_token');
            Slider::create($request->input());

            Session::flash('success', 'Slider has been successfully');
        }
        catch(\Exception $err){
            Log::error($err->getMessage());

            Session::flash('error', 'Slider created failed');

            return false;
        }

        return true;
    }

    public function get()
    {
        return SLider::orderbyDesc('id')-> paginate(15); 
    }
    
}