<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\menu\MenuService;
use App\Http\Services\product\ProductService;
use GuzzleHttp\Handler\Proxy;

class MainController extends Controller
{
    protected $menu;
    protected $slider;
    protected $product;
    public function __construct(MenuService $menu, SliderService $slider, ProductService $product)
    {
        $this->menu = $menu;
        $this->slider = $slider;
        $this->product = $product;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Shoe shop',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }
}
