<?php

$staff = array(
	"sysadm"=>"#ffff00",

	"Developer1"=>"#ff6600",
	"Developer2"=>"#ff6600",
	"momo5502"=>"#ff6600",

	"MAGIC"=>"#00c3ff",
	"Menno"=>"#00c3ff",
	"FaceHunter"=>"#00c3ff",
	"Imperative"=>"#00c3ff",
	"Seth"=>"#00c3ff",

	"arrivance"=>"#00CC00",
	"DarkSideHunterX"=>"#00CC00",
	"Imposter"=>"#00CC00",
	"yolarrydabomb"=>"#00CC00",
);

function get_sessions()
{
	$response = file_get_contents("http://api.redacted.se/?a=getSessions");
	$obj = json_decode($response, true);

	if ($obj["status"] != "OK")
		return false;

	return $obj["data"];
}

function get_forum_url($id)
{
	return "http://redacted.se/memberlist.php?mode=viewprofile&u=" . $id;
}

function get_online_users()
{
	$response = file_get_contents("http://api.redacted.se/?a=getOnlineUsers");
	$obj = json_decode($response, true);

	if ($obj["status"] != "OK")
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

function get_session_count()
{
	$response = file_get_contents("http://api.redacted.se/?a=getSessionCount");
	$obj = json_decode($response, true);

	if ($obj["status"] != "OK")
		return false;

	return $obj["data"];
}

function get_online_user_count()
{
	$response = file_get_contents("http://api.redacted.se/?a=getOnlineCount");
	$obj = json_decode($response, true);

	if ($obj["status"] != "OK")
		return false;

	return $obj["data"];
}

function server_is_up()
{
	$host = "62.210.146.3";
	$port = 3505;
	$timeout = 5;
	$err = null;

	try
	{
		if ($s = fsockopen($host, $port, $errCode, $err, $timeout))
		{
			fclose($s);
			return true;
		}
		else
		{
			return false;
		}
	}
	catch(Exception $e) { return false; }
}

?>