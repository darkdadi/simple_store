<?php
class SampleModule {
  private $db; //db connection

  function __construct($connection)
  {
      $this->db=$connection;
  }

  function listSample() : array
  {
    $sql = "SELECT row_id, generated_id, item_name FROM sample_module";
    $this->db->setStatement($sql);
    $this->db->querySQL([]);
    $res = $this->db->stmt->fetchAll(PDO::FETCH_ASSOC); 
    if(count($res)!=0){
        return ['valid'=>true, 'data'=>$res];
    } else {
        return ['valid'=>false, 'data'=>[]];
    }
  }

  function updateSample(int $row_id, string $item_name) : bool
  {
      $flag = false;
      $sql= "UPDATE sample_module SET item_name = ? WHERE row_id = ?";
  
      $this->db->beginTransaction();
      $this->db->setStatement($sql);
      try {
          $this->db->execSQL([$item_name, $row_id]);
          $this->db->commitTransaction();
          $flag = true;
      } catch(Exception $err) {
          $this->db->rollBack();
      }
  
      return $flag;
  }

  function createSample(string $item_name) : bool
  {
      $flag = false;
      $sql = "SELECT CONCAT('SMP', LPAD((count(row_id)+1),5,'0')) as gen_id FROM sample_module FOR UPDATE";
      $this->db->setStatement($sql);
      $this->db->querySQL([]);
      $res = $this->db->stmt->fetchAll(PDO::FETCH_ASSOC); 
      if(count($res)!=0){
        $sql= "INSERT INTO sample_module (generated_id,item_name) VALUES(?, ?)";
  
        $this->db->beginTransaction();
        $this->db->setStatement($sql);
        try {
            $this->db->execSQL([$res[0]['gen_id'],$item_name]);
            $this->db->commitTransaction();
            $flag = true;
        } catch(Exception $err) {
            $this->db->rollBack();
        }
      }

      return $flag;
  }
}