<?php
 include'config.php';
$msg="";
if(isset($_POST['submit'])){
$student_id= $_POST['student_id'];
$name=$_POST['name'];
$department=$_POST['department'];
$email=$_POST['email'];

$sql= "INSERT INTO students (student_id,name,department,email)VALUES('$student_id','$name','$department','$email')";
if($conn->query($sql)===TRUE){ 
$msg="Student Added successfully!";
}else{
$msg="Error:".$conn->error;
}
}
?>



<!DOCTYPE html>
<html >
<head>
<title> Add Student</title></head>
<body>
<h2> Add New Student</h2>
<p style="color:green"> <?php echo $msg;?></p>
<form method="POST">
<label>Student ID:</label><br>
<input type="text" name="student_id" required><br><br>
<label>Name:</label><br>
<input type="text" name="name" required><br><br>
<label>Department:</label><br>
<input type="text" name="department" required><br> <br>
<label>Email:</label><br>
<input type="text" name="email" required><br><br>
<input type="submit" name="submit"  value="Add Student">
</form>
</body>
</html>
