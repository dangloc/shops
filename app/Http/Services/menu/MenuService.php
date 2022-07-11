<?php

namespace App\Http\Services\menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuService
{

    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
       try{
            Menu::create([
                'name'=>(string) $request-> input('name'),
                'parent_id'=>(int) $request-> input('parent_id'),
                'description'=>(string) $request-> input('description'),
                'content'=>(string) $request-> input('content'),
                'thumb'=>(string) $request-> input('thumb'),
                'active'=>(string) $request-> input('active'),

            ]);

            Session::flash('success','Create category complete');
       }
        catch(\Exception $err){
            Session::flash('error', $err->GetMessage());
            return false;
       }

       return true;
    }

    public function destroy($request)
    {
        $id= (int)$request->input('id');

        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        
        return false;
    }

    public function update($menu, $request) : bool
    {
        // $menu->fill($request->input());
        // $menu->save();
        if($request->input('parent_id') != $menu->id)
        {
            $menu->parent_id =(int) $request->input('parent_id');
        }
        $menu->name =(string) $request->input('name');     
        $menu->description =(string) $request->input('description');
        $menu->content =(string) $request->input('content');
        $menu->active =(string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Update Successfully');
        return true;
    }
}