<?php
namespace VideoHuddle\PartnerAPI\Toolkit;

class API {
	private static $token = "";

	public static function setAuthentication($token) {
		self::$token = $token;
	}

	public static function request($endpoint, $post_data = array()) {
		$url = "https://api.videohuddle.io/" . $endpoint;
		$url .= "?token=" . self::$token;

		$return_val = false;
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 40);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.28 Safari/534.10 VideoHuddlePartnerAPIToolkitPHP/1.0.0");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);

		if(count($post_data) > 0) {
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		}

		$return_val = curl_exec($curl);

		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if($http_code == 404)
			return false;

		curl_close($curl);
		unset($curl);

		$response = json_decode($return_val);
		if($response == null || !isset($response->response))
			throw new Exception("invalid response from videohuddle partner api");

		if($response->response->status != "success")
			throw new Exception($response->response->message);

		return $response->data;
	}

}
