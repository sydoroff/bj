{% extends 'app.php' %}
{% block content %}
<div class="row">
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><a class="text-dark" href="/?sort=id&dir={{sort_dir['id']}}"># </a>
        {%if sort['id']%}
            {%if sort['id']=='asc'%}
                &#9660;
            {%else%}
                &#9650;
            {%endif%}
        {%endif%}
        </th>
        <th scope="col"><a class="text-dark" href="/?sort=name&dir={{sort_dir['name']}}">Имя</a>
        {%if sort['name']%}
            {%if sort['name']=='asc'%}
                &#9660;
            {%else%}
                &#9650;
            {%endif%}
        {%endif%}
        </th>
        <th scope="col"><a class="text-dark" href="/?sort=email&dir={{sort_dir['email']}}">Почта</a>
        {%if sort['email']%}
            {%if sort['email']=='asc'%}
                &#9660;
            {%else%}
                &#9650;
            {%endif%}
        {%endif%}
        </th>
        <th scope="col"><a class="text-dark" href="#">Задача</a></th>
        <th scope="col" class="w-5"><a class="text-dark" href="/?sort=status&dir={{sort_dir['status']}}">Выполнение</a>
        {%if sort['status']%}
            {%if sort['status']=='asc'%}
                &#9660;
            {%else%}
                &#9650;
            {%endif%}
        {%endif%}
        </th>
    </tr>
    </thead>
    <tbody>
    {% for row in task['row'] %}
    <tr>
        <th scope="row">{{row['id']}}</th>
        <td>{{row['name']}}</td>
        <td>{{email_render(row['email'])|raw}}</td>
        <td>{{row['text']|nl2br}}</td>
        <td>
            {%if row['status']==1%}
                <span class="text-success">Выполненно</span>
            {%else%}
                <span class="text-danger">Нет</span>
            {%endif%}
        </td>
    </tr>

    {% endfor %}

    </tbody>
</table>
    {{task['pagination']['pages']|raw}}
</div>
{% endblock %}