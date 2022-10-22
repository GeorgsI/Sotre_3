<?php

namespace app\views;

class AjaxAuthorization {
   
         public function render($data)
    {
    
       
      
        $header = new templates\Header();
        $header->render();
        
        
        $Authorization = new templates\FormAuthorization();
        $Authorization->render();
        
        $footer = new templates\Footer();
        $footer->render();
        
        
      
        
        
        
        
         
        
      
   
    }
}
