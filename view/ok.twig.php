{% extends 'app.php' %}
{% block content %}

<div class="alert alert-success" role="alert">
    <h3>Активация задания</h3>
    <p>
        На указанный Вами почтовый ящик: {{email}}, отправлено письмо.<br>
        Следуйте инструкциям в нём.
    </p>
    <p>
        <a href="/">На главную</a>
    </p>
</div>
{% endblock %}