<!DOCTYPE html>
<html>
    <head>
        <title>Laravel {{ $version }} Changelog from {{ $date }}</title>

        <meta name="viewport" content="width=device-width">

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
                font-size: 86px;
                margin-bottom:0;
                font-weight: normal;
                margin:0;
            }

            .pretitle{margin: 10% 0 0 0;font-size: 24px}

            .log{
              background: rgba(255,255,255,.95);
              border-radius: 6px;
              color: #000;
              position: absolute;
              top: 290px;
              width: 60%;
              left: 20%;
              height: calc(100% - 282px);
            }
            .log .details {
              overflow: auto;
              height: 98.5%;
              width: 100%;
              text-align:left;

            }
            .small{font-size:10px}

            .details .header { margin: 20px}
            .details ul{
              list-style:none;
              margin: 0;
              padding: 0 20px 0 20px;

            }
            .details ul > li{

              border-bottom: 1px solid #999;
              clear:both;
            }

            .details ul > li  a {
              color: #000;
            }
            h3{font-size:26px;display:inline}


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
              font-size: 24px;
              background-color: rgba(255,255,255,.1);
              border-radius: 6px;
            }
            .social a:not(:first-child):not(:last-child){
              padding: 0 14px 0 14px;
            }

            .details .fa-external-link{font-size: 10px;line-height:20px}
            .versions{font-size:10px;margin-top:-12px;margin-bottom:10px;}
            .versions a{padding: 0 3px 0 3px;text-decoration: none}


            @media only screen and (max-width : 480px) {
              .log{
                width: 90%;
                left: 5%;
              }
              h1 {
                font-size: 46px;
              }
              .versions{
                margin-top:0px;
              }

            }
            .title span{
              font-size: 24px;
              float:right;
              clear:both;
              display:block;
              margin-top: 24px;
              width:18px;
              display:none;
            }

            .title span em{
              float:right;
              clear:both;
            }

            input{
              width: calc(100% - 20px);
              border:0;
              font-size: 16px;
              margin: 10px 10px 0 10px;
              padding: 6px;
              background-color: transparent;
            }

        </style>
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <div class="container">
            <div class="content">
                <p class="pretitle">Laravel</p>
                <h1 class="title">v{{ $version }}</h1>
                <div class="versions">
                  @foreach ($versions as $vers)
                    @if($version != $vers->version)<a href="{{ url($vers->version) }}">{{ $vers->version }}</a>@endif
                  @endforeach
                </div>
                <div class="date">Released: {{ $date }}</div>
                <h2 class="small">&nbsp;</h2>

                <div class="social">
                  <a href="https://github.com/laravel/framework/blob/5.2/CHANGELOG.md" target="_social"><em class="fa fa-fw fa-external-link"></em></a>
                  <a href="https://twitter.com/laravellog" target="_social"><em class="fa fa-twitter"></em></a>
                  <a href="https://github.com/Askedio/Laravel-Changelog-Twitter-Bot" target="_social"><em class="fa fa-github"></em></a>
                  <a href="{{ url('latest.rss') }}" target="_social"><em class="fa fa-rss"></em></a>
                  <a href="{{ url('latest.json') }}" target="_social"><em class="fa fa-code"></em></a>
                </div>


                <div class="log">
                  <div class="details">

                    <form method="get">
                      <input type="search" name="q" placeholder="Search" value="{{ $q }}">
                    </form>

                    @forelse ($changes as $type => $result)
                        <div class="header">
                          <h3>{{ $type }}</h3> <span>{{ count($result) }}</span>
                        </div>
                        <ul>
                          @foreach ($result as $row)
                            <li><p>{!! preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" target="_github"><em class="fa fa-external-link"></em></a>', $row->content) !!}</p></li>
                          @endforeach
                        </ul>
                    @empty
                      <div class="header">
                        <h3>No Results.</span>
                      </div>
                    @endforelse
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>