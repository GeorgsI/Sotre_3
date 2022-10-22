<?php

namespace app\views\templates;

class Admin {

    public function render($data)
    {
    
     
    $out = "<div id='auth'><div id='autherror'></div><table ><caption>Таблица пользователей</caption>
            <tr>
             <th>Имя</th>
             <th>ОТчество</th>
             <th>Фамилия</th>
             <th>e-mail</th>
            </tr>";
     
     foreach ($data as $value){
     $out .= "<tr><td>{$value['Name']}</td>
                        <td>{$value['patronymic']}</td>
                        <td>{$value['surname']}</td>
                        <td>{$value['email']}</td>
                        <td>{$value['userStatus_id_userStatus']}</td>"; 
        if((int)$value['userStatus_id_userStatus']  == 3){
               $out .= "<td><input type='button' value='Обновить' disabled class='btn admin-update-user block-use' data-updateuser='{$value['id_user']}'></td>                       
                        <td><input type='button' value='Удалить' disabled class='btn admin-dell-user block-use' data-deluser='{$value['id_user']}'></td></tr>";
        }
        else{
            $out .= "<td><input type='button' value='Обновить' class='btn admin-update-user' data-updateuser='{$value['id_user']}'></td>                       
                        <td><input type='button' value='Удалить' class='btn admin-dell-user' data-deluser='{$value['id_user']}'></td></tr>";
        }
     
    }
       $out .= "</table></div>";

        echo   $out;
    }
}
