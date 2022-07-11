<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\menu\MenuService;
use App\Http\Services\product\ProductService;

class MainController extends Controller
{
    protected $menu;
    protected $slider;

    public function __construct(MenuService $menu, SliderService $slider)
    {
        $this->menu = $menu;
        $this->slider = $slider;
    }

    public function index()
    {
        return view('main', [
            'title' => 'Shoe shop',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            // 'products' => $this->product->get()
        ]);
    }
}
