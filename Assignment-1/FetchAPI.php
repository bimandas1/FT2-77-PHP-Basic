<?php

require __DIR__ . '/requests.php';

class FetchAPI {
  private static $domain = 'https://www.innoraft.com/';
  private $url;
  public $title = [];
  public $title_img = [];
  public $icon_arrays = [];
  public $details = [];

  /**
   * Constructor function for setting url.
   *
   * @param string $api_url
   *   For setting the $url.
   */
  function __construct (string $api_url) {
    $this->url = $api_url;
  }

  /**
   *  Get data from API url and set tha data to class variables.
   */
  public function set_data() {
    try {
      // API response data.
      $response_data = request($this->url);
      if ($response_data == NULL) {
        throw new Exception;
      }

      for ($i = 12; $i <= 15; $i++) {
        // Get title.
        array_push($this->title, $response_data['data'][$i]['attributes']['title']);
        if (end($this->title) === NULL) {
          throw new Exception;
        }

        // Get title image.
        $response_title_img = request($response_data['data'][$i]['relationships']['field_image']['links']['related']['href']);
        array_push($this->title_img, self::$domain . $response_title_img['data']['attributes']['uri']['url']);
        // Only $domain available in #title_img means img path not fetched.
        if (end($this->title_img) === self::$domain) {
          throw new Exception;
        }

        // Get service icons.
        $field_service_icon_data = request($response_data['data'][$i]['relationships']['field_service_icon']['links']['related']['href']);
        $icon_arr = [];
        foreach ($field_service_icon_data['data'] as $element) {
          $field_media_image_data = request($element['relationships']['field_media_image']['links']['related']['href']);
          array_push($icon_arr, self::$domain . $field_media_image_data['data']['attributes']['uri']['url']);

          // Only $domain available in #icon_arr means img path not fetched.
          if (end($icon_arr) === self::$domain) {
            throw new Exception;
          }
        }
        array_push($this->icon_arrays, $icon_arr);

        // Get details of service (in html list).
        array_push($this->details, $response_data['data'][$i]['attributes']['field_services']['value']);
        if (end($this->details) === NULL) {
          throw new Exception;
        }
      }
    }
    catch (Exception) {
      die('Error while fetching the API.');
    }
  }
}
