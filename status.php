<?php
/*	
	this is so efficient
	many exception catching
	wow
*/

require_once("includes/tools.php");

header("Content-Type: application/json");

if (!isset($_GET))
	die();

if (!$users = get_online_users()) { }
	//die_with_error("Could not get online users");

$userarray = array();
foreach($users as $user)
{
	$userarray[$user["username"]] = array(
		"flag"=>"assets/img/flags/" . strtolower($user["countryName"]) . ".png",
		"forum_link"=>get_forum_url($user["phpbb_user_id"]),
		"avatar"=>get_avatar($user),
		"color"=>array_key_exists($user["username"], $staff) ? $staff[$user["username"]] : "#FFFFFF",
		"is_matchmaking"=>$user["isMatchmaking"]
		);
}

$serverinfo = array(
	"is_online"=>(string)server_is_up(),
	"users_online"=>(string)get_online_user_count(),
	"session_count"=>(string)get_session_count()
	);

$jsonobj = array(
	"status"=>"OK",
	"error"=>null,
	"result"=>array("server"=>$serverinfo, "users"=>$userarray)
	);

die(json_encode($jsonobj)); //JSON_FORCE_OBJECT

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