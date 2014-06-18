<?php

require_once("includes/tools.php");

header("Content-Type: application/json");

if (!isset($_GET))
	die();

//if (!$users = get_online_users()) { }
	//die_with_error("Could not get online users");

$userarray = array();
foreach($users as $user)
{
	$userarray[$user["username"]] = array(
		//"flag"=>"assets/img/flags/" . strtolower($user["countryName"]) . ".png",
		//"forum_link"=>get_forum_url($user["phpbb_user_id"]),
		//"avatar"=>get_avatar($user),
		"color"=>array_key_exists($user["username"], $staff) ? $staff[$user["username"]] : "#FFFFFF",
		"is_matchmaking"=>$user["matchmaking"]
		);
}

$info = get_server_info();

$serverinfo = array(
	"is_master_online"=>(bool)$info["TCPService"],
	"is_webserver_online"=>(bool)$info["WebService"],
	"users_online"=>(int)$info["playersOnline"],
	"dedi_count"=>(int)$info["dedicatedOnline"]
	);

$jsonobj = array(
	"status"=>"OK",
	"error"=>null,
	"result"=>array("server"=>$serverinfo, "users"=>$userarray)
	);

die(json_encode($jsonobj));

function die_with_error($error)
{
	$jsonobj = array(
		"status"=>"ERROR",
		"error"=>$error,
		"result"=>array()
		);

	die(json_encode($jsonobj));
}

?>