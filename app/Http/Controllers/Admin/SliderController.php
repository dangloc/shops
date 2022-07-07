<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function create()
    {
        return view('admin.slider.add',[
            'title'=> 'Create new slider',
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'  => 'required',
            'thumb' => 'required',
            'url' => 'required',
        ]);

        $this->slider->insert($request);

        return redirect()-> back();
    }

    public function index(){
        return view('admin.slider.list',[
            'title' => 'Slider List',
            'sliders' => $this->slider->get()
        ]);
    }
}
