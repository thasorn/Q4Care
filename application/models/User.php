<?php
class User extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  private function getRecord($table ,$condition=NULL, $attributes=NULL) // Get row from Database.
  {
    $this->load->database();
    if (isset($attributes)){
      $selectString = $this->arrayToString($attributes);
      $this->db->select($selectString);
    }
    $this->db->from($table);
    (empty($condition))?:$this->db->where($condition);
    $row = $this->db->get();
    $this->db->close();
    return $row;
  }

  private function insertRecord($table, $data) // Insert new row to database
  {
    $this->load->database();
    $this->db->insert($table, $data);
    $this->db->close();
    return TRUE;
  }

  private function updateRecord($table, $data, $condition) // update row in database
  {
    $this->load->database();
    $this->db->update($table, $data, $condition);
    $this->db->close();
    return TRUE;
  }

  private function deleteRecord($table, $condition) // delete row in Database
  {
    $this->load->database();
    $this->db->delete($table, $condition);
    $this->db->close();
    return TRUE;
  }

  private function arrayToString($array) //change array to string. used to database
  {
    $string = '';
    $count = 0;
    foreach ($array as $key) {
      $string += $key;
      if ($count < (sizeof($array) - 1)){
        $string += ', ';
      }
      $count++;
    }
    return $string;
  }

  private function setSession($sessionName, $data) // set session fron data
  {
    $sessionData = $data->result_array();
    $this->session->set_userdata($sessionName, $sessionData[0]);
  }

  private function getAllTable()
  {
    $tables = $this->db->list_tables();
    return $tables;
  }

  private function getTable($attr)
  {
    $this->load->database();
    $tables = $this->getAllTable();
    $tableName = FALSE;
    foreach ($tables as $table) {
      $fields = $this->db->field_data($table);
      foreach ($fields as $field) {
        if ($field->name == $attr){
          $tableName = strtoupper($table);
          break;
        }
      }
      if ($tableName){
        break;
      }
      $this->db->close();
    } return $tableName;
  }

  //Return True if value is exist in database
  public function isExist($attr, $value, $table=NULL, $session=FALSE)
  {
    if ($table == NULL){
      $table = $this->getTable($attr);
    }
    $result = $this->getRecord($table, array($attr => $value));
    if ($session){
      $user = $this->session->userdata("user");
      foreach ($result->result_array() as $row)
      if ($row['email'] == $user['email'] && $row['username'] == $user['username']){
        return FALSE;
      }
    }
    return ($result->num_rows() > 0);
  }

  public function checkSession($dest) // Check session function. this can use every page in website.
  {
    if ($this->session->userdata("user") == null){
      redirect(base_url()."home/login?redirect=".$dest);
    }
    return TRUE;
  }

  public function login($username, $password) // Login function.
  {
    $condition = array(
      'username' => $username,
      'password' => $password
    );
    $data = $this->getRecord('UserInfo', $condition);
    if ($data->num_rows() > 0){
      $this->setSession('user', $data);
    }
    return ($data->num_rows() > 0);
  }

  public function register($data)
  {
    return $this->insertRecord('UserInfo', $data);
  }

  public function findEmail($email)
  {
    $email = strtolower($email);
    return $this->isExist("email", $email, "UserInfo", !empty($this->session->userdata("user")));
  }

  public function findUsername($username)
  {
    $username = strtolower($username);
    return $this->isExist("username", $username, "UserInfo", !empty($this->session->userdata("user")));
  }

  public function editAccount($data)
  {
    $user = $this->session->userdata("user");
    $cond = array(
      'email' => $user['email']
    );
    $this->updateRecord('UserInfo', $data, $cond);
  }

  public function test()
  {
    //Code Here
    $email = '58070115@it.kmitl.ac.th';
    echo $email." : ";
    echo $this->findEmail($email);
  }

}
?>
