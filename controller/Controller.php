<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 17:29
 */
require_once ($_SERVER['DOCUMENT_ROOT'].'/model/Task.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/recaptcha.php');

class Controller{

    protected $html = null;

    function index($content = 'table'){

        $task = new Task();

        $_GET['page'] = abs(intval($_GET['page']));
        $_GET['count']  = abs(intval($_GET['count']));
        if(!in_array($_GET['sort'],$task->getFields())) $_GET['sort'] = 'id';
        if(!in_array($_GET['dir'],['asc','desc'])) $_GET['dir'] = 'asc';


        $task=$task->order($_GET['sort'],$_GET['dir'])->paginate($_GET['page'],$_GET['count'])->all();

        $mainHTML = include $_SERVER['DOCUMENT_ROOT'].'/view/'.$content.'.php';
        $mainHTML .= include $_SERVER['DOCUMENT_ROOT'].'/view/pagination.php';
        $this->html = include $_SERVER['DOCUMENT_ROOT'].'/view/app.php';

        return $this;
    }

    function newTask(){

        $error = null;

        if ($_POST["g-recaptcha-response"]) {
            $secret = "6LcoKpsUAAAAANC4U1U-BMfN_U0aE1X5GZlCY8Ad";
            $response = null;
            $reCaptcha = new ReCaptcha($secret);
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );

            if ($response != null && $response->success) {

                if(preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $_POST['email'])){
                $email=explode('@',$_POST['email']);
                   if (count($email)==2&&getmxrr($email[1],$arr))
                       $email=$_POST['email'];
                   else
                       $error[]= 'Email введен неверно!!!';
                } else $error[]= 'Email введен неверно!!!';

                if (!empty(trim($_POST['name'])))
                    $name=htmlspecialchars(strip_tags(trim($_POST['name'])));
                else
                    $error[]='Введите имя!!!';

                if (!empty(trim($_POST['text'])))
                    $text=htmlspecialchars(strip_tags(trim($_POST['text'])));
                else
                    $error[]='Введите задание!!!';

                if($error==null){
                    $task = new Task();
                        $id = $task->create(['name' => $name, 'email' => $email, 'text' => $text]);

                        $ins = $task->find($id);
                        $txt = "<h3>Новое задание</h3> для подтверждения пройдите по ссылке <a href='http://bj/confirm.php?key=".
                            urlencode($ins['hash'])."&id=".
                            urlencode(password_hash($id,PASSWORD_BCRYPT))."'>";
                        mail($ins['email'],'New task. No reply.',$txt);
                        header('Location: http://bbee.kl.com.ua/?sort=id&dir=desc');
                }
            }
        }

        if($error)
        foreach($error as $row){
            $mainHTML.= "<div class=\"alert alert-danger\" role=\"alert\">$row</div>";
        }

        $mainHTML.= include $_SERVER['DOCUMENT_ROOT'].'/view/form.php';
        $this->html = include $_SERVER['DOCUMENT_ROOT'].'/view/app.php';
        return $this;
    }

    function run(){
        echo $this->html;
    }
}