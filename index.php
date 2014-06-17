<?php require("includes/tools.php"); ?>

<html>
	<head>
		<title>REDACTED Status Page</title>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
		<?php include("includes/analytics.php") ?>
	</head>
	<body>
		<div id="footer">
		 	<div class="container">
				<center>
					<h4>This nifty little <a href="https://github.com/Impyy/Redacted-Status" target="_blank">open source</a> status page is brought to you by <a href="http://impy.me/" target="_blank">Imperative</a></h4>
				</center>
		  	</div>
		</div>
		<div class="container">
			<center>
				<div class="page-header">
			        <h1>REDACTED Status Page</h1>
			    </div>
		    </center>
		    <div class="bs-docs-section">
				<div class="row">
					<div class="col-lg-6">
		    			<div class="bs-component">
		    				<div class="panel panel-default">
							<div class="panel-heading">Currently Online </div>
								<table id="playertable" class="table table-hover">
								    <thead>
							    		<tr>
							    			<th>Username</th>
							    			<th>Matchmaking</th>
							    			<th>From</th>
							    		</tr>
							      	</thead>
							      	<tbody>
									<?php
									$serverinfo = get_server_info();

									/*$users = get_online_users();
									foreach($users as $user)
									{
										$username = $user["username"];
										$forumlink = get_forum_url($user["phpbb_user_id"]);
										$avatar = get_avatar($user);
										$country = strtolower($user["countryName"]);

										if (array_key_exists($username, $staff))
											$color = $staff[$username];
										else
											$color = "#FFFFFF";

										print("<tr>");
										print("<td><img id=\"avatar\" src=\"$avatar\"> <a style=\"color:$color\"href=\"$forumlink\" target=\"_blank\">$username</a></td>");

										if ($user["isMatchmaking"])
											print("<td>Yes</td>");
										else
											print("<td>No</td>");

										print("<td><img src=\"assets/img/flags/$country.png\"></td>");
										print("</tr>");
									}*/

									?>
									</tbody>
							    </table>
							</div>
						</div>
					</div>
		    		<div class="col-lg-6">
		            	<div class="bs-component">
		            		<div class="panel panel-default">
							  	<div class="panel-heading">
							    	<h3 class="panel-title">General Stats </h3>
								</div>
								<div class="panel-body">
							    	<p>Master server:
			            				<?php
			            					if ($serverinfo["TCPService"])
			            						print("<span id=\"masteronlineindicator\" style=\"color:green\">Online</span>");
			            					else
			            						print("<span id=\"masteronlineindicator\" style=\"color:red\">Offline</span>");
			            				?>
		            				</p>
		            				<p>Web server:
		            					<?php

		            					if ($serverinfo["WebService"])
		            						print("<span id=\"webserveronlineindicator\" style=\"color:green\">Online</span>");
		            					else
		            						print("<span id=\"webserveronlineindicator\" style=\"color:red\">Offline</span>");

		            					?>
		            				</p>
		            				<p id="onlinecount">Online Users: <?php $users_online = $serverinfo["playersOnline"]; print("$users_online"); ?></p>
		            				<p id="servercount">Servers: <?php $dedi_count = $serverinfo["dedicatedOnline"]; print("$dedi_count"); ?> </p>
								</div>
							</div>
							<a class="twitter-timeline" height="400" href="https://twitter.com/REDACTED_t6"  data-widget-id="452421732503023616">Tweets by @REDACTED_t6</a>
		    				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
		            </div>
		        </div>
		    </div>
		</div>
		<script>
			$(document).ready(function()
			    {
			        $("#playertable").tablesorter();
			    }
			);
		</script>
		<script>
			setInterval(function(){
				$.ajax({
					url: "status.php",
					type: "GET",
					data: { },
					success: function(data) {
						if(data["status"] == "OK"){
							var table = document.getElementById("playertable");

							if (data["result"]["server"]["is_master_online"] == "1"){
								$("#masteronlineindicator").html("<span id=\"masteronlineindicator\" style=\"color:green\">Online</span>");
							} else {
								$("#masteronlineindicator").html("<span id=\"masteronlineindicator\" style=\"color:red\">Offline</span>");
							}

							if (data["result"]["server"]["is_webserver_online"] == "1"){
								$("#webserveronlineindicator").html("<span id=\"webserveronlineindicator\" style=\"color:green\">Online</span>");
							} else {
								$("#webserveronlineindicator").html("<span id=\"webserveronlineindicator\" style=\"color:red\">Offline</span>");
							}

							$("#onlinecount").text("Online Users: " + data["result"]["server"]["users_online"]);
							$("#servercount").text("Servers: " + data["result"]["server"]["dedi_count"]);

							$("#playertable tr:not(:first)").remove();

							for(var username in data["result"]["users"]){
								var row = table.insertRow(table.rows.length);
								row.insertCell(0).innerHTML = "<img id=\"avatar\" src=\"" + data["result"]["users"][username]["avatar"] + "\"> <a style=\"color:" + data["result"]["users"][username]["color"] + "\"href=\"" + data["result"]["users"][username]["forum_link"] + "\" target=\"_blank\">" + username + "</a>";

								if (data["result"]["users"][username]["is_matchmaking"] == "1"){
									row.insertCell(1).innerHTML = "Yes";
								} else {
									row.insertCell(1).innerHTML = "No";
								}

								row.insertCell(2).innerHTML = "<img src=\"" + data["result"]["users"][username]["flag"] + "\">";
							}
						} else {
							console.log("Error while obtaining information from the api: " + data["error"]);
						}
					},
					error: function(data) {
						console.log("Error while obtaining information from the api");
					}
				});
			},15000);
		</script>
	</body>
</html>