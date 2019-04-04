{% extends 'app.php' %}
{% block content %}

<div class="alert alert-success" role="alert">
    <h3>Ваше задание добавлено</h3>
    <p>
        Номер Вашего задания: {{id}}
    </p>
    <p>
        <a href="/">На главную</a>
    </p>
</div>
{% endblock %}