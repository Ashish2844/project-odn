<?php

class mydb{
    private $server;
    private $username;
    private $password;
    private $dbname;

    function dbconct(){
        $this->server="127.0.0.1";
        $this->username="root";
        $this->password="";
        $this->dbname="intern_db";

        $myconn=new mysqli($this->server,$this->username,$this->password,$this->dbname);

        return $myconn;
    }
}

class insert_query extends mydb{
   public function insrt_dt($table,$field,$value){
       
    $data="INSERT INTO $table ($field) VALUES ($value)";
    
    $data_query=$this->dbconct()->query($data);

    if($data_query){
        return "Inserted";
    }
    }
}

class select_query extends mydb{
  public function slct_dt($table1){
    
    $data1="SELECT * FROM $table1";

    $slctquery=$this->dbconct()->query($data1);

    if($slctquery->num_rows>0){
      while($getrow=$slctquery->fetch_assoc()){
        $getresult[]=$getrow;
      }
      return $getresult;
    }
    
  }
}

class select_query1 extends mydb{
  public function slct_dt1($table1,$condition){
    $data2="SELECT * FROM $table1 WHERE $condition";

    $slctquery1=$this->dbconct()->query($data2);

    if($slctquery1->num_rows>0){
      while($getrow1=$slctquery1->fetch_assoc()){
        $getresult1[]=$getrow1;
      }
      return $getresult1;
    }
    
  }
  }


class delete_query extends mydb{
  public function delete_dt($table2,$condition2){
    $data3="DELETE FROM $table2 WHERE $condition2";

    $deletequery=$this->dbconct()->query($data3);

    if($deletequery){
      return "deleted";
    }
  }
}

class update_query extends mydb{
  public function update_dt($table,$set,$onbasis){
    $data4="UPDATE $table SET $set WHERE $onbasis";
    
    $updt_query=$this->dbconct()->query($data4);
    if($updt_query){
      return "updated";
    }
  }
}

if(isset($_POST['submit'])){
  $full_name=sanitize($_POST['full_name']);
  $email=sanitize_email($_POST['email']);
  $password=sanitize($_POST['password']);
  $gender=$_POST['gender'];
  $hobbies=$_POST['hobbies'];
  $hobb1=implode(",",$hobbies);
  
  if(($full_name=="") || ($email=="") || ($password=="") || ($gender=="") || ($hobb1=="")){
     echo "<script>alert('all field is mandatory')</script>";
     return false;
  }
  elseif(!filter_var($email, filter:FILTER_VALIDATE_EMAIL)){
    echo "your email is invalid";
    return false;
  }
  else{
    $myobj=new insert_query();

    $table="users";
    $field="id,full_name,email,password,gender,hobbies";
    $value="null,'$full_name','$email','$password','$gender','$hobb1'";
  
    $insrt=$myobj->insrt_dt($table,$field,$value);
  
    if($insrt=="Inserted"){
      echo "<script>alert('Data inserted')</script>";
      echo "<script>window.location.href='user_registration.php'</script>";
    }
    return true;
  }
  }

function sanitize($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}

function sanitize_email($email){
  return filter_var($email, filter:FILTER_VALIDATE_EMAIL);
}


if(isset($_POST['update'])){
  $emailu=$_POST['emailu'];
  $idu=$_POST['idu'];

  $myobj2=new update_query();

  $table="users";
  $set="email='$emailu'";
  $onbasis="id=$idu";

  $updatquery=$myobj2->update_dt($table,$set,$onbasis);

  if($updatquery=="updated"){
    echo "email updated <br>";
    echo "<a href='user_data.php'>Click here to get back</a>";
  }
}


if(isset($_GET['iddel'])){
  $iddel=$_GET['iddel'];

$myobj2=new delete_query();

$table2="users";
$condition2="id=$iddel";

$delete_data=$myobj2->delete_dt($table2,$condition2);

if($delete_data="deleted"){
    echo "data deleted";
}
}


if(isset($_POST['upload'])){
  $idi=$_POST['idi'];
$file=$_FILES['image'];


$file_name=$_FILES["image"]["name"];
$temp_name=$_FILES["image"]["tmp_name"];

$check=$_FILES["image"]["type"];
$size=$_FILES["image"]["size"];

$folder="uploads/".$file_name;

if($size<3000000){

  if(($check!="image/png") && ($check!="image/jpg") && ($check!="image/jpeg")){
    echo "image format is not correct";
  }

  else{
    if(move_uploaded_file($temp_name,$folder)){
        $myobj3=new update_query();
        $table="users";
        $set="image='$folder'";
        $onbasis="id=$idi";

        $updatequery=$myobj3->update_dt($table,$set,$onbasis);
        if($updatequery=="updated"){
          echo "<script>alert('Image uploaded successfully')</script>";
          echo "<script>window.location.href='user_data.php'</script>";

        }
    }
  }
}

}


?>