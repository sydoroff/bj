<?php

function email_render($email){
    $a = ['a','e','i','o','u','y'];
    $a = $a[rand(0,count($a)-1)];
    $email = str_replace($a,"<![if !IE]>$a<![endif]>",$email);
    $email = str_replace('@','&#64',$email);
    $email = str_replace('.','<![if !IE]>.<![endif]>',$email);
    return $email;
}