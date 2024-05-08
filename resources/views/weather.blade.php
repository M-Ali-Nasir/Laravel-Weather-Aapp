<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-bottom: 60px;
            color: #f5f5f5;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #000000a8;

        }

        p.card-text {
            margin-top: -10px;
        }

        .card-body {
            color: #000000;
        }

        .card {
            background-color: #a7a7a7;
            box-shadow: #000000 1px 0px 10px 1px;
        }

        .row {
            margin-bottom: 100px;
        }
    </style>
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light text-dark sticky-top" style="background-color: #000000b4">
        <div class="container">
            <a class="navbar-brand text-light" href="#">Weather App</a>
        </div>
    </nav>
    <div class="container">
        <h1 class="mt-5 mb-4">Weather Application</h1>
        <div class="input-group mb-3">
            <form action="{{ route('weather.form') }}" method="post" class="form-inline">
                @csrf
                <div class="d-flex">
                    <div class="form-group">
                        <input class="form-control" placeholder="City Name (e.g., New York)" name="city"
                            id="city">

                    </div>
                    <button style="margin-left: 20px;" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <br>
                        @if (empty($data->weather))
                            <p>No weather information available</p>
                        @else
                            <h4 class="card-title">{{ $data->weather[0]->main }}</h4>
                            <br>
                            <h5 class="card-title">Looks Like {{ $data->weather[0]->description }}</h5>
                            <br>

                            @if ($data->weather[0]->main == 'Clear')
                                <img src="./images/clear.png" alt="" style="height: 100px;">
                            @elseif ($data->weather[0]->main == 'Clouds')
                                <img src="./images/cloud.png" alt="" style="height: 100px;">
                            @elseif ($data->weather[0]->main == 'Rain')
                                <img src="./images/rain.png" alt="" style="height: 100px;">
                            @elseif ($data->weather[0]->main == 'Haze')
                                <img src="./images/haze.png" alt="" style="height: 100px;">
                            @elseif ($data->weather[0]->main == 'Sunny')
                                <img src="./images/sunny.png" alt="" style="height: 100px;">
                            @elseif ($data->weather[0]->main == 'Thunderstorm')
                                <img src="./images/thunderStorm.png" alt="" style="height: 100px;">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Location Details</h5>
                        <br>
                        <p class="card-text">Country: {{ $data->sys->country ?? '--' }}</p>
                        <p class="card-text">City Name: {{ $data->name ?? '--' }}</p>
                        <p class="card-text">Latitude: {{ $data->coord->lat ?? '--' }}</p>
                        <p class="card-text">Longitude: {{ $data->coord->lon ?? '--' }}</p>
                        <p class="card-text">Sunrise: {{ $data->sys->sunrise ?? '--' }}</p>
                        <p class="card-text">Sunset: {{ $data->sys->sunset ?? '--' }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Temperature &deg; C</h5>
                        <br>
                        <p class="card-text">Temp:
                            {{ isset($data->main->temp) ? round($data->main->temp - 273.15, 2) : '--' }}</p>
                        <p class="card-text">Min Temp:
                            {{ isset($data->main->temp_min) ? round($data->main->temp_min - 273.15, 2) : '--' }}</p>
                        <p class="card-text">Max Temp:
                            {{ isset($data->main->temp_max) ? round($data->main->temp_max - 273.15, 2) : '--' }}</p>
                        <p class="card-text">Feels Like:
                            {{ isset($data->main->feels_like) ? round($data->main->feels_like - 273.15, 2) : '--' }}
                        </p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Precipitation &percnt;</h5>
                        <br>
                        <p class="card-text">Humidity: {{ $data->main->humidity ?? '--' }}</p>
                        <p class="card-text">Pressure: {{ $data->main->pressure ?? '--' }}</p>
                        <p class="card-text">Sea Level: {{ $data->main->sea_level ?? '--' }}</p>
                        <p class="card-text">Ground Level: {{ $data->main->grnd_level ?? '--' }}</p>
                        <p class="card-text">Visibility: {{ $data->visibility ?? '--' }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Wind m/h</h5>
                        <br>
                        <p class="card-text">Speed: {{ $data->wind->speed ?? '--' }}</p>
                        <p class="card-text">Degree: {{ $data->wind->deg ?? '--' }}</p>
                        <p class="card-text">Gust: {{ $data->wind->gust ?? '--' }}</p>
                    </div>
                </div>
            </div>
            <!-- Add more columns if needed -->
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <span class="text-light">© 2024 Weather App. All rights reserved.</span>
        </div>
    </footer>
</body>

</html>
