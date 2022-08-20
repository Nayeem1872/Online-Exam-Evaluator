<?php ?>
<!DOCTYPE html>
<html>
    <head> 
        <title>Facebook Reactions</title>
        <meta name="description" content="Facebook Like Reaction System" />
        <!-- bootstrap css -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!-- Css for reaction system -->
        <link rel="stylesheet" type="text/css" href="css/reaction.css" />

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- jQuery for Reaction system -->
        <script type="text/javascript" src="js/reaction.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Facebook Reactions</h1>	
            </div>
            <div class="main">
                <!-- Reaction system start -->
                <div class="reaction-container"><!-- container div for reaction system -->
                    <span class="reaction-btn"> <!-- Default like button -->
                        <span class="reaction-btn-emo like-btn-default"></span> <!-- Default like button emotion-->
                        <span class="reaction-btn-text">Like</span> <!-- Default like button text,(Like, wow, sad..) default:Like  -->
                        <ul class="emojies-box"> <!-- Reaction buttons container-->
                            <li class="emoji emo-like" data-reaction="Like"></li>
                            <li class="emoji emo-love" data-reaction="Love"></li>
                            <li class="emoji emo-haha" data-reaction="HaHa"></li>
                            <li class="emoji emo-wow" data-reaction="Wow"></li>
                            <li class="emoji emo-sad" data-reaction="Sad"></li>
                            <li class="emoji emo-angry" data-reaction="Angry"></li>
                        </ul>
                    </span>
                    <div class="like-stat"> <!-- Like statistic container-->
                        <span class="like-emo"> <!-- like emotions container -->
                            <span class="like-btn-like"></span> <!-- given emotions like, wow, sad (default:Like) -->
                        </span>
                        <span class="like-details">Knowband and 10k others</span>
                    </div>
                </div>
                <!-- Reaction system end -->
            </div>
        </div>
    </body>
</html>
