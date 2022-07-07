<?php


namespace App\Http\Services\product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;


class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function isValidPrice($request)
    {
        if($request->input('price') != 0 && $request->input('price_sale') != 0 
            && $request->input('price_sale') >= $request->input('price'))
        {
            Session::flash('error', 'Price sale must be less than the original price');
            return false;
        }

        if($request->input('price_sale') != 0 && (int)$request->input('price') == 0)
        {
            Session::flash('error', 'Please enter a price');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
        try{
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success', 'Product created successfully.');
        }catch(\Exception $err){
            Session::flash('error', 'Product created error.');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function get()
    {
        return Product::with('menu')
        ->orderbyDesc('id')-> paginate(15);
    }

    public function update($product, $request){
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try{
            $product->fill($request->input());
            $product->save();

            Session::flash('success', 'Product saved successfully.');
        }
        catch(\Exception $err){
            Session::flash('error', 'Product saved error.');
            \Log::info($err->getMessage());
            return false;
        }

        return true;

    }

    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();

        if($product)
        {
            $product->delete();
            return true;
        }
        return false;
    }

}
