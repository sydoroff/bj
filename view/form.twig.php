{% extends 'app.twig.php' %}
{% block content %}

{% for err in error %}
    <div class="alert alert-danger" role="alert">{{err}}</div>
{%endfor%}

<form method="post" onsubmit="if(grecaptcha.getResponse().length == 0){{'{'}}alert('Пройдите reCAPTCHA!!!');return false;{{'}'}}">
  <div class="form-group">
    <label for="exampleFormControlInput1">Имя</label>
    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Имя" value="{{post['name']}}" required>
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Почта</label>
    <input name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{post['email']}}" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="5"  placeholder="Текст Вашего задания" required>{{post['text']}}</textarea>
  </div>

      <div class="g-recaptcha" data-sitekey="6LcoKpsUAAAAABW65v3JTOXk_EajujvcTWseV8YY"></div>
      <br/>
      <button type="submit" class="btn btn-primary mb-2" name="submit" value="1">Отправить</button>
</form>
{% endblock %}