<?php
namespace Slack_Interface;
//require 'Requests.php';
//require 'vendor/autoload.php';
//$loader->registerPrefix('Requests', 'Requests/vendor/Requests/library');
//Requests::register_autoloader();
/**
 * A basic Slack interface you can use as a starting point
 * for your own Slack projects.
 */
class Slack {



    private static $api_root = 'https://slack.com/api/';
    private $access;
    public function __construct($access_data) {
      if ( $access_data ) {
        $this->access = new Slack_Access( $access_data );
    }
    }
    public function is_authenticated() {
    return isset( $this->access ) && $this->access->is_configured();
    }
    public function get_client_id() {
    // First, check if client ID is defined in a constant
    if ( defined( 'SLACK_CLIENT_ID' ) ) {
        return SLACK_CLIENT_ID;
    }

    // If no constant found, look for environment variable
    if ( getenv( 'SLACK_CLIENT_ID' ) ) {
        return getenv( 'SLACK_CLIENT_ID' );
    }

    // Not configured, return empty string
    return '';
    }

/**
 * Returns the Slack client secret.
 *
 * @return string   The client secret or empty string if not configured
 */
  private function get_client_secret() {
      // First, check if client secret is defined in a constant
      if ( defined( 'SLACK_CLIENT_SECRET' ) ) {
          return SLACK_CLIENT_SECRET;
      }

      // If no constant found, look for environment variable
      if ( getenv( 'SLACK_CLIENT_SECRET' ) ) {
          return getenv( 'SLACK_CLIENT_SECRET' );
      }

      // Not configured, return empty string
      return '';
  }
  public function do_oauth( $code ) {

      // Set up the request headers
      $headers = array( 'Accept' => 'application/json' );
       //var_dump($headers);
      // Add the application id and secret to authenticate the request
      $options = array( 'auth' => array( $this->get_client_id(), $this->get_client_secret() ) );

      // Add the one-time token to request parameters
      $data = array( 'code' => $code );

      $response = Requests::post( self::$api_root . 'oauth.access', $headers, $data, $options );

      // Handle the JSON response
      $json_response = json_decode( $response->body );

      if ( ! $json_response->ok ) {
          // There was an error in the request
          throw new Slack_API_Exception( $json_response->error );
      }

      // The action was completed successfully, store and return access data
      $this->access = new Slack_Access(
          array(
              'access_token' => $json_response->access_token,
              'scope' => explode( ',', $json_response->scope ),
              'team_name' => $json_response->team_name,
              'team_id' => $json_response->team_id,
              'incoming_webhook' => $json_response->incoming_webhook
          )
      );

      return $this->access;
  }
  public function send_notification( $text, $attachments = array() ) {
      if ( ! $this->is_authenticated() ) {
          throw new Slack_API_Exception( 'Access token not specified' );
      }

      // Post to webhook stored in access object
      $headers = array( 'Accept' => 'application/json' );

      $url = $this->access->get_incoming_webhook();
      $data = json_encode(
          array(
              'text' => $text,
              'attachments' => $attachments,
              'channel' => $this->access->get_incoming_webhook_channel(),
          )
      );

      $response = Requests::post( $url, $headers, $data );

      if ( $response->body != 'ok' ) {
          throw new Slack_API_Exception( 'There was an error when posting to Slack' );
      }
  }

}
