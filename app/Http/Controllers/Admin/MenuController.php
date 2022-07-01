<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add', [
            'title' => 'Add category',
            'menus' => $this->menuService->getParent()
    
        ]);
    }


    public function store(CreateFormRequest $request)
    {
       $result = $this->menuService->create($request);

       return redirect()->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title'=> 'List category new',
            'menus'=> $this-> menuService->getAll()
        ]);
    }
}

