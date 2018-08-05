<?php
define( 'SLACK_CLIENT_ID', '400183527254.399148360771' );
define( 'SLACK_CLIENT_SECRET', 'e3be615c8125999f45f629b3b4d1704f' );
// Include our Slack interface classes
require_once 'slack-interface/class-slack.php';
require_once 'slack-interface/class-slack-access.php';
require_once 'slack-interface/class-slack-api-exception.php';
require './slack-interface/Requests.php';
Requests::register_autoloader();
use Slack_Interface\Slack;
use Slack_Interface\Slack_API_Exception;

//
// HELPER FUNCTIONS
//

/**
 * Initializes the Slack object.
 *
 * @return Slack    The Slack interface object
 */
 function initialize_slack_interface() {
     // Read the access data from a text file
     if ( file_exists( 'access.txt' ) ) {
         $access_string = file_get_contents( 'access.txt' );
     } else {
         $access_string = '{}';
     }

     // Decode the access data into a parameter array
     $access_data = json_decode( $access_string, true );

     $slack = new Slack( $access_data );

     return $slack;
 }

/**
 * Executes an application action (e.g. 'send_notification').
 *
 * @param Slack  $slack     The Slack interface object
 * @param string $action    The id of the action to execute
 *
 * @return string   A result message to show to the user
 */
 function do_action( $slack, $action ) {
     $result_message = '';

     switch ( $action ) {

         // Handles the OAuth callback by exchanging the access code to
         // a valid token and saving it in a file
         case 'oauth':

             $code = $_GET['code'];
             echo $code;
             // Exchange code to valid access token
             try {
                 $access = $slack->do_oauth( $code );
                 if ( $access ) {
                     file_put_contents( 'access.txt', $access->to_json() );
                     $result_message = 'The application was successfully added to your Slack channel';
                 }
             } catch ( Slack_API_Exception $e ) {
                 $result_message = $e->getMessage();
             }
             break;

         default:
             break;

     }

     return $result_message;
 }

//
// MAIN FUNCTIONALITY
//

// Setup the Slack interface
$slack = initialize_slack_interface();

// If an action was passed, execute it before rendering the page
$result_message = '';
if ( isset( $_REQUEST['action'] ) ) {
    $action = $_REQUEST['action'];
    $result_message = do_action( $slack, $action );
    echo $result_message;
}

//
// PAGE LAYOUT
//

?>
<html>
    <head>
        <title>Slack Integration Example</title>

        <style>
            body {
                font-family: Helvetica, sans-serif;
                padding: 20px;
            }

            .notification {
                padding: 20px;
                background-color: #fafad2;
            }

            input {
                padding: 10px;
                font-size: 1.2em;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <h1>Slack Integration Example</h1>

        <?php if ( $result_message ) : ?>
            <p class="notice">
                <?php echo $result_message; ?>
            </p>
        <?php endif; ?>
        <?php if ( $slack->is_authenticated() ) : ?>
      <form action="" method="post">
          <input type="hidden" name="action" value="send_notification"/>
          <p>
              <input type="text" name="text" placeholder="Type your notification here and press enter to send." />
          </p>
      </form>
  <?php else : ?>
      <p>
          <a href="https://slack.com/oauth/authorize?scope=incoming-webhook,commands&client_id=<?php echo $slack->get_client_id(); ?>"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x"></a>
      </p>
  <?php endif; ?>


    </body>
</html>
