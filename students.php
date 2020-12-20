<!doctype html>
<?php
$servername = "localhost";
$username="root";
$password="";
$dbname="students";
$Rollno="";
$fname="";
$lname="";
$address="";
$email="";
 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
//connect to mysql database
try{
$conn =mysqli_connect($servername,$username,$password,$dbname);
}catch(MySQLi_Sql_Exception $ex){
echo("error in connecting");
}
//get data from the form
function getData()
{
$data = array();
$data[0]=$_POST['Rollno'];
$data[1]=$_POST['fname'];
$data[2]=$_POST['lname'];      //index arrays
$data[3]=$_POST['address'];
$data[4]=$_POST['email'];
return $data;
}
//search
if(isset($_POST['search']))
{
$info = getData();
$search_query="SELECT * FROM students WHERE Rollno = '$info[0]'";
$search_result=mysqli_query($conn, $search_query);
if($search_result)
{
if(mysqli_num_rows($search_result))
{
while($rows = mysqli_fetch_array($search_result))
{
$Rollno = $rows['Rollno'];
$fname = $rows['fname'];
$lname = $rows['lname'];
$address = $rows['address'];
$email = $rows['email'];
 
}
}else{
echo("no data are available");
}
} else{
echo("result error");
}
 
}
//insert
if(isset($_POST['insert'])){
$info = getData();
$insert_query="INSERT INTO students(fname, lname, address, email) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]')";
try{
$insert_result=mysqli_query($conn, $insert_query);
if($insert_result)
{
if(mysqli_affected_rows($conn)>0){
echo("Data inserted successfully");
 
}else{
echo("Data are not inserted");
}
}
}catch(Exception $ex){
echo("error inserted".$ex->getMessage());
}
}
//delete
if(isset($_POST['delete'])){
$info = getData();
$delete_query = "DELETE FROM students WHERE Rollno = '$info[0]'";
try{
$delete_result = mysqli_query($conn, $delete_query);
if($delete_result){
if(mysqli_affected_rows($conn)>0)
{
echo("Data deleted");
}else{
echo("Data not deleted");
}
}
}catch(Exception $ex){
echo("error in delete".$ex->getMessage());
}
}
//edit
if(isset($_POST['update'])){
$info = getData();
$update_query="UPDATE students SET fname='$info[1]',lname='$info[2]',address='$info[3]',email='$info[4]' WHERE Rollno = '$info[0]'";
try{
$update_result=mysqli_query($conn, $update_query);
if($update_result){
if(mysqli_affected_rows($conn)>0){
echo("Data updated");
}else{
echo("Data not updated");
}
}
}catch(Exception $ex){
echo("error in update".$ex->getMessage());
}
}
 
?>
<html>
<head>
<meta charset="utf-8">
<title>Students Form</title>
</head>
 
<body style="background-color:powderblue;">
<center>
    <h1 style="color: red;"><i><b><u> Welcome To The Student Form</u></b></i></h1>
<form method ="post" action="students.php">
<input type="number" name="Rollno" placeholder="Roll No" value="<?php echo($Rollno);?>"><br><br>
<input type="text" name="fname" placeholder="First Name" value="<?php echo($fname);?>"><br><br>
<input type="text" name="lname" placeholder="Last Name" value="<?php echo($lname);?>"><br><br>
<input type="text" name="address" placeholder="Address" value="<?php echo($address);?>"><br><br>
<input type="text" name="email" placeholder="example@example.com" value="<?php echo($email);?>"><br><br>
<div>
<input type="submit" name="insert" value="Add">
<input type="submit" name="delete" value="Delete">
<input type="submit" name="update" value="Update">
<input type="submit" name="search" value="Find">
 
<img src="1.jpg" width="1550" height="700"></img>
</div>
</form>
</center>
</body>
</html>