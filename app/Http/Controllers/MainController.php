<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\menu\MenuService;
use App\Http\Services\product\ProductService;

class MainController extends Controller
{
    protected $menu;

    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        return view('main', [
            'title' => 'Shoe shop',
            // 'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            // 'products' => $this->product->get()
        ]);
    }
}
