<!DOCTYPE html>
<html>
    <head>
        <title>Laravel
          @yield('title')
          @if(isset($version))
            {{ $version }} Changelog from {{ $date }}
          @endif
        </title>

        <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css" media="none" onload="if(media!='all')media='all'">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" media="none" onload="if(media!='all')media='all'">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" media="none" onload="if(media!='all')media='all'">
        <meta name="viewport" content="width=device-width">

        @include('css')

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-64399123-2', 'auto');
          ga('send', 'pageview');
        </script>
    </head>
    <body>
      @yield('content')
    </body>
</html>