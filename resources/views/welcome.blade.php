@extends('template')
@section('content')
  @if(!empty($featured))
    <div class="featured">
        <a href="{{ url($featured->name) }}"><img src="{{ $featured->avatar }}" title="{{ $featured->name }}"></a>
        <strong>#1 Contributor</strong><br>
        {{ '@'.$featured->name }}

        <p>@if($featured->website)
          <a href="{{ $featured->website }}" target="_social"><em class="fa fa-fw fa-external-link"></em></a>
        @endif
        <a href="{{ $featured->url }}" target="_social"><em class="fa fa-fw fa-github"></em></a>
        <a href="https://twitter.com/{{ $featured->twitter ?: $featured->name }}" target="_social"><em class="fa fa-fw fa-twitter"></em></a></p>

    </div>
  @endif


  <div class="container">
      <div class="content">
          <p class="pretitle">Laravel
            @if($author) Author
            @endif
          </p>

          <div class=" @if(!$author) dropdown @endif ">
            <h1 class="title">
              @if($author)
                 {{ '@'.$author->name}} <img src="{{ $author->avatar }}" title="{{ $author->name }}">
              @else
                v{{ $version }}
              @endif
            </h1>
            <div class="dropdown-content">
              <ul>
                @foreach ($versions as $row)
                  @if($version != $row->number)<li><a href="{{ url($row->number) }}">v{{ $row->number }}</a></li>@endif
                @endforeach
              </ul>
            </div>
          </div>

          <div class="date">
            @if($author)
               I've released a total of <strong>{{ $author->logs->count() }}</strong> changes, the last one was <strong>{{ $author->logs->first()->created_at->diffForHumans() }}</strong>.
            @else
              Released <strong>{{ $date }}</strong> with <strong>{{ $totals }}</strong> changes.
            @endif
          </div>

          <p></p>

          <div class="social">
            @if($author)
                <a href="{{ url('/') }}"><em class="fa fa-fw fa-home"></em></a>
              @if($author->website)
                <a href="{{ $author->website }}" target="_social"><em class="fa fa-fw fa-external-link"></em></a>
              @endif
              <a href="{{ $author->url }}" target="_social"><em class="fa fa-fw fa-github"></em></a>
              <a href="https://twitter.com/{{ $author->twitter ?: $author->name }}" target="_social"><em class="fa fa-fw fa-twitter"></em></a>
            @else
              <a href="https://github.com/laravel/framework/blob/5.2/CHANGELOG.md" target="_social"><em class="fa fa-fw fa-external-link"></em></a>
              <a href="https://twitter.com/laravellog" target="_social"><em class="fa fa-fw fa-twitter"></em></a>
              <a href="{{ url('contributors') }}"><em class="fa fa-fw fa-users"></em></a>
              <a href="{{ url($version .'.rss') }}" target="_social"><em class="fa fa-fw fa-rss"></em></a>
              <a href="{{ url($version .'.json') }}" target="_social"><em class="fa fa-fw fa-code"></em></a>
            @endif

          </div>

          <div class="spam">
               Created by <a href="https://asked.io" target="_blank">asked.io</a> <a href="https://twitter.com/asked_io" target="_blank"><em class="fa fa-twitter"></em></a> &amp; <a href="http://goo.gl/QsjtV7" target="_blank">hosted for $3</a>.
          </div>

          <div class="log">

            @if(!$author)
              <div class="authors">
                  @foreach ($authors as $author)
                      <a href="{{ url($author->name) }}"><img src="{{ $author->avatar }}" title="{{ $author->name }}"></em></a>
                  @endforeach
              </div>
            @endif

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
                      <li class="clearfix">
                        <div>
                          @foreach($row->links() as $link)
                            <a href="{{ $link }}" target="_github"><em class="fa fa-external-link"></em></a>
                          @endforeach
                          {{ $row->content }}
                        </div>
                        <div>
                          @if(!$author)
                            @foreach($row->authors as $author)
                              <a href="{{ $author->url }}" target="_github"><img src="{{ $author->avatar }}" title="{{ $author->name }}"></em></a>
                            @endforeach
                          @endif

                        </div>
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
@endsection