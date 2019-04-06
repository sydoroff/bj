<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/model/Task.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/myFunction.php');

/**
 * Class Controller - combines models and view
 */
abstract class Controller{

    private $html = null;

    /**
     * HTML pages makers. Used Twig template engine
     * files locate - '/view/'
     * files name like 'template-name.twig.php'
     * @param $name - Template name
     * @param array $arr - Array of some variables
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    function view($name,$arr = []){
        require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/Twig/Autoloader.php');
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT'].'/view/');
        $twig = new Twig_Environment($loader);
        $twig->addFunction('email_render', new Twig_Function_Function('email_render'));
        return $twig->render($name.'.twig.php', $arr);
    }

    function run(){
        echo $this->html;
    }

    function HTML($html){
        $this->html = $html;
        return $this;
    }

    function getHTML(){
        return $this->html;
    }
}