<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BB9CC0;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #67729D;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .captcha-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .captcha img {
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .reload {
            font-size: 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .reload:hover {
            background-color: #c82333;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #007bff;

        }
        label {
            color: white;
        }
        h2{
            color:#164863;
        }
    </style>
</head>
<body>
    <h2 class="text-center mt-5">Laravel Captcha Defender</h2>
    <hr>
    <div class="container mt-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="post" action="{{url('captcha-validation')}}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="Password">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group mb-4">
                <div class="captcha-container">
                    <div class="captcha">
                        {!! captcha_img() !!}
                    </div>
                    <button type="button" class="reload" id="reload">
                        &#x21bb;
                    </button>
                </div>
            </div>
            <div class="form-group mb-4">
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha").html(data.captcha);
            }
        });
    });
</script>
</html>
