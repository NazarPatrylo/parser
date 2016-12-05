<?php

class Controller_Main extends Controller
{
    public $data_arr;
        function __construct(){
            $this->view = new View();
        }
        function action_index(){
            $this->view->generate('main.php', 'template.php',$this->data_arr);
        }
        function action_zadanie1(){
            $this->view->generate('zadanie1.php', 'template.php',$this->data_arr);
        }
        function action_zadanie2(){
            $this->view->generate('zadanie2.php', 'template.php',$this->data_arr);
        }
        function action_zadanie3(){
            $obj = new GetProdukt();
            $this->view->generate('zadanie3.php', 'template.php',$this->data_arr);
        }
        function action_get_produkt(){
            $obj = new GetProdukt();
            $obj->addToDB();
        }
        function action_get_link(){
            $obj = new GetProdukt();
            $obj->getLink();
        }


        function action_get_first_element(){
            $obj = new GetProdukt();
            $obj->getElement();
            $obj->setLog();
        }
        function action_get_count(){
            $obj = new GetProdukt();
            $obj->getCountElement();
            $obj->setLog();
        }



        function action_get_first_element_Z3(){
            $obj = new GetProdukt();
            //echo $obj->getCountLogiIP();
            if($obj->getCountLogiIP()<=3 ){
                $obj->getElement();
                $obj->setLog();
            }else{
                echo 'limit';
            }
        }
        function action_get_count_Z3(){
            $obj = new GetProdukt();
            if($obj->getCountLogiIP()<=3){
                $obj->getCountElement();
                $obj->setLog();
            }
        }



        function action_zadanie4(){
            $this->view->generate('zadanie4.php', 'template.php',$this->data_arr);
        }

        function action_get_first_element_Z4(){
            $obj = new GetProdukt();
            //echo $obj->getCountLogiIP();
            if($obj->getCountLogiIP()<=300 ){
                $obj->getElementFormat();
                $obj->setLog();
            }else{
                echo 'limit';
            }
        }
        function action_get_count_Z4(){
            $obj = new GetProdukt();
            if($obj->getCountLogiIP()<=300){
                $obj->getCountElementFormat();
                $obj->setLog();
            }
        }


}
