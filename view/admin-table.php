<?php

$sort_dir = ['id' => 'asc',
             'name' => 'asc',
             'email' => 'asc',
             'status' => 'asc'];

if ($sort_dir[$_GET['sort']] === $_GET['dir']) $sort_dir[$_GET['sort']] = 'desc';

$html = <<<MYHTML
<div class="row">
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><a class="text-dark" href="/?sort=id&dir={$sort_dir['id']}"># </a></th>
        <th scope="col"><a class="text-dark" href="/?sort=name&dir={$sort_dir['name']}">Имя</a></th>
        <th scope="col"><a class="text-dark" href="/?sort=email&dir={$sort_dir['email']}">Почта</a></th>
        <th scope="col"><a class="text-dark" href="#">Задача</a></th>
        <th scope="col"><a class="text-dark" href="/?sort=status&dir={$sort_dir['status']}">Выполнение</a></th>
    </tr>
    </thead>
    <tbody>
MYHTML;
    foreach($task['row'] as $row) {
        if ($row['status']==1)
            $st=' class= "alert alert-success"';
        else
            $st=' class= "alert alert-danger"';
    $html.="<tr>
        <th scope=\"row\"><a href='/admin/edit.php?id=".$row['id']."'>".$row['id']."</a></th>
        <td>".$row['name']."</td>
        <td>".email_render($row['email'])." </td>
        <td>".nl2br($row['text'])."</td>
        <td $st>".$row['status']." &nbsp;&nbsp;</td>
    </tr>";
}

$html.="</tbody>
</table>
</div>";

    return $html;

    function email_render($email){
        $a = ['a','e','i','o','u','y'];
        $a = $a[rand(0,count($a)-1)];
        $email = str_replace($a,"<![if !IE]>$a<![endif]>",$email);
        $email = str_replace('@','&#64',$email);
        $email = str_replace('.','<![if !IE]>.<![endif]>',$email);
        return $email;
    }