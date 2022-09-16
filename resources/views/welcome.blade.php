<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZID API</title>

    <!-- Fav Icon -->
    <link rel="icon"
          type="image/png"
          sizes="16x16"
          href="//static.hsappstatic.net/StyleGuideUI/static-3.270/img/sprocket/favicon-16x16.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            margin: 0;
            font-weight: 400;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .zid-span {
            color: #714990;
        }

        .api-span {
            color: #FFD14B;
        }

        .zid-logo {
            margin-bottom: 50px;
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
            font-size: 50px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="zid-logo">
            <img width="200" src="https://zid.sa/wp-content/uploads/2022/07/zid-logo-300x162.png" alt="Zid Logo">
        </div>
        <div class="title m-b-md">
            We are a proud to introduce
            <br>
            <span class="zid-span">ZID</span>
            <span class="api-span">API</span>
        </div>
    </div>
</div>
</body>
</html>
