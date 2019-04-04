<?php

function email_render($email){
    $a = ['a','e','i','o','u','y'];
    $a = $a[rand(0,count($a)-1)];
    $email = str_replace($a,"<![if !IE]>$a<![endif]>",$email);
    $email = str_replace('@','&#64',$email);
    $email = str_replace('.','<![if !IE]>.<![endif]>',$email);
    return $email;
}

function check_email($email){
    if(preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $email)){
        $email=explode('@',$email);
        if (count($email)==2&&getmxrr($email[1],$arr))
            return true;
        else
            return false;
    } else
        return false;
}

function send_confirm_mail($adr,$hash,$id){

    $txt = "<h3>Новое задание</h3> для подтверждения пройдите по ссылке <a href='http://bj/confirm.php?key=".
        urlencode($hash)."&id=".
        urlencode(md5($id))."'>Подтвердить</a>";

    return mail($adr,'New task. No reply.',$txt);
}