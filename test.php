<?php
require_once __DIR__ . '/vendor/autoload.php';

use VideoHuddle\PartnerAPI\Toolkit\API;
use VideoHuddle\PartnerAPI\Toolkit\Sessions;

function dump($val) {
	echo "<pre>" . print_r($val, true) . "</pre>";
}

API::setAuthentication("3ae036cd22223ba4df74dbe416f94f21039694642745c5d026a1f6e48eaa38d011d9fe6c8d54e117607e8f2f9a13b6d2ee55889f6d1f79da7da7ab6d75156a94");

echo "<h1>Sessions::create()</h1>";
$session = Sessions::create();
dump($session);

echo "<h1>Sessions::join(" . $session->id . ", \"Peter\")</h1>";
$member = Sessions::join($session->id, "Peter");
dump($member);

echo "<h1>Sessions::join(" . $session->id . ", \"Tabz\")</h1>";
$member = Sessions::join($session->id, "Tabz");
dump($member);

echo "<h1>Sessions::get(" . $session->id . ")</h1>";
dump(Sessions::get($session->id));

echo "<h1>Sessions::delete(" . $session->id . ")</h1>";
dump(Sessions::delete($session->id));

echo "<h1>Sessions::getAll()</h1>";
dump(Sessions::getAll());
