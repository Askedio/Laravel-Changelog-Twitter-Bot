<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-family: 'Lato';
                overflow: hidden;
            }

            body{
                background: #fb503b;
            }
            body, a{
                color: #fff;
            }

            .container {
                text-align: center;

            }

            .content {
                text-align: center;
                display: inline-block;
            }

            h1 {
                font-size: 96px;
                margin-top: 20%;
                margin-bottom:0;
                font-weight: normal
            }
            .log{
              background: rgba(255,255,255,.95);
              border-radius: 6px;
              color: #000;
              position: absolute;
              bottom: -6px;
              width: 50%;
              left: 25%;
              height: 60%;
            }
            .log .details {
              overflow: auto;
              height: 98.5%;
              width: 100%;
              text-align:left;

            }
            .small{font-size:11px}

            .details .header { margin: 20px}
            .details ul{
              list-style:none;
              margin: 0;
              padding: 0 20px 0 20px;

            }
            .details ul > li{

              border-bottom: 1px solid #999
            }

            .details ul > li  a {
              color: #000;
            }
            h3{display:inline}

            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-track {
              border-top-right-radius: 6px;
            }

            ::-webkit-scrollbar-thumb {
                -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,0.5);
            }
            .social {
              padding: 10px;
              font-size: 28px
            }
            .social a:nth-child(2){
              padding: 0 20px 0 20px;
            }

            @media only screen and (max-width : 480px) {
              .log{
                width: 90%;
                left: 5%;
              }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1 class="title">{{ $version }}</h1>
                <div class="date">{{ $date }}</div>
                <h2 class="small">Twitter Changelog Bot By <a href="https://twitter.com/asked_io">William Bowman</a></h2>

                <div class="social">
                  <a href="https://twitter.com/laravellog" target="_social"><em class="fa fa-twitter"></em></a>
                  <a href="https://github.com/Askedio/Laravel-Changelog-Twitter-Bot" target="_social"><em class="fa fa-github"></em></a>
                  <a href="?json=true" target="_social"><em class="fa fa-code"></em></a>
                </div>

                <div class="log">
                  <div class="details">
                    @foreach ($changes as $type => $result)
                        <div class="header">
                          <h3>{{ $type }}</h3> {{ count($result) }}
                        </div>
                        <ul>
                          @foreach ($result as $row)
                            <li><p>{!! preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" target="_github">$3</a>', $row->content) !!}</p></li>
                          @endforeach
                        </ul>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>