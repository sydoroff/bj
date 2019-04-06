<?php
$$html = "
<html>
<head>
    <title>Новое задание</title>
</head>
<body><p>
    <font color='#FF0000'>Если Вы не понимаете о чем речь, просто удалите это письмо.</font></p></hr>
<p align='center' width='100%'><h1>Новое задание.</h1>
Для подтверждения пройдите по ссылке:<br> <h3>
    <a href='http://".$_SERVER['HTTP_HOST']."/confirm.php?key=$hash&id=$id'>Активировать задание</a></h3><hr><br></p>
http://".$_SERVER['HTTP_HOST']."/confirm.php?key=$hash&id=$id";

$html.="</"."bo"."dy"."></"."ht"."ml>";

return $html;