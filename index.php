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
							<div class="panel-heading">Currently Online: </div>
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

									if (!$users = get_online_users())
										print("Could not get users");

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
									}

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
							    	<h3 class="panel-title">General Stats: </h3>
								</div>
								<div class="panel-body">
							    	<p>Server Status: 
			            				<?php
			            					if (server_is_up())
			            						print("<span style=\"color:green\">Online</span>");
			            					else
			            						print("<span style=\"color:red\">Offline</span>");
			            				?>
		            				</p>
		            				<p>Online Users: <?php print(get_online_user_count()); ?></p>
		            				<p>Lobbies: <?php print(get_session_count()); ?></p>
								</div>
							</div>
		            		<div class="panel panel-default">
							  	<div class="panel-heading">
							    	<h3 class="panel-title">Note: </h3>
							  	</div>
							  	<div class="panel-body">
									<p>The people who are not matchmaking are most likely playing against bots or have already found a lobby.</p>
									<p>The lobby count is currently incorrect or not showing at all. This is due to the api being partially not functional.</p>
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
	</body>
</html>