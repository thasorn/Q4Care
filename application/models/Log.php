<?php
class Log extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function createLog($type, $message)
  {
    $jsPattern = array('<script type="text/javascript">', '</scirpt>');
    $text = $this->getTypeText($type, $message);
    return $jsPattern[0].$text.$jsPattern[1];
  }

  private function getTypeText($type, $message)
  {
    switch ($type) {
      default:
        $text = 'alert('.label($message).')';
        break;
    }
    return $text;
  }

}
?>
