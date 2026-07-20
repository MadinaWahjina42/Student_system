<?php 
include 'config.php'; 

// كود الحذف
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: ViewStudent.php");
}

// كود التحديث
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $conn->query("UPDATE students SET student_id='$student_id', name='$name', department='$department', email='$email' WHERE id=$id");
    header("Location: ViewStudent.php");
}

// جيب بيانات الطالب لو ضغط Edit
$edit_data = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM students WHERE id=$id");
    $edit_data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        table{border-collapse: collapse; width: 90%; margin: 20px auto;}
        th, td{border: 1px solid black; padding: 10px; text-align: center;}
        th{background-color: #4CAF50; color: white;}
        h2{text-align: center;}
        .edit{background-color: #2196F3; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;}
        .delete{background-color: #f44336; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;}
        .form-box{width: 40%; margin: 20px auto; border: 2px solid #4CAF50; padding: 20px; border-radius: 10px; background: #f9f9f9;}
    </style>
</head>
<body>
<h2>All Students</h2>
<a href="Addstudent.php" style="display:block; text-align:center; font-size:18px;">+ Add New Student</a>

<?php if($edit_data){ ?>
<div class="form-box">
<h3 style="text-align:center;">Edit Student</h3>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
    Student ID: <input type="text" name="student_id" value="<?php echo $edit_data['student_id']; ?>"><br><br>
    Name: <input type="text" name="name" value="<?php echo $edit_data['name']; ?>"><br><br>
    Department: <input type="text" name="department" value="<?php echo $edit_data['department']; ?>"><br><br>
    Email: <input type="text" name="email" value="<?php echo $edit_data['email']; ?>"><br><br>
    <input type="submit" name="update" value="Update">
    <a href="ViewStudent.php">Cancel</a>
</form>
</div>
<?php } ?>

<?php
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<table>";
    echo "<tr><th>ID</th><th>Student ID</th><th>Name</th><th>Department</th><th>Email</th><th>Action</th></tr>";
    
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['student_id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['department']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>
                <a href='ViewStudent.php?edit=".$row['id']."' class='edit'>Edit</a> 
                <a href='ViewStudent.php?delete=".$row['id']."' class='delete' onclick=\"return confirm('Are you sure?')\">Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No Students Found</p>";
}
$conn->close();
?>
</body>
</html>
