<?php
class Route {
    static function start(){

        $router = array(
            'index'=>array(
                'controller'=>'main',
                'action'    =>'index',
                'tupe'      =>"a",
            ),
            'zadanie1'=>array(
                'controller'=>'main',
                'action'    =>'zadanie1',
                'tupe'      =>"a",
            ),
            'zadanie2'=>array(
                'controller'=>'main',
                'action'    =>'zadanie2',
                'tupe'      =>"a",
            ),
            'zadanie3'=>array(
                'controller'=>'main',
                'action'    =>'zadanie3',
                'tupe'      =>"a",
            ),
            'zadanie4'=>array(
                'controller'=>'main',
                'action'    =>'zadanie4',
                'tupe'      =>"a",
            ),
            'get_produkt'=>array(
                'controller'=>'main',
                'action'    =>'get_produkt',
                'tupe'      =>"a",
            ),
            'get_link'=>array(
                'controller'=>'main',
                'action'    =>'get_link',
                'tupe'      =>"a",
            ),
            'get_first_element'=>array(
                'controller'=>'main',
                'action'    =>'get_first_element',
                'tupe'      =>"a",
            ),
            'get_count'=>array(
                'controller'=>'main',
                'action'    =>'get_count',
                'tupe'      =>"a",
            ),
            'get_first_element_Z3'=>array(
                'controller'=>'main',
                'action'    =>'get_first_element_Z3',
                'tupe'      =>"a",
            ),
            'get_count_Z3'=>array(
                'controller'=>'main',
                'action'    =>'get_count_Z3',
                'tupe'      =>"a",
            ),
            'get_first_element_Z4'=>array(
                'controller'=>'main',
                'action'    =>'get_first_element_Z4',
                'tupe'      =>"a",
            ),
            'get_count_Z4'=>array(
                'controller'=>'main',
                'action'    =>'get_count_Z4',
                'tupe'      =>"a",
            ),



            'defaults' => array(
                'controller'=> 'main',
                'action'    => 'index',
                'tupe'     =>"a",
            ),
            '404' => array(
                'controller'=> 'main',
                'action'    => 'error',
                'tupe'     =>"a",
            ),

        );

        $request = $_SERVER['REQUEST_URI'];
        $routes = explode('/',trim($request,'/'));
        $controller_name = $router ['defaults']['controller']; //контролер
        $action_name = $router ['defaults']['action'];        //екшен

        if($routes[0]!=''){//$routes[0] дивимося чи порожній

            if (!array_key_exists($routes[0], $router)) { // $routes[0] якщо його нема в $router значить такої сторінки нема
                header( 'Location:/404' );
                exit;
            }else{
                if(isset($routes[1])){ //якщо існує друга секція



                if(array_key_exists('sub', $router[$routes[0]])){
                    if(isset($router[$routes[0]]['sub'][$routes[1]])){
                        foreach ($router[$routes[0]]['sub'][$routes[1]] as $value) {
                        if($value==$routes[1]){
                         $controller_name = $router[$routes[0]]['sub'][$value]['controller'];
                         $action_name = $router[$routes[0]]['sub'][$value]['action'];
                         $url_tupe = $router[$routes[0]]['sub'][$value]['tupe'];
                        }
                    }
                    }else{
                        $controller_name = $router['404']['controller'];
                         $action_name = $router['404']['action'];
                         $url_tupe = $router['404']['tupe'];
                    }

                }
                }else{

                  foreach ($routes as $value) {
                    if($routes[0]==''){$routes[0]='defaults';}//якщо blog.ua без парам то по замовчуванню
                    //echo $routes[0];

                    if($value==$routes[0]){
                        $controller_name = $router [$value]['controller'];
                        $action_name = $router [$value]['action'];
                        $url_tupe = '$router [$value][tupe]';
                        }
                    }
                }

                switch ($url_tupe) {
                    case"a":
                        if(!empty($routes[1])){
                            $key  = array();
                            $values = array();
                            for($i=1,$cnt=count($routes);$i<$cnt;$i++){
                                if($i%2!=0){
                                    $key[] = $routes[$i];
                                }else{
                                    $values[] = $routes[$i];
                                }
                            }
                            if (count($key) == count($values)) {
                                $param = array_combine($key, $values);//заганяємо параметри в масив якщо вони задані
                            }
                        }
                        if(!isset($param['page'])){$param['page']=1;}//перевіряємо чи є параметри
                        break;
                    case "b":
                        if(!empty($routes[0])){
                            $key  = array();
                            $values = array();
                            for($i=0,$cnt=count($routes);$i<$cnt;$i++){
                                if($i%2==0){
                                    $key[] = $routes[$i];
                                }else{
                                    $values[] = $routes[$i];
                                }
                            }
                            if (count($key) == count($values)) {
                                $param = array_combine($key, $values);//заганяємо параметри в масив якщо вони задані
                            }
                        }
                        break;
                }

            }
        }
        // додаємо префікси
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
        // створюємо контроллер
        $controller = new $controller_name();
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            if(!isset($param['page'])){$param['page']=1;}//перевіряємо чи є параметри
            //print_r($param);
            $controller->$action($param);
        }
        else
        {
            echo 'сторінка не існує';
        }
    }
}
