<?php
namespace app\controllers;

class Admin {
    private $page = 'Page1';//имя страницы по умолчанию page1
    private $action; //CRUD-операции, по умолчанию read
    private $parameters; //массив остальных параметров запроса
    public $method;
    
    
    public function __construct($arr)
    {
        $this->parameters = $arr;
        $this->analyzeRequest($this->parameters);
    }
    
    
    protected function analyzeRequest()
    { 
        
        
        
        
        
        //var_dump($this->parameters);
        if (!empty($this->parameters[0]))
        { 
            $this->page = $this->parameters[0];
            unset($this->parameters[0]);
        }
        if (!empty($this->parameters[1]))
        {    $this->method = $this->parameters[1];
            unset($this->parameters[1]);
        }

        var_dump($this->parameters);
        var_dump($this->action);
        var_dump($this->page);
        
        var_dump($this->method);
        $method = $this->method;
        $this->$method( $this->action ,$this->parameters, $this->page);
    }

    public function render($action, $params, $class )
    {
        //Модель:
        $className = '\app\models\\'.$class;
        $model = new $className();
        $model->execute($action,$params);
        
        //Вид:
        $className = '\app\views\\'.$class;//имя класса view с пространством имен (например /views/page1)
        $view = new $className();
        $view->render($model->getData());
    }
    
    
   /* public function delit( $action, $params, $class)
    {
        $class = 'AdminDelit';
        $action = 'delit';
     
        var_dump($action);
        var_dump($class);
        var_dump($params);
       
        
        
        
        
        //Модель:
        $className = '\app\models\\'.$class;
        $model = new $className();
        $model->execute($action,$params);
        
        //Вид:
        $className = '\app\views\\'.$class;//имя класса view с пространством имен (например /views/page1)
        $view = new $className();
        $view->render($model->getData());
    }*/
    
}
