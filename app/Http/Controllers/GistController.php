<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class GistController extends Controller
{
    protected $client_id = '67f217ab89971f819ef6';
    protected $client_secret = '04e84a3f0274f25a8daa985b90961ea547f633cd';

    public function showPublicList()
    {
        $test = $this->getGistsDate('https://api.github.com/gists/public');
//        var_dump($test);
        return $test;
    }

    public function showMyGistsList()
    {
        $test = $this->getGistsDate('https://api.github.com/users/' .
            mb_strtolower(Auth::user()->name) . '/gists');
        return $test;
    }

    public function getGistsDate(string $url)
    {

        $client = new Client();
        $res = $client->request('GET', $url . '?client_id=' . $this->client_id . '&client_secret=' . $this->client_secret, [
//                'client_id' => '67f217ab89971f819ef6',
//                'client_secret' => '04e84a3f0274f25a8daa985b90961ea547f633cd',
//                'access_token' => 'a556c2f8a9d6bfdb5ea8acc0f61c4911580ac13f',
        ]);
        $data = json_decode($res->getBody(), true);
        $name = array();
        $html_url = array();
        $temp = array();
        $files = array();
        $img = array();
        $owner_html_url = array();
        $updated_at = array();
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
        return view('gists/gists', compact('name', 'html_url', 'files',
            'img', 'owner_html_url', 'updated_at'));
//        return $name, $html_url, 'files','img', 'owner_html_url', 'updated_at');
    }

}
