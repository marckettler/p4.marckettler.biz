<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

    <!-- Universal JS/CSS -->
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="screen" />
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>
    <div class="container">
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">BBSBTM</a>
            </div>
            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class="nav navbar-nav navbar-left">
                    <?php if($user): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/profile/edit">Edit</a></li>
                                <li><a href="/profile/view">View</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Teams<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/teams/index">My Teams</a></li>
                                <li><a href="/teams/create">Create a Team</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Players<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/players/create">Create Player</a></li>
                                <li><a href="/players/view_all">All Players</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Games<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/games/new_game">New Game</a></li>
                            </ul>
                        </li>
                        <li><a href="/users/logout">Log Out</a></li>
                    <?php else: ?>
                        <li><a href="/users/login">Log In</a></li>
                        <li><a href="/users/create">Create Account</a></li>
                        <li><a href="/games/demo_game">Demo ScoreCard</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div> <!-- /div.navbar -->
        <?php if(isset($content)) echo $content; ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>