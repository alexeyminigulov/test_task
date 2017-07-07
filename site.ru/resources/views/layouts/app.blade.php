<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <title>Сотрудники</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="orange">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="orange">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="orange">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
</head>
<body>

    <header>
        <div class="top-panel">
            <div class="container">
                <div class="row margin-none top-header">
                    <div class="col s2">
                        <div class="input-field col s12">
                            <input type="date" class="datepicker" value="{{ $currentDate }}">
                        </div>
                    </div>
                    <div class="col s7">
                        <div class="input-field col s5 add-premium">
                            <select class="profession">
                            <option value="" disabled selected>Укажите должность</option>
                            @foreach($professions as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                            </select>
                            <label>Должность</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="premium" type="number" class="validate" min="1" step="1">
                            <label for="premium">Премия, <i class="fa fa-rub" aria-hidden="true"></i></label>
                        </div>
                        <div class="input-field col s3">
                            <a id="submit-add-premium" class="waves-effect waves-light btn">Выдать премию</a>
                        </div>
                    </div>
                    <div class="col s3">
                        <div class="input-field col s12  input-right">
                            <a class='dropdown-button btn' href='#' data-activates='dropdown1'>
                                Вылюта <i class="fa fa-rub" aria-hidden="true"></i>
                            </a>
                            <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="#!" data-currency="rub"><i class="fa fa-rub" aria-hidden="true"></i>Рубль</a></li>
                                <li><a href="#!" data-currency="dollar" data-usdcurs="{{ $usd_curs }}"><i class="fa fa-usd" aria-hidden="true"></i>Доллар</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <ul id="tabs-swipe-demo" class="tabs">
                    <li class="tab col s3"><a id="list-employees" class="active" href="#test-swipe-1">Список сотрудников</a></li>
                    <li class="tab col s3"><a id="add-employer" href="#test-swipe-2">Добавить сотрудника</a></li>
                </ul>
            </div>
        </div>
    </header>
        
    <main>
        @yield('content')
    </main>

    
    <!-- JavaScripts -->
    <script src="{{ asset('js/common.min.js') }}"></script>
</body>
</html>