<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-cente position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Погода
                </div>

                <form action="{{ route('getWeatherForDate') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputDate">
                            Дата
                        </label>
                        <input type="date" class="form-control" id="exampleInputDate" name="date"  placeholder="Дата" value={{ $date }}>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        Отправить
                    </button>
                </form>


                @isset($temperature)

                <div class="row mt-5 font-weight-bold">
                    <div class="col-12">
                        <b> 
                            <?php // должна быть отдельная компонента, которая будет решать эту ситуацию ?>
                            @if(false === $temperature)
                            Нет данных о погоде за это число
                            @else
                            Температура {{ $temperature }} градусов
                            @endif
                        </b>
                    </div>
                </div>

                @endisset

                @isset($tableTemperatureLastNDays)
                <div class="row mt-5 font-weight-bold">
                    <?php // inline стили нехорошо?>                    
                    <div class="col-12" style='margin:0 auto; width: 50%;'>
                        {{ $tableTemperatureLastNDays }}
                    </div>
                </div>
                @endisset


            </div>
        </div>
    </body>
</html>
