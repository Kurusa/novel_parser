<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NovelController extends Controller {

    protected $volumes_limit = 5;

    /**
     * @var DOMDocument
     */
    protected $doc;

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function parsePage(Request $request)
    {
        $url = trim($request->input('novel_url'));

        $this->doc = new DOMDocument;
        @$this->doc->loadHTMLFile($url);

        $volumes_data = [];
        $title = $this->doc->getElementById('info')->childNodes->item(1)->nodeValue;
        $volume_list = $this->doc->getElementById('list')->getElementsByTagName('dl');
        $dd_elements = $volume_list[0]->getElementsByTagName('dd');

        for ($i = 0; $i <= $this->volumes_limit; $i++) {
            $a = $dd_elements[$i]->getElementsByTagName('a');
            $volumes_data[$i]['title'] = $a[0]->nodeValue;
            $volumes_data[$i]['context'] = $this->parseVolumePage($url . $a[0]->getAttribute('href'));
        }
        return view('index')->with([
            'success' => 'true',
            'title' => $title,
            'volumes_data' => $volumes_data
        ]);
    }

    private function parseVolumePage($url)
    {
        @$this->doc->loadHTMLFile($url);
        return $this->doc->getElementById('content')->nodeValue;
    }

}