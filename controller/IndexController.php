<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 04.04.2019
 * Time: 16:41
 */
require_once ('Controller.php');

/**
 * Class IndexController - user part
 */
class IndexController extends Controller
{
    /**
     * Generated index page for admin and user
     * @param string $content
     * @return $this
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    function index($content = 'table'){

        $task = new Task();

        $_GET['page'] = abs(intval($_GET['page']));
        $_GET['count']  = abs(intval($_GET['count']));
        if(!in_array($_GET['sort'],$task->getFields())) $_GET['sort'] = 'id';
        if(!in_array($_GET['dir'],['asc','desc'])) $_GET['dir'] = 'asc';

        $task=$task->order($_GET['sort'],$_GET['dir'])
            ->paginate($_GET['page'],$_GET['count'])
            ->all();

        $sort_dir = ['id' => 'asc',
            'name' => 'asc',
            'email' => 'asc',
            'status' => 'asc',
        ];

        if ($sort_dir[$_GET['sort']] === $_GET['dir']) $sort_dir[$_GET['sort']] = 'desc';

        $sort[$_GET['sort']] = $_GET['dir'];

        $this->HTML($this->view($content,['task' => $task, 'sort_dir' => $sort_dir, 'sort' => $sort]));

        return $this;
    }

    /**
     * Add new task page
     * @return $this
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    function newTask(){

        $error = null;

            if ($_POST['submit']==1) {

                if(!check_captcha()) $error[]='Пройдите проверку капчи!!!';

                if (check_email($_POST['email']))
                    $email=$_POST['email'];
                else
                    $error[]= 'Email введен неверно!!!';

                if (!empty(trim($_POST['name'])))
                    $name=htmlspecialchars(strip_tags(trim($_POST['name'])),ENT_QUOTES);
                else
                    $error[]='Введите имя!!!';

                if (!empty(trim($_POST['text'])))
                    $text=htmlspecialchars(strip_tags(trim($_POST['text'])),ENT_QUOTES);
                else
                    $error[]='Введите задание!!!';

                if($error==null){
                    $task = new Task();
                    $id = $task->create(['name' => $name, 'email' => $email, 'text' => $text]);

                    $ins = $task->find($id);
                }
            }

        if(empty($ins))
            $this->HTML($this->view('form',['post' => $_POST, 'error' => $error]));
        else
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/confirm.php?key='.urlencode($ins['hash']).
                    '&id='.urlencode(md5($ins['id'])));

        return $this;
    }

    /**
     * Congratulation page
     * @return $this
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    function confirm(){
        if(isset($_GET['key'])){
            $task = new Task();
            $q = $task->
                scope("hash = '".htmlspecialchars(strip_tags(urldecode($_GET['key'])),ENT_QUOTES)."'")
                ->all();

            if(md5($q['row'][0]['id'])==urldecode($_GET['id']))
                $this->HTML($this->view('hello',['id' => $q['row'][0]['id']]));
            return $this;
        }

        header('Location: http://'.$_SERVER['HTTP_HOST'].'/?sort=id&dir=desc');

        return $this;
    }
}