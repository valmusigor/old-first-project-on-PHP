<?php

class Router
{
    private $routes;//массив где будут хранится маршруты
    public function __construct() {
        $routersPath=ROOT.'/config/routes.php';
        $this->routes= include($routersPath);//грузим в массив routes роуты
    }
    /*
     * Returns reques string
     * @retutn string
     */
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run()
    {
       // Получить строку запроса
       $uri=$this->getURI(); 
       //Проверить наличиче такого запроса в routes.php
        foreach($this->routes as $uriPattern=>$path)
        {//Если есть совпадение, определить какой контроллер и action обработчик
        if(preg_match("~^$uriPattern$~", $uri))
        {
            //в строке запроса $uri ищем параметры по шаблону $uriPattern,если
            //их находим, то в строку path мы их подставляем
            $internalRoute= preg_replace("~^$uriPattern$~", $path, $uri);
            $segments= explode('/', $internalRoute);//делим строку на две части по / 
            $controllerName= array_shift($segments).'Controller';//удаляет первое значение в массиве
            //и возварщает его
            $controllerName= ucfirst($controllerName);//делает первую букву заглавной
            $actionName='action'.ucfirst(array_shift($segments));
            //Подкдючить файл класса контроллера
            $param=$segments;
            $controllerFile=ROOT.'/controllers/'.$controllerName.'.php';
            if(file_exists($controllerFile))
            {
                include_once ($controllerFile);
            }
            $controllerObject=new $controllerName();
            if($param)
            $result= call_user_func_array(array($controllerObject,$actionName), $param);
        else {
            $result=$controllerObject->$actionName();
        }
            if($result!=null)
            {break;}
            
        }
        }
        
        //Cоздать объект , вызвать метод, (т.e. action) 
    }
}
