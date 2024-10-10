<?php
include "logic.php";

$myobj=new select_query();

$table1="users";

$get_data=$myobj->slct_dt($table1);

if(isset($get_data[0])){
    echo "<h2>User Data</h2>";
    echo "<table>";
    echo '<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Hobbies</th>
    <th>Upload Image</th>
    <th>Edit user</th>
    <th>Delete user</th>
    </tr>';
    foreach($get_data as $output){
        echo '
        <tr>
        <td>'.$output['full_name'].'<br></td>
        <td>'.$output['email'].'<br></td>
        <td>'.$output['gender'].'<br></td>
        <td>'.$output['hobbies'].'<br></td>
        <td>'.$output['image'].'<br></td>
        <td>
        <form action="logic.php" method="post" enctype="multipart/form-data">
            <label>Upload image</label>
            <br><br>
            <input type="hidden" value='.$output['id'].' name="idi">
            <input type="file" name="image">
            <br><br>
            <input type="submit" value="upload" name="upload">
        </form>
        </td>
        <td><a href="edit_data.php?idd='.$output['id'].'">Edit</a><br></td>
        <td><a href="logic.php?iddel='.$output['id'].'">Delete</a><br></td>
        </tr>
        ';
    }
    echo "</table>";
}
?>
<style>
    table,tr,th,td{
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
