<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    private function getRecords($version = 'latest')
    {
        $results = [];

        $log = $this->log->distinct('version');

        $version = $version != 'latest'
            ? \App\Version::where('number', '=', $version)->firstOrFail()
            : \App\Version::first();

        $rows = $version->logs();

        if (request()->has('q')) {
            $rows->where('content', 'LIKE', '%'.request()->input('q').'%');
        }

        $results = [
          'Added'   => [],
          'Changed' => [],
          'Fixed'   => [],
          'Removed' => [],
        ];

        $rows = $rows->get();

        foreach ($rows as $row) {
            $results[$row->type][] = $row;
        }

        return [
          'version'    => $version->number,
          'date'       => $version->date,
          'totals'     => $rows->count(),
          'changes'    => array_filter($results),
          'q'          => request()->input('q'),
        ];
    }

    public function versions()
    {
        return \App\Version::limit(20)->get();
    }

    public function index()
    {
        return view('welcome')->with(array_merge($this->getRecords(), ['versions' => $this->versions()]));
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
