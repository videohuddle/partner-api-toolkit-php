<?php
namespace VideoHuddle\PartnerAPI\Toolkit;

use VideoHuddle\PartnerAPI\Toolkit\API;

class Sessions {

	public static function getAll() {
		$response = API::request("sessions");
		return $response->sessions;
	}

	public static function get($id) {
		$response = API::request("sessions/" . $id);
		return $response->session;
	}

	public static function create() {
		$response = API::request("sessions/create");
		return $response->session;
	}

	public static function delete($id) {
		$response = API::request("sessions/" . $id . "/delete");
		return null;
	}

	public static function join($id, $username, $email, $telephone) {
		$response = API::request("sessions/" . $id . "/join", array(
			"name"      => $username,
			"email"     => $email,
			"telephone" => $telephone
		));
		return $response->member;
	}

}
