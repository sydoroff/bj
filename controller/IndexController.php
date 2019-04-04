<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 04.04.2019
 * Time: 16:41
 */
require_once ('Controller.php');

class IndexController extends Controller
{
    function index($content = 'table'){

        $task = new Task();

        $_GET['page'] = abs(intval($_GET['page']));
        $_GET['count']  = abs(intval($_GET['count']));
        if(!in_array($_GET['sort'],$task->getFields())) $_GET['sort'] = 'id';
        if(!in_array($_GET['dir'],['asc','desc'])) $_GET['dir'] = 'asc';

        if($content === 'table')
            $task=$task->scope(' verified = 1  ');

        $task=$task->order($_GET['sort'],$_GET['dir'])
            ->paginate($_GET['page'],$_GET['count'])
            ->all();

        $sort_dir = ['id' => 'asc',
            'name' => 'asc',
            'email' => 'asc',
            'status' => 'asc',
            'verified' => 'asc'
        ];

        if ($sort_dir[$_GET['sort']] === $_GET['dir']) $sort_dir[$_GET['sort']] = 'desc';

        $sort[$_GET['sort']] = $_GET['dir'];

        $this->HTML($this->view($content,['task' => $task, 'sort_dir' => $sort_dir, 'sort' => $sort]));

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

                if (check_email($_POST['email']))
                    $email=$_POST['email'];
                else
                    $error[]= 'Email введен неверно!!!';

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

                    send_confirm_mail($ins['email'],$ins['hash'],$id);
                }
            }else
                header('Location: http://'.$_SERVER['HTTP_HOST'].'/?sort=id&dir=desc');
        }
        if(isset($ins))
            $this->HTML($this->view('ok', ['email' => $ins['email']]));
        else
            $this->HTML($this->view('form',['post' => $_POST, 'error' => $error]));

        return $this;
    }

    function confirm(){
        if(isset($_GET['key'])&&isset($_GET['id'])){
            $task = new Task();
            $q = $task->scope("hash = '".htmlspecialchars(strip_tags(urldecode($_GET['key'])))."'")->all();
            if (count($q['row'])==1){
                if ((md5($q[0]['id'])==urldecode($_GET['id']))&&$q[0]['verified']!=1){
                    $res=$task->verify($q[0]['id']);
                }
            }
        }

        if(isset($res))
            $this->HTML($this->view('hello',['id' => $q[0]['id']]));
        else
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/?sort=id&dir=desc');

        return $this;
    }
}