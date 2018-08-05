<?php
session_start();
require '../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
$code=$_GET['code'];
/*$html_content= '
            <html>
            <head>
            	<title>Connect To Grow</title>

            	<meta charset="utf-8">

                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="theme-color" content="#443627">

                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

            </head>
            <body>';
echo $html_content;
*/
/*
if(isset($_GET['logout']))
{
  session_destroy();
}
if(isset($_GET['msg']))
{

  $as_user=$_GET['as_user']?$_GET['as_user']:false;
  $channel=$_GET['channel']?$_GET['channel']:'CBR01M03X';
  $msg=$_POST['msg'];
  echo $msg;
  sendHi($as_user,$channel,$msg);

}*/

if (strlen($code)>0)
{
  getAccessToken($code);

}
if(isset($_GET['action']))
{
  if ($_GET['action']=='oauth')
  {
    authorize();
  }
}
function authorize()
{
  header("location:https://slack.com/oauth/authorize?scope=chat:write:user chat:write:bot channels:write channels:history channels:read&client_id=400183527254.399148360771&redirect_uri=https://codenova.tech/testslack/slack/new.php ");//  <a href= "https://slack.com/oauth/authorize?scope=chat:write:user chat:write:bot channels:write channels:history channels:read&client_id=400183527254.399148360771&redirect_uri=http://localhost:9000/ctg/slack/new.php "><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x"> </a>';

}
function getAccessToken($code)
{

  //var_dump($client);

  $client = new \GuzzleHttp\Client();
  $res = $client->request('GET', 'https://slack.com/api/oauth.access?client_id=400183527254.399148360771&client_secret=e3be615c8125999f45f629b3b4d1704f&code='.$code.'&redirect_uri=https://codenova.tech/testslack/slack/new.php');
  echo $res->getStatusCode().'<br>';
  echo $res->getHeaderLine('content-type').'<br>';
  // 'application/json; charset=utf8'
  $body=$res->getBody();
  $body=json_decode($body);
  $_SESSION['test']->token=$body->access_token;
  $_SESSION['login_state']=true;
  readMsg($channel);
  //header("Location:slack_integration.php?login=true");

}
function sendHi($as_user,$channel,$text)
{
  $client = new \GuzzleHttp\Client();
//  var_dump(json_encode($data));
  $url='https://slack.com/api/chat.postMessage?token='. $_SESSION['test']->token.'&channel='.$channel.'&as_user='.$as_user.'&text='.$text;
  $res = $client->get($url);
//  $res=$req->send();
  //var_dump(json_decode($res->getBody()));
}
      $code=$_GET["code"];
    //  $_SESSION['code']=isset($_GET["code"])?true:false;

      /*if(isset($_SESSION['test']->token))
      {
        sendHi($as_user,$channel,$text);
        echo '<a href="new.php?logout=true"><button type="button" class="btn btn-success">Logout</button></a>';
      }*/
    /*  echo $_SESSION['code'];
      if ($_SESSION['authen']==true)
      {
        getAccessToken($code);
        echo '
              <form action="new.php?msg=true" method="POST">
              <input type="text" name="msg" class="txt-sml-2" placeholder="Enter Message">
              <button type="submit" class="btn btn-success">Send Message</button>
              </form><br>
              <a href="new.php?logout=true"><button type="button" class="btn btn-success">Logout</button></a>
              '
              ;

      }
      else {
        echo '7';
        $_SESSION['authen']=true;
        authorize();
      };*/
 function readMsg($channel)
{
  $channel=$_GET['channel']?$_GET['channel']:'CBR01M03X';
  $client = new \GuzzleHttp\Client();
  $url='https://slack.com/api/channels.history?token='. $_SESSION['test']->token.'&channel='.$channel;
  $res = $client->get($url);
  //$res=$req->send();
//echo  $res->getBody();
   $answer= json_decode($res->getBody());
   //var_dump($answer->messages[0]->username);
   $_SESSION['chats']='';
  // $_SESSION['username']='';
   $_SESSION['current']=$answer->messages[0]->username;
   $_SESSION['chats'].='<p style="background-color:#428184;padding: 10px;color: white;border-radius: 50px;max-width: 80%;
   margin-top: 20px; font-size:20px;">'.$answer->messages[0]->username.'</p>';
   for ($x=0; $x < sizeof($answer->messages)-2; $x++)
    {
     if($_SESSION['current']!=$answer->messages[$x]->username)
     {
        $_SESSION['current']=$answer->messages[$x]->username;
        $_SESSION['chats'].='<p style="background-color:#428184;padding: 10px;color: white;border-radius: 50px;max-width: 80%;
           margin-top: 20px; font-size:20px;">'.$answer->messages[$x]->username.'</p>';
     }
      $_SESSION['chats'].='<p style="background-color:#44AF69;padding: 10px;color: white;border-radius: 50px;max-width: 80%;
            margin-top: 20px; margin-left:5%;">'.$answer->messages[$x]->text.'</p>';
     // $_SESSION['chats'].=$answer->messages[$x]->username.'<br><br>'.$answer->messages[$x]->text.'<br><br><br>';     
  
    }
    header("location:slack_integration.php?result=chatsretrieved"); 
    
}
    
?>
