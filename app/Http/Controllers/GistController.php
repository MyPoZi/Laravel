<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GistController extends Controller
{
    public function publicList()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://api.github.com/gists/public', [
//            'form_params' => [
//                'client_id' => 'test_id',
//                'secret' => 'test_secret',
//            ]
        ]);
        $data = json_decode($res->getBody(), true);
        $name = array();
        $html_url = array();
        $temp = array();
        $files = array();
        $img = array();
        $owner_html_url =  array();
        $updated_at =  array();
        foreach ($data as $record) {
            array_push($name, $record['owner']['login']);
            array_push($html_url, $record['html_url']);
            array_push($temp, $record['files']);
            array_push($img, $record['owner']['avatar_url']);
            array_push($owner_html_url, $record['owner']['html_url']);
            array_push($updated_at, $record['updated_at']);
        }
        foreach ($temp as $file) {  // XXX: gomi.
            foreach ($file as $test) {
                array_push($files, $test['filename']);
            }
        }
        return view('gists', compact('name', 'html_url', 'files',
                                                    'img', 'owner_html_url', 'updated_at'));
    }
}
