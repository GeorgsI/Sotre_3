<?php
namespace app\models;

class AjaxAuthorization extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы page1';
        
        
        
        
        $login =  $_POST['login'] ;
        $password =  $_POST['password'] ;
        
        
        echo $login;

        if (!empty($login) && !empty($password))
        {
           // echo '<p>' . $login . ', здравствуйте' . '</p>';


            if(mb_strlen($password) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный пароль.';
            }
            elseif(mb_strlen($password) < 8){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий пароль не меншье 8.';
            }
            elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $password)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле пароль не допустимый символ.';
            }
            elseif(mb_strlen($login) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный логин';
            }
            elseif(mb_strlen($login) < 3){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий логин не меншье 3';
            }
            elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $login)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле логин не допустимый символ.';
            }
            else{

               $sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user` WHERE `login` = :login";


                $arguments = ['login'=>$login];   
                $result = $this->connectDB->read($sql, $arguments);

              //  var_dump($result);




               if(isset($result[0]['login']) == $login && password_verify($password, $result[0]['password'])){

                    $status = (int)$result[0]['userStatus_id_userStatus'];

                    if($status == 1){
                        //echo "user";
                        $_SESSION['statusUser'] = "user";
                        header('Location: '.'/store/User');
                    }
                    elseif($status == 2){
                        $_SESSION['statusUser'] = "manager";
                        header('Location: '.'/store/Manager');
                    }
                    elseif($status == 3){

                       $_SESSION['statusUser'] =  "admin";
                       header('Location: '.'/store/Admin');
                            
                       
                    }
                    //echo 4444;  
                }
                else{
                    echo $answer['error'] = 'Ошибка.' ;
                }


            }   
    
       } else {
            echo '<p>Ошибка при авторизации, заполниете поля.</p>';
        }

    }       

    public function getData()
    {
        return $this->data;
    }
    
    
    
    
}












































/*

class AjaxAuthorization extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы page1';
        
        $login =  $parameters[2]['login'] ;
        $password =  $parameters[2]['password'] ;
        
         header("Content-type: text/plain; charset=UTF-8");


     
         $form = " <div id='window'><section class='form-Block'>
              <form class='form formAuthorization' id='formAuthorizationUser'>
                <div id='auth'></div>
                <div id='autherror'></div>

                    <div class='form-innerWrepper'>
                        <div class='form-elementWrepper'>
                            <h2 class='form-title'>Вход</h2>
                        </div>
                        <div class='form-elementWrepper wrepperFB'>
                            <input class='field field-password' type='password' placeholder='Пароль' name='password'  id='password' value='{$_POST['password']}'>
                            <button type='button' class='field_showBtn btn'>
                                <i class='fa fa-eye ' aria-hidden='true'></i>
                            </button>
                        </div>
                        <div class='form-elementWrepper'>
                            <input class='field fieldAuthorization ' placeholder='Логин' name='login' id='login' type='text' value='{$_POST['login']}' >
                        </div>

                        <div class='form-elementWrepper'>
                            <input class='btn form-btn fieldAuthorization Authorization-btn' type='button' value='Войти' title='Войти в кабинет' onClick='sendRequestFetch2();'>
                       
                        </div>
                        <div class='form-elementWrepper' >
                            <a class='btn form-btn' href='Registration' title='Зарегистрироваться'>Регистрация</a>
                        </div>
                    </div>
                </form>
            </section></div>"; 
        
      
        if (!empty($login) && !empty($password))
        {
           // echo '<p>' . $login . ', здравствуйте' . '</p>';


            if(mb_strlen($password) > 10){
                echo 'Ошибка.';
                echo 'Длинный пароль.'.$form;
            }
            elseif(mb_strlen($password) < 8){
                echo 'Ошибка.';
                echo 'Короткий пароль не меншье 8.'.$form;
            }
            elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $password)){
                echo 'Ошибка.';
                echo'В поле пароль не допустимый символ.'.$form;
            }
            elseif(mb_strlen($login) > 10){
               echo 'Ошибка.';
               echo'Длинный логин'.$form;
            }
            elseif(mb_strlen($login) < 3){
               echo 'Ошибка.';
                echo 'Короткий логин не меншье 3'.$form;
            }
            elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $login)){
                echo 'Ошибка.';
                echo 'В поле логин не допустимый символ.'.$form;
            }
            else{

                $sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user` WHERE `login` = :login";


                $arguments = ['login'=>$login];   
                $result = $this->connectDB->read($sql, $arguments);

              //  var_dump($result);

               


               if(isset($result[0]['login']) == $login && password_verify($password, $result[0]['password'])){

                    $status = (int)$result[0]['userStatus_id_userStatus'];

                    if($status == 1){
                        //echo "user";
                        $_SESSION['statusUser'] = "user";
                        header('Location: '.'/store/User');
                    }
                    elseif($status == 2){
                        $_SESSION['statusUser'] = "manager";
                        header('Location: '.'Manager');
                    }
                    elseif($status == 3){

                       $_SESSION['statusUser'] =  "admin";
                       header('Location: '.'Admin');
                    }
                    //echo 4444;  
                }
                else{
                    echo 'Ошибка.'.$form ;
                }
   
            }   
                

        } else {
            echo '<p>Ошибка при авторизации, заполниете поля.</p>'. $form;
        }

        
        
        
        
           
    }     

    public function getData()
    {
        return $this->data;
    }
}






