{% extends 'app.php' %}
{% block content %}

{%if rand %}
<div class="alert alert-success" role="alert">Все хорошо</div>
{%endif%}
<form method="post">
    <div class="form-group">
        <label for="exampleFormControlInput1">Имя</label>
        <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Имя" value="{{fill['name']}}" readonly>
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Почта</label>
        <input name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" value="{{fill['email']}}" readonly>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="5"  placeholder="Текст Вашего задания" required>{{fill['text']}}</textarea>
    </div>

    <div class="form-check">
        <input name="status" class="form-check-input" type="checkbox" value="1" id="defaultCheck1"
               {%if fill['status']%}
                 checked
                {%endif%}>
        <label class="form-check-label" for="defaultCheck1">
            Выполненно
        </label>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
</form>
{% endblock %}