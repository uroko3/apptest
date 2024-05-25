<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitLab\Facades\GitLab;

class GitlabController extends Controller
{
	public function password() {
		$base_url = config('gitlab_my.base_url');
		$gitlab_oauth_url = $base_url . '/oauth/token';
		
		$username = 'root';
		$password = 'Symm1234';
		
		$data = "grant_type=password&username={$username}&password={$password}";
		
		// header
		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Content-Length: ".strlen($data)
		);
		
		$context = array(
			"http" => array(
				"method"  => "POST",
				"header"  => implode("\r\n", $header),
				"content" => $data,
			),
		);
		
		$res = file_get_contents($gitlab_oauth_url, false, stream_context_create($context));
		
		$json = json_decode( $res );
		
		dd($json);
	}
	
	
	
	public function index() {
		
		$base_url = config('gitlab_my.base_url');
		$app_id = config('gitlab_my.app_id');
		$secret = config('gitlab_my.secret');
		$callback_url = config('gitlab_my.callback_url');
		
		// gitlab oauth url
		$gitlab_oauth_url = $base_url . '/oauth/authorize';
		
		$callback_url = urlencode($callback_url);
		
		// Scopes
		$scope = 'api';
		
		$response_type = 'code';
		
		$state = 'hoge';
		
		$url = "{$gitlab_oauth_url}?client_id={$app_id}&redirect_uri={$callback_url}&response_type={$response_type}&state={$state}&scope={$scope}";
		
		return redirect($url);
		
		return view('gitlab.index', [ 'url' => $url ]);
	}
	
	public function oauth() {
		$base_url = config('gitlab_my.base_url');
		$app_id = config('gitlab_my.app_id');
		$secret = config('gitlab_my.secret');
		$callback_url = config('gitlab_my.callback_url');
		
		$gitlab_token_url = $base_url . '/oauth/token';
		
		$code = $_REQUEST['code'];
		
		// XXX こいつは使わない
		$state = $_REQUEST['state'];
		
		// POSTデータ
		$data = array(
			"client_id" => $app_id,
			"client_secret" => $secret,
			"code" => $code,
			//            "state" => $state,
			"grant_type" => "authorization_code",
			"redirect_uri" => $callback_url,
		);
		$data = http_build_query($data);
		
		// header
		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Content-Length: ".strlen($data)
		);
		
		$context = array(
			"http" => array(
				"method"  => "POST",
				"header"  => implode("\r\n", $header),
				"content" => $data,
			),
		);
		
		$res = file_get_contents($gitlab_token_url, false, stream_context_create($context));
		
		$json = json_decode( $res );
		
//		dd( $json );
		
		$access_token = $json->access_token;
		$refresh_token = $json->refresh_token;
		
		//dd( $access_token );
		//dd($refresh_token);
		
		// ブランチ一覧取得
		//GET https://gitlab_my.example.com/api/v4/user?access_token=OAUTH-TOKEN
		//または、
		//curl --header "Authorization: Bearer OAUTH-TOKEN" "https://gitlab_my.example.com/api/v4/projects/5/repository/branches"
		
		$project = 'test/test2';
		$gitlab_url = $base_url . '/api/v4/projects/' . urlencode($project) . '/repository/branches?access_token='.$access_token;
		
		// header
		$header = array(
			"Authorization: Bearer {$access_token}",
		);
		
		$context = array(
			"http" => array(
				"method"  => "GET",
				//        "header"  => implode("\r\n", $header),
			),
		);
		
		$res = file_get_contents($gitlab_url, false, stream_context_create($context));
		
		$json = json_decode( $res );
		
		$ret = [];
		foreach( $json as $j ) {
			$ret[] = $j->name;
		}
		
		$url = urlencode($callback_url);
		$refresh_url = $base_url . "/oauth/token";
		
		$data = "client_id={$app_id}&client_secret={$secret}&refresh_token={$refresh_token}&grant_type=refresh_token&redirect_uri={$url}";
		
		
		// header
		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Content-Length: ".strlen($data)
		);
		
		$context = array(
			"http" => array(
				"method"  => "POST",
				"header"  => implode("\r\n", $header),
				"content" => $data,
			),
		);
		
		$refresh = file_get_contents($refresh_url, false, stream_context_create($context));
		
		$refresh = json_decode( $refresh );
		
		//$refresh = file_get_contents($refresh_url);
		
		//dd($refresh);
		
		$access_token_ref = $refresh->access_token;
		
		return view('gitlab.oauth', ['list'=>$ret, 'access_token'=>$access_token, 'access_token_ref'=>$access_token_ref]);
	}
	
	public function ggg() {
		
		config(['gitlab.connections.alternative.token' => '4f58ea212bbdf532623c67c2001c5b9327e899e502d34ed5eb54662e9ff76bc2']);
				
		$base_url = config('gitlab_my.base_url');
		GitLab::setDefaultConnection('alternative');
		GitLab::setUrl($base_url);
		
		//$x = GitLab::connection('alternative')->projects()->all(['search'=>'uroko','page'=>1,'per_page'=>10]);

		$x = call_user_func_array([GitLab::connection('alternative')->projects(), 'all'],[['search'=>'uroko','page'=>1,'per_page'=>10]]);


		//$x = GitLab::groups()->all();
		
		return view('gitlab.ggg', ['x'=>$x]);
	}
	
}
