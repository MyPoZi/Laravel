<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class GistController extends Controller
{
    protected $client_id = '';
    protected $client_secret = '';

    public function showPublicList()
    {
        $test = $this->getGistsDate('https://api.github.com/gists');
//        var_dump($test);
        return $test;
    }

    public function showMyGistsList()
    {
        $test = $this->getGistsDate('https://api.github.com/users/' .
            mb_strtolower(Auth::user()->name) . '/gists');
        return $test;
    }

    public function postGists()
    {
        $test = $this->postGistsData('https://api.github.com/gists?access_token=');
        return $test;
    }

    public function postGistsData(string $url)
    {

        $array = array(
            "description" => "Hello World Examples",
            "public" => true,
            "files" => array(
                "hello_world.rb" => array(
                    "content" => "ooooo",
                ),
                "hello_world.py" => array(
                    "content" => "tetetetes"
                )
            ),
        );
        $array = json_encode($array);
        $client = new Client();
        $res = $client->request('POST', $url,
            [
//                'heders' => [
//                    "Content-Type" => "application/json",
//                ],
                'body' => $array
            ]);
//        $client = new Client();
//        $res = $client->request('POST', $url, ["description" => "Hello World Examples", "public" => true, "files" => ["hello_world.rb" => ["content" => "Hi"]]]);
        return var_dump($res);
    }

    public function getGistsDate(string $url)
    {

        $client = new Client();
        $res = $client->request('GET', $url . '?access_token=' . '' . '&client_id=' . $this->client_id . '&client_secret=' . $this->client_secret, [
//                'client_id' => '',
//                'client_secret' => '',
//                'access_token' => '',
        ]);
        $data = json_decode($res->getBody(), true);
        $name = array();
        $html_url = array();
        $temp = array();
        $files = array();
        $img = array();
        $owner_html_url = array();
        $updated_at = array();
        $description = array();
        foreach ($data as $record) {
            array_push($name, $record['owner']['login']);
            array_push($html_url, $record['html_url']);
            array_push($temp, $record['files']);
            array_push($img, $record['owner']['avatar_url']);
            array_push($owner_html_url, $record['owner']['html_url']);
            array_push($updated_at, $record['updated_at']);
            array_push($description, $record['description']);
        }
        foreach ($temp as $file) {  // XXX: gomi.
            foreach ($file as $test) {
                array_push($files, $test['filename']);
            }
        }
        return view('gists/gists', compact('name', 'html_url', 'files',
            'img', 'owner_html_url', 'updated_at', 'description'));
//        return $name, $html_url, 'files','img', 'owner_html_url', 'updated_at');
    }

    public function Model()
    {
        $md = new SocialAccount();

        $md->user();

    }

}
