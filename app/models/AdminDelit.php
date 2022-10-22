<?php

 header("Content-type: application/json; charset=utf-8");
namespace app\models;


class AdminDelit extends Model{
    
   
    function execute($action, $parameters)
    {
        parent::execute($action, $parameters);
        //$this->data = 'Данные страницы Admin';
        
        header("Content-type: application/json; charset=utf-8");



        $requestJSON = file_get_contents('php://input');


        $requestData = json_decode($requestJSON);
        
        
        
        if(isset($_SESSION['statusUser']) == "admin"){
        
         
            
            
            
            
        
        $delitSql = "DELETE FROM `user` WHERE `id_user` =:id";
        $delRow = ['id'=>  $requestData->id /*(int)$parameters[2]*/];
        $this->connectDB->delit( $delitSql , $delRow );
         
         
         
        $cat = "SELECT `id_user`, `Name`, `patronymic`, `surname`, `email`, `login`, `password`, `userPhoto_id_userPhoto`, `userStatus_id_userStatus` FROM `user`";
        $t = $this->connectDB->read($cat);
         
        
        $this->data =  $t ;
 
        
        $answer['error'] = "";                                   
        $answer['message'] =  $this->data;   
              
          
            

        echo json_encode($answer);
       // var_dump($parameters);
        
       } 
    }
    

   

    public function getData()
    {
        return $this->data;
    }
    

}

