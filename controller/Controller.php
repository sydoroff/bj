<?php



require_once ($_SERVER['DOCUMENT_ROOT'].'/model/Task.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/recaptcha.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/myFunction.php');

class Controller{

    private $html = null;

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
    }
}