<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <style>
        .nav-link  {
            color: #2f313a !important;
        }
        .active {
            background-color: #eaeaea;

        }
    </style>
</head>
<body style="background: #ebedf3 !important; margin: 15px;">
<div class="container">
    <div class="row" >
        <div class="col-md-3">
            <div style="background: #fff;">
                <ul class="nav flex-column" >
                    <li class="nav-item">
                        <a class="nav-link active" href=""><i class="fa fa-bell"></i>&nbsp;Новые заказы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-check-circle"></i>&nbsp;Принятые заказы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div style="background: #fff; padding: 15px;">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="color: red">#</th>
                        <th>Имя</th>
                        <th>Номер</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color: red">#1</td>
                            <td>Александр</td>
                            <td>+7 (978) 000-06-06</td>
                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                        </tr>
                        <tr>
                            <td style="color: red">#2</td>
                            <td>Александр</td>
                            <td>+7 (978) 000-06-06</td>
                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                        </tr>
                        <tr>
                            <td style="color: red">#3</td>
                            <td>Александр</td>
                            <td>+7 (978) 000-06-06</td>
                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                        </tr>
                        <tr>
                            <td style="color: red">#4</td>
                            <td>Александр</td>
                            <td>+7 (978) 000-06-06</td>
                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                        </tr>

                    </tbody>
                </table>
                <div class="text-center">
                    <div style="background: url({{asset('assets/img/emoji.png')}}) no-repeat center; width: 100%; height: 50vh; background-size: contain;"></div>
                    <h3>На сегодня заказов нет</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
