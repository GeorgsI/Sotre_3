<?php
namespace app\views;

class Admin {
    public function render($data)
    {

        
        $header = new templates\Header();
        $header->render();
        
        echo 'Страница Администратора<br/>';
   
       
       
        
      
        echo "<main class = 'main'>";
        $Admin = new templates\Admin();
        echo $Admin->render($data);
        
        
        echo "</main >";
        echo "<a href='/store/index.php'>Выход</a>";
        
        $footer = new templates\Footer();
        $footer->render();
        
        
    }
}
