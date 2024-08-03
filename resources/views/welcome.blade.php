<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OpenWeatherMap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <div class="container">
        <div class="row col-md-12 p-5 justify-content-center">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title text-success">OpenWeatherMap</h5>
                    <form class="form-inline" action="{{ route('search') }}">
                        @csrf
                        <a href="{{ url('/') }}" class="btn btn-info mb-2">Refresh</a>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputText" class="sr-only">City Name</label>
                            <input type="text" class="form-control" id="inputText" value="{{ $name ?? '' }}"
                                name="city" placeholder="Enter your ciy name">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col" class="text-center text-success">#</th>
                        <th scope="col" class="text-center text-capitalize text-success">City Name</th>
                        <th scope="col" class="text-center text-success">Current Temperature in Celsius</th>
                        <th scope="col" class="text-center text-success">Weather Description</th>
                        <th scope="col" class="text-center text-success">Date and Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data))
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <td class="text-center">{{ $name }}</td>
                            <td class="text-center">{{ $temp - 273.15 }} &deg;C</td>
                            <td class="text-center text-capitalize">{{ $weather }}</td>
                            <td class="text-center">{{ $dateTime }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-warning">No data available. {{ $error ?? '' }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('error'))
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "left",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    },
                    onClick: function() {}
                }).showToast();
            @endif
        });
    </script>
</body>

</html>
