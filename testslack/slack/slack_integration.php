<?php
session_start();
//echo  $_SESSION['test']->token;
if(isset($_GET['logout']))
{
  session_destroy();
  header("location:slack_integration.php?user_state=logout");
}
if(isset($_SESSION['login_state']))
{
  $logout='<a href="slack_integration.php?logout=true" style="margin-top:40px; float:right"><button type="button" class="btn btn-success">Logout</button></a>';
}
else{
  $logout='';
}
if(!isset($_SESSION['test']->token))
{$add_slack= '<br><center><a href= "./new.php?action=oauth"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x"> </a></center>';
}
else{
  $add_slack='<div class="container"><center><img src="./images/logo.png" style="width:60px; height:auto; margin-top:20px;">';
}
$html_content= '
            <html>
            <head>
            	<title>Connect To Grow</title>

            	<meta charset="utf-8">

                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="theme-color" content="#443627">
                <link rel="stylesheet" type="text/css" href="../css/style.css">

                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">

                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

            </head>
            <style>
            body{


            }
            .mod{

              background:#ffffff;
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

            }
            .txt-sml-2
            {
              height: 50px;
              max-width: 350px;
              margin-top: 30px;
              padding: 20px;
              font-size: 14px;
              margin-left: 30px;
              border: 1px solid #BFBFBF;
              box-shadow: 1px 1px 2px #BFBFBF;
              border-radius: 2px;
              -webkit-transition: all 0.5s;
            }
            </style>
            <body>

            '.$add_slack.'
              '.$logout.'
            </center></div>

            <div class="col-sm-3 messages" style="padding: 0px; margin:auto; max-width:350px;">
            <div class="head">
              <img src="./images/man.png" class="icon"> <font style="margin-left: 20px;">Startup Team Chat</font>
              <button class="chat-option"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
            </div>

            <div class="message-container" style="overflow-y:scroll;">
              <div class="msg-left">
                '.$_SESSION["chats"].'
              </div>
            </div>
            <div class="message-input">
              <div class="attachments">
                <div class="btn-group" role="group" aria-label="Attachments">
                    <button type="button" class=""><i class="fa fa-folder-open" aria-hidden="true"></i></button>
                    <button type="button" class=""><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                    <button type="button" class=""><i class="fa fa-address-card aria-hidden="true"></i></button>
                </div>
              </div>

              <div class="input">
                <form action="slack_functions.php?msg=true" method="POST">
                  <input type="text" name="message" class="message-input-box">
                  <button type="submit" class="message-send"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                </form>
              </div>
            </div>
          </div>

    ';
echo $html_content;

/*
else
{
  echo '
        <center>
          <form action="slack_functions.php?msg=true" method="POST">
          <input type="text" name="text" class="txt-sml-2" placeholder="Enter Message">
          <br><br><button type="submit" class="btn btn-success">Send Message</button>
          </form><br>
          <a href="slack_integration.php?logout=true"><button type="button" class="btn btn-success">Logout</button></a>
          <a href="slack_functions.php?read=true"><button type="button" class="btn btn-success">Read</button></a>
        </center>
        '
        ;
}*/
  echo '
        </body>
        </head>
        </html>'


?>
