<?php
class Queue extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  private function getRecord($table ,$condition, $attributes=NULL) // Get row from Database.
  {
    $this->load->database();
    if (isset($attributes)){
      $selectString = $this->arrayToString($attributes);
      $this->db->select($selectString);
    }
    $this->db->from($table);
    $this->db->where($condition);
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
    $this->session->set_userdata($sessionName, $sessioData[0]);
  }

  public function checkSession($dest) // Check session function. this can use every page in website.
  {
    if ($this->session->userdata("user") == null){
      redirect(base_url()."home/login?redirect=".$dest);
    }
    return TRUE;
  }

  public function getQueue($dep_id){
    $counter = 0;
    $user = $this->session->userdata("user");
    $this->load->database();
    $this->db->from("userque");
    $this->db->where('dep_id', $dep_id);
    $this->db->where('called', NULL);
    $this->db->where('time >', date('Y-m-d H:i:s'));
    $this->db->order_by('time', 'asc');
    $data = $this->db->get();
    $this->db->close();
    if ($data->num_rows() > 0){
      foreach ($data->result_array() as $row) {
        if ($user['id'] == $row['user_id']) {
          break;
        }
        $counter++;
      }
    }
    return $counter;
  }

  public function getDep(){
    $user = $this->session->userdata("user");
    $this->load->database();
    $this->db->from("userque");
    $this->db->where('user_id', $user['id']);
    $this->db->where('called', NULL);
    $this->db->where('time >', date('Y-m-d H:i:s'));
    $this->db->order_by('time', 'asc');
    $data = $this->db->get();
    $this->db->close();
    if ($data->num_rows() > 0){
      foreach ($data->result_array() as $row) {
        $dep = $row['dep_id'];
        return $dep;
      }
    }
  }

}
?>
