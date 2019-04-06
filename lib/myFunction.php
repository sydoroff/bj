<?php
/**
 * makes emails it difficult to search for bots
 * @param $email
 * @return mixed
 */
function email_render($email){
    $a = ['a','e','i','o','u','y'];
    $a = $a[rand(0,count($a)-1)];
    $email = str_replace($a,"<![if !IE]>$a<![endif]>",$email);
    $email = str_replace('@','&#64',$email);
    $email = str_replace('.','<![if !IE]>.<![endif]>',$email);
    return $email;
}

/**
 * checks captcha
 * @param string $name - Name of post var where state response
 * @return bool
 */
function check_captcha($name = 'g-recaptcha-response'){

    require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/recaptcha.php');

    if (empty($_POST[$name])) return false;

    $secret = include 'key.php';
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST[$name]
    );

    if (empty($response)) return false;

    if ($response->success) return true;
}

/**
 * simply validate email
 * @param $email
 * @return bool
 */
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

/**
 * This function is disabled, at your request
 * @param $adr
 * @param $hash
 * @param $id
 * @return bool
 */
function send_confirm_mail($adr,$hash,$id){

        $hash = urlencode($hash);
        $id = urlencode(md5($id));

        $txt = include $_SERVER['DOCUMENT_ROOT'].'/view/mail.php';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $subject = 'New task. No reply.';

    return mail($adr, $subject, $txt, $headers);
}