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

    public function update($request, $slider){
        try{
            $slider->fill($request-> input());
            $slider->save();
            Session::flash('success', 'Update Slider successfully');
        }
        catch(\Exception $err){
            Log::error($err->getMessage());

            Session::flash('error', 'Slider Update failed');

            return false;
        }
        return true;
    }

    public function destroy($request){
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }

    public function show()
    {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }
    
}