*/




































/*
header("Content-type: application/json; charset=utf-8");
class AjaxAuthorization extends Model{
 function execute($action, $parameters)
    {
       //  header("Content-type: application/json; charset=utf-8");
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы page1';
        
        $requestJSON = file_get_contents('php://input');
        $requestData = json_decode($requestJSON);
         
         
        $login =  $requestData->login;
        $password =  $requestData->password;

        if (!empty($login) && !empty($password))
        {
            //echo '<p>' . $login . ', здравствуйте' . '</p>';


          /*  if(mb_strlen($password) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный пароль.';
            }
            elseif(mb_strlen($password) < 8){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий пароль не меншье 8.';
            }
            elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $password)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле пароль не допустимый символ.';
            }
            elseif(mb_strlen($login) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный логин';
            }
            elseif(mb_strlen($login) < 3){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий логин не меншье 3';
            }
            elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $login)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле логин не допустимый символ.';
            }
            else{*/

          /*      $sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user` WHERE `login` = :login";


                $arguments = ['login'=>$login];   
                $result = $this->connectDB->read($sql, $arguments);

             




               if(isset($result[0]['login']) == $login && password_verify($password, $result[0]['password'])){

                    $status = (int)$result[0]['userStatus_id_userStatus'];

                    if($status == 1){
                        //echo "user";
                        $_SESSION['statusUser'] = "user";
                        
                        
                       
                     
                       $arr=['User', 'render'];
                       $class = new app\controllers\User($arr);
                        
                        
                        
                      
                        $answer['window'] = json_encode($class) ;

                    }
                    elseif($status == 2){
                        $_SESSION['statusUser'] = "manager";
                        header('Location: '.'Manager');
                    }
                    elseif($status == 3){

                       $_SESSION['statusUser'] =  "admin";
                       header('Location: '.'Admin');
                    }
                    //echo 4444;  
                }
                else{
                    
                    
                    
                    $answer['window'] = '';
                    $answer['message'] = '';
                    $answer['error'] = 'Ошибка.' ;
                }
              
        } else {
            echo '<p>Ошибка при авторизации, заполниете поля.</p>';
        }

        echo json_encode($answer);
    }       

    public function getData()
    {
        echo $this->data;
    } 
}
*/



































/*
class AjaxAuthorization extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
       // $this->data = 'Данные страницы page1';
        
        $login =  $parameters[2]['login'] ;
        $password =  $parameters[2]['password'] ;
        
         header("Content-type: text/plain; charset=UTF-8");


        if (!empty($login) && !empty($password))
        {
           // echo '<p>' . $login . ', здравствуйте' . '</p>';


          /*  if(mb_strlen($password) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный пароль.';
            }
            elseif(mb_strlen($password) < 8){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий пароль не меншье 8.';
            }
            elseif(!preg_match("/^[A-Za-z0-9\_\*\.]{8,10}$/", $password)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле пароль не допустимый символ.';
            }
            elseif(mb_strlen($login) > 10){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Длинный логин';
            }
            elseif(mb_strlen($login) < 3){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'Короткий логин не меншье 3';
            }
            elseif(!preg_match("/^[A-Za-z0-9]{3,10}$/", $login)){
                $answer['error'] = 'Ошибка.';
                $answer['message'] = 'В поле логин не допустимый символ.';
            }
            else{*/
/*
                $sql = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user` WHERE `login` = :login";


                $arguments = ['login'=>$login];   
                $result = $this->connectDB->read($sql, $arguments);

              //  var_dump($result);




               if(isset($result[0]['login']) == $login && password_verify($password, $result[0]['password'])){

                    $status = (int)$result[0]['userStatus_id_userStatus'];

                    if($status == 1){
                        //echo "user";
                        $_SESSION['statusUser'] = "user";
                        header('Location: '.'/store/User');
                    }
                    elseif($status == 2){
                        $_SESSION['statusUser'] = "manager";
                        header('Location: '.'Manager');
                    }
                    elseif($status == 3){

                       $_SESSION['statusUser'] =  "admin";
                       header('Location: '.'Admin');
                    }
                    //echo 4444;  
                }
                else{
                    echo $answer['error'] = 'Ошибка.' ;
                }


            }   

       /* } else {
            echo '<p>Ошибка при авторизации, заполниете поля.</p>';
        }*/
/*
    }       

    public function getData()
    {
        return $this->data;
    }
    
    
    
    
}*/