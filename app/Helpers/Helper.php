<?php
 namespace App\Helpers;

 use Illuminate\Support\Str;

 class Helper {

    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $val) {
         if ($val->parent_id == $parent_id) {
            $html .= '
            <tr>
               <td>'.$val->id .'</td>
               <td>'. $char .$val->name .'</td>
               <td>'. self::active($val->active ).'</td>
               <td>'.$val->updated_at .'</td>
               <td>
                  <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'. $val->id .'">
                  <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <a href="#" class="btn btn-danger btn-sm" 
                  onclick="removeRow('. $val->id .', \'/admin/menus/destroy\')"> 
                  
                  <i class="fa-solid fa-trash"></i>
                  
                  </a>
               </td>
            </tr>
            ';

            unset($val[$key]);
            $html .= self::menu($menus, $val->id, $char .'--');
         }   
    }
    return $html;
}

public static function active($active = 0) : string
{
   return $active ==0 ? '<span class="btn btn-danger btn-xs">No</span>' : '<span class="btn btn-success btn-xs">Yes</span>';
}


 
public static function menus($menus, $parent_id = 0) :string
{
    $html = '';
    foreach ($menus as $key => $menu) {
        if ($menu->parent_id == $parent_id) {
            $html .= '
                <li>
                    <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                        ' . $menu->name . '
                    </a>';

            unset($menus[$key]);

            if (self::isChild($menus, $menu->id)) {
                $html .= '<ul class="sub-menu">';
                $html .= self::menus($menus, $menu->id);
                $html .= '</ul>';
            }

            $html .= '</li>';
        }
    }

    return $html;
}

public static function isChild($menus, $id) : bool
{
    foreach ($menus as $menu) {
        if ($menu->parent_id == $id) {
            return true;
        }
    }

    return false;
}

public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return number_format($priceSale);
        if ($price != 0)  return number_format($price);
        return '<a href="/Contact.html">Contact</a>';
    }


}