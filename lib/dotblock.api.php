<?php

/**
 * DotBlock API Client for PHP5
 *
 * @author    Joshua Priddle <jpriddle@nevercraft.net>
 * @version   v0.0.1
 * @copyright 2011 DotBlock Inc
 */

class DotBlockAPI {

  /**
   * Instantiate a new instance of the API client
   *
   * @param string $username  Your dotblock.com username
   * @param string $password  Your dotblock.com password
   */

  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  // --------------------------------------------------------------------

  /**
   * List virtual servers
   *
   * @return array
   */

  public function list_servers() {
    return $this->send_request("/v1/servers.json");
  }

  // --------------------------------------------------------------------

  /**
   * Get server info for $id
   *
   * @param  string $id
   * @return array
   */

  public function server_info($id) {
    return $this->send_request("/v1/servers/{$id}.json");
  }

  // --------------------------------------------------------------------

  /**
   * Reboot server $id
   *
   * @param  string $id
   * @return boolean
   */

  public function reboot_server($id) {
    return $this->send_request("/v1/servers/{$id}.json", 'PUT', array('action' => 'reboot'));
  }

  // --------------------------------------------------------------------

  /**
   * Boot server $id
   *
   * @param  string $id
   * @return boolean
   */

  public function boot_server($id) {
    return $this->send_request("/v1/servers/{$id}.json", 'PUT', array('action' => 'boot'));
  }

  // --------------------------------------------------------------------

  /**
   * Suspend server $id
   *
   * @param  string $id
   * @return boolean
   */

  public function suspend_server($id) {
    return $this->send_request("/v1/servers/{$id}.json", 'PUT', array('action' => 'suspend'));
  }

  // --------------------------------------------------------------------

  /**
   * Resume server $id
   *
   * @param  string $id
   * @return boolean
   */

  public function resume_server($id) {
    return $this->send_request("/v1/servers/{$id}.json", 'PUT', array('action' => 'resume'));
  }

  // --------------------------------------------------------------------

  /**
   * Shutdown server $id
   *
   * @param  string $id
   * @return void
   */

  public function shutdown_server($id) {
    return $this->send_request("/v1/servers/{$id}.json", 'PUT', array('action' => 'shutdown'));
  }

  // --------------------------------------------------------------------

  /**
   * Send API request to api.dotblock.com
   *
   * @param  string $url     The URL to submit to
   * @param  string $method  HTTP method
   * @param  string $params  Request parameters
   * @return array
   */

  private function send_request($url, $method = 'GET', $params = array()) {
    $payload = array();
    foreach ($params as $key => $val) {
      $payload[] = "{$key}={$val}";
    }
    $payload = join("&", $payload);

    $ch = curl_init("http://api.dotblock.com{$url}");

    if ($method != 'GET') {
      if ($method == 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      }
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    }

    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERPWD, "{$this->username}:{$this->password}");
    $data = curl_exec($ch);

    curl_close($ch);

    return json_decode($data);
  }

  // --------------------------------------------------------------------

}

/* End of file dotblock.api.php */
/* Location: ./lib/dotblock.api.php */
