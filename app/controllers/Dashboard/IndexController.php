<?php
namespace App\Controllers\Dashboard;

class IndexController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        $feed = array();
		try {
			$rss = new \DOMDocument();
			$isConnected = @fsockopen("sjoliespraytan.com", 80);
			
			if($isConnected) {
				$rss->load('http://www.sjoliespraytan.com/blog/feed/');
				$feed = array();
				foreach ($rss->getElementsByTagName('item') as $node) {
					$item = array (
						'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
						// 'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
						'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
						// 'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
					);
					array_push($feed, $item);
				}
			}
			
		} catch (ErrorException $e) {
			$feed = array();
		}
        return \View::make('dashboard/index/index')->with('feed', $feed);
    }
    
}
