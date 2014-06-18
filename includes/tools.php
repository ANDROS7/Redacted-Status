<?php

$staff = array(
	"sysadm"=>"#ffff00",

	"Developer1"=>"#ff6600",
	"Developer2"=>"#ff6600",
	"momo5502"=>"#ff6600",

	"MAGIC"=>"#00c3ff",
	"Menno"=>"#00c3ff",
	"FaceHunter"=>"#00c3ff",
	"Seth"=>"#00c3ff",

	"arrivance"=>"#00CC00",
	"DarkSideHunterX"=>"#00CC00",
	"Imposter"=>"#00CC00",
	"yolarrydabomb"=>"#00CC00",
);

function get_forum_url($id)
{
	return "http://redacted.se/memberlist.php?mode=viewprofile&u=" . $id;
}

function get_online_users()
{
	$response = file_get_contents("http://services-dev.redacted.se/getClientList");
	$obj = json_decode($response, true);

	if ($obj["result"] != "Ok")
		return false;

	return $obj["data"];
}

function get_avatar($user)
{
	if (empty($user["user_avatar"]))
		return "assets/img/noavatar.png";
	else 
		return $user["user_avatar"];
}

function get_server_info()
{
	$response = file_get_contents("http://services-dev.redacted.se/status");
	$obj = json_decode($response, true);

	if ($obj["result"] != "Ok")
		return false;

	return $obj["data"];
}

?>