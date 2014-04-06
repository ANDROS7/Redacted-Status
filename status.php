<?php
/*	
	this is so efficient
	many exception catching
	wow
*/

require_once("includes/tools.php");

header("Content-Type: application/json")

if (!isset($_GET))
	die();

if (!$users = get_online_users()) { }
	//die_with_error("Could not get online users");

$userarray = array();
foreach($users as $user)
{
	$a = array(
		"country_code"=>strtolower($user["countryName"]),
		"username"=>$user["username"],
		"forum_link"=>get_forum_url($user["phpbb_user_id"]),
		"avatar"=>get_avatar($user),
		"color"=>array_key_exists($user["username"], $staff) ? $staff[$username] : "#FFFFFF",
		"is_matchmaking"=>$user["isMatchmaking"]
		);

	array_push($userarray, $a);
}

$serverinfo = array(
	"is_online"=>(string)server_is_up(),
	"users_online"=>(string)get_online_user_count(),
	"session_count"=>(string)get_session_count()
	);

$jsonobj = array(
	"status"=>"OK",
	"error"=>"",
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