<?php
session_start();
require '../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
function sendHi($as_user,$channel,$text)
{
  $client = new \GuzzleHttp\Client();
//  var_dump(json_encode($data));
  $url='https://slack.com/api/chat.postMessage?token='. $_SESSION['test']->token.'&channel='.$channel.'&as_user='.$as_user.'&text='.$text;
  $res = $client->get($url);
  readMsg($channel);
//  $res=$req->send();
  //var_dump(json_decode($res->getBody()));
}
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
    //header("location:slack_integration.php?result=chatsretrieved"); 
   // echo $usernames;
}
if (isset($_GET['msg']))
{
  $as_user=$_GET['as_user']?$_GET['as_user']:false;
  $channel=$_GET['channel']?$_GET['channel']:'CBR01M03X';
  $msg=$_POST['message'];
  sendHi($as_user,$channel,$msg);
  header("location:slack_integration.php?result=success");
}
/*if (isset($_GET['read']))
{
  //$as_user=$_GET['as_user']?$_GET['as_user']:false;
  $channel=$_GET['channel']?$_GET['channel']:'CBR01M03X';
  //$msg=$_POST['text'];
  readMsg($channel);
  //header("location:slack_integration.php?result=success");
}*/
