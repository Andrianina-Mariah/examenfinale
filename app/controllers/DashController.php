<?php
class DashController {
  public static function DashBoard() {
    Flight::render('/', [
      'values' => [
        'email' => ''
      ],
      'errors' => [
        'email' => '',
        'password' => ''
      ],
      'success' => false
    ]);
  }
}