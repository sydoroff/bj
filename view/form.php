<?php
/**
 * Created by PhpStorm.
 * User: юзер
 * Date: 31.03.2019
 * Time: 22:14
 */

$html = <<<MYHTML

<form method="post" onsubmit="if(grecaptcha.getResponse().length == 0){alert('Пройдите reCAPTCHA!!!');return false;}">
  <div class="form-group">
    <label for="exampleFormControlInput1">Имя</label>
    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Имя" value="{$_POST['name']}" required>
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Почта</label>
    <input name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{$_POST['email']}" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="5"  placeholder="Текст Вашего задания" required>{$_POST['text']}</textarea>
  </div>

      <div class="g-recaptcha" data-sitekey="6LcoKpsUAAAAABW65v3JTOXk_EajujvcTWseV8YY"></div>
      <br/>
      <button type="submit" class="btn btn-primary mb-2">Отправить</button>
</form>

MYHTML;

return $html;
