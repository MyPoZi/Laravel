<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GistController extends Controller
{

    public function showPublicList()
    {
        $show_public_list = $this->getGistsDate('https://api.github.com/gists');
        return $show_public_list;
    }

    public function postGists()
    {
        $post_gists = $this->postGistsData('https://api.github.com/gists');
        return $post_gists;
    }

    public function showMyGistsList()
    {
        $show_my_gists_list = $this->getGistsDate('https://api.github.com/users/' .
            mb_strtolower(Auth::user()->name) . '/gists');
        return $show_my_gists_list;
    }


    public function postGistsData(string $url)
    {

        $access_token = $this->getAccessToken();

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
                'query' => ['access_token' => $access_token],
                'body' => $array
            ]);
        return var_dump($res);
    }

    public function getGistsDate(string $url)
    {
        $access_token = $this->getAccessToken();
        $github_ID = $this->getGithubClientID();
        $client = new Client();
        $res = $client->request('GET', $url, [
            'query' => ['client_id' => $github_ID['github']['client_id'],
                'client_secret' => $github_ID['github']['client_secret'],
                'access_token' => $access_token
            ]
        ]);
        $data = json_decode($res->getBody(), true);
        $name = array();
        $html_url = array();
        $files = array();
        $img = array();
        $owner_html_url = array();
        $updated_at = array();
        $description = array();
        foreach ($data as $record) {
            array_push($name, $record['owner']['login']);
            array_push($html_url, $record['html_url']);
            array_push($files, $record['files']);
            array_push($img, $record['owner']['avatar_url']);
            array_push($owner_html_url, $record['owner']['html_url']);
            array_push($updated_at, $record['updated_at']);
            array_push($description, $record['description']);
        }
        return view('gists/gists', compact('name', 'html_url', 'files',
            'img', 'owner_html_url', 'updated_at', 'description'));
    }

    protected function getAccessToken()
    {
        $user_id = Auth::user()->id;
        $access_token = DB::table('social_accounts')->select('provider_access_token')->where('user_id', '=', $user_id)->get();
        return $access_token[0]->provider_access_token;
    }

    protected function getGithubClientID()
    {
        return ['github' => [
            'client_id' => env('GITHUB_CLIENT_ID'),
            'client_secret' => env('GITHUB_CLIENT_SECRET'),
        ]];
    }

}
