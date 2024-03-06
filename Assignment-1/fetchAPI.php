<?php

require __DIR__ . '/requests.php';

class fetchAPI {
  public static $domain = 'https://www.innoraft.com/';
  public $title = [];
  public $title_img = [];
  public $icon_arrays = [];
  public $details = [];

  function __construct (string $api_url) {
    // API response data.
    $response_data = request($api_url);

    for ($i = 12; $i <= 15; $i++) {
      // Get title.
      array_push($this->title, $response_data['data'][$i]['attributes']['title']);

      // Get title image.
      $response_title_img = request($response_data['data'][$i]['relationships']['field_image']['links']['related']['href']);
      array_push($this->title_img, self::$domain . $response_title_img['data']['attributes']['uri']['url']);

      // Get service icons.
      $field_service_icon_data = request($response_data['data'][$i]['relationships']['field_service_icon']['links']['related']['href']);
      $icon_arr = [];
      foreach ($field_service_icon_data['data'] as $element) {
        $field_media_image_data = request($element['relationships']['field_media_image']['links']['related']['href']);
        array_push($icon_arr, self::$domain . $field_media_image_data['data']['attributes']['uri']['url']);
      }
      array_push($this->icon_arrays, $icon_arr);

      // Get details of service (in html list).
      array_push($this->details, $response_data['data'][$i]['attributes']['field_services']['value']);
    }
  }
}
