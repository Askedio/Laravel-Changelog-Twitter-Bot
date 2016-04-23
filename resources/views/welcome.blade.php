<!DOCTYPE html>
<html>
    <head>
        <title>Laravel {{ $version }} Changelog from {{ $date }}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css" media="none" onload="if(media!='all')media='all'">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" media="none" onload="if(media!='all')media='all'">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" media="none" onload="if(media!='all')media='all'">
        <meta name="viewport" content="width=device-width">

        <style>
          html,body {
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

          body {
            background: #fb503b;
          }

          body,a {
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
            margin-bottom: 0;
            font-weight: 400;
            margin: 0;
            cursor: pointer;
          }

          .pretitle {
            margin: 10% 0 0;
            font-size: 24px;
          }

          .log {
            background: rgba(255,255,255,.95);
            border-radius: 6px;
            color: #000;
            position: absolute;
            top: 260px;
            width: 60%;
            left: 20%;
            height: calc(100% - 252px);
            overflow: hidden;
          }

          .log .details {
            overflow: auto;
            height: 98.5%;
            width: 100%;
            text-align: left;
          }

          .small {
            font-size: 10px;
          }

          .details .header {
            margin: 20px;
          }

          .details ul {
            list-style: none;
            margin: 0;
            padding: 0 20px;
            margin-bottom: 80px;
          }

          .details ul > li {
            border-bottom: 1px solid #999;
            clear: both;
            padding: 18px 0 10px 0;
            font-size: 15px
          }

          .details ul > li:first-of-type{
            padding-top: 0;
          }

          .details ul > li a {
            color: #000;
          }

          h3 {
            font-size: 26px;
            display: inline;
          }

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
            background: rgba(255,255,255,.1);
            border-radius: 6px;
            color:#fff;
          }

          .social a:not(:first-child):not(:last-child) {
            padding: 0 14px;
          }

          .details .fa-external-link {
            font-size: 10px;
            line-height: 20px;
          }

          input {
            width: calc(100% - 20px);
            border: 0;
            font-size: 16px;
            margin: 10px 10px 0;
            padding: 6px;
            background-color: transparent;
            outline: none;
            text-align: right;
            float:right;
            width: 50%;
          }

          .dropdown {
            position: relative;
            display: inline-block;
          }

          .dropdown-content {
            display: none;
            position: absolute;
            background: rgba(255,255,255,.9);
            width: 160px;
            max-height: 260px;
            overflow:hidden;
            margin-left: 53.33px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 6px;
          }

          .dropdown:hover .dropdown-content,.dropdown:active .dropdown-content,.dropdown:focus .dropdown-content {
            display: block;
          }

          .dropdown-content ul {
            list-style: none;
            padding: 0;
            margin:0;
            max-height: 260px;
            overflow: auto;
          }

          .dropdown-content ul > li {
            padding-bottom: 20px;
          }

          .dropdown-content ul > li a {
            color: #000;
            font-size: 32px;
            text-decoration: none;
          }

          @media only screen and (max-width: 480px) {
            .log {
                top: 140px;
                width: 80%;
                left: 10%;
                height: calc(100% - 132px);
            }

            h1 {
                font-size: 46px;
            }

            .versions {
                margin-top: 0;
            }

            .social {
                display: none;
            }

            .dropdown-content {
              width: 160px;
              position: absolute;
              top: 50px;
              left: calc(50% - 130px);
              max-height: 260px;
              overflow:hidden;
              box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
              z-index: 1;
              border-radius: 6px;
            }
          }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <p class="pretitle">Laravel</p>

                <div class="dropdown">
                  <h1 class="title">v{{ $version }}</h1>
                  <div class="dropdown-content">
                    <ul>
                      @foreach ($versions as $row)
                        @if($version != $row->version)<li><a href="{{ url($row->version) }}">v{{ $row->version }}</a></li>@endif
                      @endforeach
                    </ul>
                  </div>
                </div>

                <div class="date">Released <strong>{{ $date }}</strong> with <strong>{{ $totals }}</strong> changes.</div>

                <p></p>

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
                            <li>
                              <p>
                                @foreach($row->links() as $link)
                                  <a href="{{ $link }}" target="_github"><em class="fa fa-external-link"></em></a>
                                @endforeach
                                {{ $row->content }}
                              </p>
                            </li>
                          @endforeach
                        </ul>
                    @empty
                      <div class="header">
                        <h3>No Results.</h3>
                      </div>
                    @endforelse
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>