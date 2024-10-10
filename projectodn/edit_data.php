<?php
include "logic.php";

if(isset($_GET['idd'])){
$idd=$_GET['idd'];

$myobj=new select_query1();

$table1="users";
$condition="id=$idd";

$get_data=$myobj->slct_dt1($table1,$condition);

if(isset($get_data[0])){
    echo "<h2>Update User Data</h2>";
    echo "<table>";
    foreach($get_data as $output){
        echo '
         <form action="logic.php" method="post">
         <label>Email</label>
         <input type="hidden" name="idu" value='.$output['id'].'>
         <input type="email" name="emailu" value='.$output['email'].'>
         <input type="submit" value="update" name="update">
         </form>
        ';
    }
    echo "</table>";
}
}
?>
<style>
    table,tr,th,td{
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
