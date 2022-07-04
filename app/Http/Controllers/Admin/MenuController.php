<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\menu\MenuService;
use App\Models\Menu;

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

    public function destroy(Request $request): JsonResponse
    {

        $result = $this->menuService->destroy($request);

        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Delete category successfully'
            ]);
        }
        return response()->json([
            'error'=> true
        ]);
    }

    public function show(Menu $menu){
        // dd($menu->name);
        return view('admin.menu.edit', [
            'title'=>'Edit Category: ' . $menu->name,
            'menu' => $menu,
            'menus'=> $this-> menuService->getAll()
        ]);
    }

    public function update(Menu $menu, Request $request){

        $this->menuService->update($menu, $request);

        return redirect('/admin/menus/list');
    }
}

