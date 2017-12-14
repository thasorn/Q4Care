<?php
class Reserv extends CI_Model {

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
  public function isExist($attr, $value, $table=NULL)
  {
    if (empty($table)){
      $table = $this->getTable($attr);
    }
    $result = $this->getRecord($table, array($attr => $value));
    return ($result->num_rows() > 0);
  }

  public function getDepartments()
  {
    $departments = $this->getRecord('Departments');
    return $departments->result_array();
  }

  public function createTransaction($symptom, $date, $time, $doctor)
  {
    $user = $this->session->userdata("user");
    $rowData = array(
      'dep_id' => $symptom ,
      'user_id' => $user['id'],
      'time' => $this->convertDateTimeToSql($date,$time),
      'doc_id' => $doctor
    );
    return $this->insertRecord('UserQue', $rowData);
  }

  public function getPeriod()
  {
    $query = $this->getRecord('QuePeriod');
    $periods = $query->result_array();
    return $periods;
  }

  public function cancel($id)
  {
    $this->deleteRecord('UserQue', array('id'=>$id));
  }

  private function convertTimeToView($time)
  {
    $date = date("g:i a", strtotime($time));
    return $date;
  }

  private function convertDateToSql($date)
  {
    return str_replace('/', '-', $date);
  }

  private function convertDateTimeToView($date)
  {
    return str_replace('-', '/', $date);
  }

  private function convertDateTimeToSql($date,$time)
  {
    $date = DateTime::createFromFormat('d/m/Y g:i a', $date." ".$time);
    return $date->format('Y-m-d H:i');
  }

  public function getDoctors($dep_id=NULL)
  {
    $doctors = array();
    $query = (empty($dep_id))?$this->getRecord('Doctors'):$this->getRecord('Doctors', array('dep_id'=> $dep_id));
    foreach ($query->result_array() as $row) {
      if (empty($doctors[$row['dep_id']])){
        $doctors[$row['dep_id']] = array();
      }
      array_push($doctors[$row['dep_id']], $row);
    }
    return $doctors;
  }

  public function getFreePeriod($dep_id, $date)
  {
    $date = $this->convertDateToSql($date);
    $allPeriods = $this->getPeriod();
    $cond = array(
      'dep_id'=>$dep_id, 'called'=>NULL,
      'time >='=>date('Y-m-d H:i:s', strtotime($date.' '.$allPeriods[0]['start'])),
      'time <='=>date('Y-m-d H:i:s', strtotime($date.' '.$allPeriods[9]['start']))
    );
    $reserved = $this->getRecord('UserQue', $cond);
    if ($reserved->num_rows() > 0){
      foreach ($reserved->result_array() as $row) {
        $spli = explode(' ', $row['time']);
        $time = $spli[1];
        foreach ($allPeriods as $key => $row) {
          if ($time == $row['start']) {
            unset($allPeriods[$key]);
            break;
          }
        }
      }
    }
    foreach ($allPeriods as $key => $row) {
      $row['start'] = $this->convertTimeToView($row['start']);
      $row['stop'] = $this->convertTimeToView($row['stop']);

      $allPeriods[$key] = $row;
    }
    return $allPeriods;
  }

  public function getQueToday($dep_id)
  {
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    $cond = array(
      'dep_id' => $dep_id,
      'time >='=>date('Y-m-d H:i:s', strtotime($date.' 07:00:00')),
      'time <='=>date('Y-m-d H:i:s', strtotime($date.' 17:00:00')),
      'called'=>NULL
    );
    $result = $this->getRecord('UserQue', $cond)->result_array();
    foreach ($result as $key => $row) {
      $row['user'] = $this->getUName($row['user_id']);
      $row['doc'] = $this->getDName($row['doc_id']);
      $dateTime = explode(" ", $this->convertDateTimeToView($row['time']));
      $row['date'] = $dateTime[0];
      $row['time'] = $dateTime[1];

      $result[$key] = $row;
    }
    return $result;
  }

  public function getUName($id)
  {
    $data = $this->getRecord("UserInfo", array('id'=>$id))->result_array();
    return $data[0]['fname'].' '.$data[0]['lname'];
  }

  public function getDName($id)
  {
    $data = $this->getRecord("Doctors", array('id'=>$id))->result_array();
    return $data[0]['fname'].' '.$data[0]['lname'];
  }

  public function sendMailToUser()
  {
    date_default_timezone_set('Asia/Bangkok');
    $user = $this->session->userdata("user");
    $date = date('Y-m-d');
    $cond = array(
      'dep_id' => $user['dep'],
      'time >='=>date('Y-m-d H:i:s', strtotime($date.' 07:00:00')),
      'time <='=>date('Y-m-d H:i:s', strtotime($date.' 17:00:00')),
      'mail'=>NULL
    );
    $data = $this->getRecord('UserQue',$cond);
    foreach ($data->result_array() as $key => $row) {
      if($this->checkTime($row['time'])) {
        $this->sendMail($row);
      }
    }
  }

  private function checkTime($dateTime)
  {
    date_default_timezone_set('Asia/Bangkok');
    $comDate = explode(' ', $dateTime);
    $com = new DateTime($comDate[0].' 07:00:00');
    $dateTime = new DateTime(date('Y-m-d H:i:s'));
    return ($dateTime>$com);
  }

  public function sendMail($userTc)
  {
    $depName = $this->getDepName($userTc['dep_id']);
    $email = $this->getEmail($userTc['user_id']);
    $doc = $this->getDName($userTc['doc_id']);
    $name = "Q4care";
    $subject = "รายละเอียดการจองคิวโรงพยาบาล";
    $mess = '<html><body>';
    $mess = "<h1>สวัสดีค่ะ !</h1><br><h4>ยินดีต้อนรับสู่โรงพยาบาล</h4><p>คุณได้ทำการจองคิวสำหรับการเข้าพบ".$doc." เพื่อทำการตรวจอาการเจ็บป่วยของคุณที่ ".$depName."ในเวลา ".$userTc['time']."โปรดเผื่อเวลาการเดินทางมายังห้องตรวจอย่างน้อย 15 นาที</p><br><br><p>ขอขอบพระคุณค่ะ</p><br><br><p>หมายเหตุ :<br>1.หากคุณไม่ได้ใช้อีเมลล์นี้ทำการจองคิวที่โรงพยาบาลคุณไม่จำเป็นต้องสนใจอีเมลนี้<br>2.หากภายใน 5 นาที ท่านยังเดินทางไม่ถึงห้องตรวจทางโรงพยาบาลขอสงวนสิทธิในการยกเลิกคิวดังกล่าว</p>";
    $mess .= '</body></html>';
    $header = "FROM: 58070115@kmitl.ac.th"."\r\n";
    $header .= "Content-Type: text/html; charset=utf-8\r\n";
    //Mail Part
    mail($email, $subject, $mess, $header);
    $userTc['mail'] = 1;
    $this->updateRecord('UserQue', $userTc, array('id'=>$userTc['id']));
  }

  public function getDepName($id)
  {
    return $this->getRecord('Departments', array('id'=>$id))->result_array()[0]['name'];
  }

  public function getEmail($id)
  {
    return $this->getRecord('UserInfo', array('id'=>$id))->result_array()[0]['email'];
  }

  public function test()
  {
    echo ($this->sendMailToUser());
  }
}
?>
