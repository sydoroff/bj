<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Список заданий</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a class="text-dark" href="/">Список заданий</a></h5>
        <a class="btn btn-outline-primary" href="/add.php">Новое задание</a>
        <a class="btn btn-outline-primary" href="/admin/index.php">Админ</a>
    </div>
    <div class="container">

        {% block content %}{% endblock %}

    </div>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
    </footer>
</div>
</div>

</body>
</html>