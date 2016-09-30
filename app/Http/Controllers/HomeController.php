<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class HomeController extends Controller
{
    protected $log;

    protected $version;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    private function getRecords($version = 'latest')
    {
        $results = [
          'Added'   => [],
          'Changed' => [],
          'Fixed'   => [],
          'Removed' => [],
        ];

        $author = false;

        $authors = [];

        if ($version !='latest' && !preg_match('/^(\d+\.)?(\d+\.)?(\*|\d+)$/s', $version)) {
            $author = \App\Author::where('name', $version)->with('logs')->firstOrFail();
            $version = 'latest';
        }

        $version = $version != 'latest'
            ? \App\Version::where('number', '=', $version)->firstOrFail()
            : \App\Version::orderBy('number', 'desc')->first();

        $rows = $author
                ? $author->logs()
                : $version->logs()->with('authors');

        if (request()->has('q')) {
            $rows->where('content', 'LIKE', '%'.request()->input('q').'%');
        }

        foreach ($rows->get() as $row) {
            $results[$row->type][] = $row;
            if(!empty($row->authors[0])){
              $authors[$row->authors[0]->name] = $row->authors[0];
            }
        }

        return [
          'author'     => $author,
          'authors'    => $authors,
          'version'    => $version->number,
          'date'       => $version->date,
          'totals'     => $rows->count(),
          'changes'    => array_filter($results),
          'q'          => htmlentities(request()->input('q')),
        ];
    }

    public function versions()
    {
        return \App\Version::orderBy('id', 'desc')->limit(20)->get();
    }

    public function index()
    {

        $featured = \App\Author::with('logs')->get()->sortByDesc(function($row){
            return $row->logs->count();
        })->first();


        return view('welcome')->with(array_merge($this->getRecords(), ['featured' => $featured, 'versions' => $this->versions()]));
    }

    public function show($version)
    {

        if (request()->is('*.json')) {
          return $this->getJson(basename($version, '.json'));
        }

        if (request()->is('*.rss')) {
          return $this->getRss(basename($version, '.rss'));
        }

        return view('welcome')->with(array_merge($this->getRecords($version), ['versions' => $this->versions()]));
    }

    public function getJson($version)
    {
        return $this->getRecords($version);
    }

    public function getRss($version)
    {
        $feed = \App::make('feed');

        $posts = $this->getRecords($version);

        $feed->title = 'Laravel Change Log';
        $feed->description = 'RSS Feed for Laravel Changelog.';
        $feed->setDateFormat('datetime');
        $feed->lang = 'en';
        $feed->setTextLimit(100);

        foreach ($posts['changes'] as $post) {
            foreach ($post as $row) {
                $feed->add('Laravel '.$row->version->number, false, $row->link, $row->updated_at, $row->type, $row->content);
            }
        }

        return $feed->render('atom');
    }
}
