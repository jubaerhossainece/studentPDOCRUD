<?php

class Database{
    
    private $hostdb = "localhost";
    private $userdb = "root";
    private $passdb = "jubaer";
    private $namedb = "db_student";
    
    private $pdo;
    
    public function __construct(){
if(!isset($this->pdo)){
     $dsn = "mysql:host=".$this->hostdb."; dbname=".$this->namedb;
    try {
        $link = new PDO($dsn, $this->userdb,$this->passdb);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo = $link;
    } catch (PDOException $ex){
        die("Failed to connect with Database".$ex->getMessage());
    }   
  }
}

    
    //read data
    /*
    $sql = $this->pdo->prepare("SELECT * FROM tblname WHERE id=:id AND email=:email LIMIT 1");
    $query = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':email', $email);
    $sql->execute();
    */
public function select($table, $data = array()){
    $sql = 'SELECT ';
    $sql.= array_key_exists("select", $data)?$data['select']:'*';
    $sql.= ' FROM '.$table;
    if(array_key_exists("where", $data)){
        $sql.= ' WHERE ';
        $i = 0;
        foreach($data['where'] as $key => $value){
            $add = ($i > 0)?' AND':'';
            $sql.="$add"."$key=:$key";
            $i++;
        }
    }
    
    if(array_key_exists('order_by', $data)){
        $sql.=" ORDER BY ".$data['order_by'];
    }
        if(array_key_exists('start', $data) && array_key_exists('limit', $data)){
            $sql.=' LIMIT '.$data['start'].' '.$data['limit'];
        } elseif(!array_key_exists('start', $data) && array_key_exists('limit', $data)){
            $sql.=' LIMIT '.$data['limit'];
        }
    $query = $this->pdo->prepare($sql);
    if(array_key_exists('where', $data)){
        foreach($data['where'] as $key => $value){
            $query->bindValue(":$key", $value);
        }
    }
    $query->execute();
    
    if(array_key_exists('return_type', $data)){
        switch($data['return_type']){
            case 'count':
                $value = $query->rowCount();
            break;
            case 'single':
                $value = $query->fetch(PDO::FETCH_ASSOC);
                break;
                
            default:
                $value = '';
        }
    } else{
        if($query->rowCount() > 0) {
            $value = $query->fetchAll();
        }
    } 
    return !empty($value)?$value:false;
}
    
//insert data
    /*
    $sql = "INSERT INTO tablename (name, email, phone) VALUES(:name, :email, :phone)";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':email', $email);
    $query->bindValue(':phone', $phone);
    $query->execute();
    
    
    */
 public function insert($table, $data){
     if(!empty($data) && is_array($data)){
         $keys = '';
         $values = '';
         
         $keys = implode(',', array_keys($data));
         $values = ":".implode(', :', array_keys($data));
         $sql = "INSERT INTO ".$table." (".$keys.") VALUES (".$values.")";
         $query = $this->pdo->prepare($sql);
         
         foreach($data as $key => $val){
             $query->bindValue(":$key", $val);
         }
         $insertdata = $query->execute();
         if($insertdata){
             $lastId = $this->pdo->lastInsertId();
             return $lastId;
         }else{
             return false;
         }
     }
 }    

    
    //Update Data
    /*
    $sql = "UPDATE tablename SET name=:name, email=:email, WHERE id=:id";
    $query = $this->pdo->prepare($sql);
    $query->$bindValue(':name', $name);
    $query->bindValue(':email', $email);
    $query->bindValue(':id', $id);
    $query->execute();
    */
    
    
 public function update($table, $data, $cond){
     if(!empty($data) && is_array($data)){
         $keyvalue = '';
         $whereCond = '';
         
         $i = 0;
         foreach($data as $key => $val){
             $add = ($i > 0)?' , ':'';
             $keyvalue.= "$add"."$key=:$key";
             $i++;
         }
         
         if(!empty($cond) && is_array($cond)){
             $whereCond.= " WHERE ";
             $i = 0;
             foreach($cond as $key => $val){
                 $add = ($i > 0)?' AND ':'';
                 $whereCond.= "$add"."$key=:$key";
                 $i++;
             }
         }
         
         $sql = "UPDATE ".$table." SET ".$keyvalue.$whereCond;
         $query = $this->pdo->prepare($sql);
         
         foreach($data as $key => $val){
             $query->bindValue(":$key", $val);
         }
         
         foreach($cond as $key => $val){
             $query->bindValue(":$key", $val);
         }
         
         
         $update = $query->execute();
         return $update?$query->rowCount():false;
     }else{
         return false;
     }
 }    
    
    
   //Delete Data 
    /*
    $sql = "DELETE FROM tablename WHERE id=:id";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();
    */
    public function delete($table, $data){
      if(!empty($data) && is_array($data)){
        
          
          $whereCond .=" WHERE ";
        $i = 0;
        foreach($data as $key => $val){
            $add = ($i > 0)?' AND ':'';
            $whereCond .="$add"."$key=:$key";
            $i++;  
      }
      
    }
        $sql = "DELETE FROM ".$table.$whereCond;
        $query = $this->pdo->prepare($sql);
        
        foreach($data as $key => $val){
            $query->bindValue(":$key", $val);
        }
        $delete = $query->execute();
        return $delete?true:false;
    }
}

?>
















