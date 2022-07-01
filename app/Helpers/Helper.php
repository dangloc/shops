<?php
 namespace App\Helpers;


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
               <td>'.$val->active .'</td>
               <td>'.$val->updated_at .'</td>
               <td>&nbsp;</td>
            </tr>
            ';

            unset($val[$key]);
            $html .= self::menu($menus, $val->id, $char .'--');
         }   
    }
    return $html;
}


}