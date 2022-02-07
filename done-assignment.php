
<?php

$con=mysqli_connect('localhost','root','');
if(!$con)
{
	echo "server not found";
}

if(!mysqli_select_db($con,'yagna'))
{
	echo"database not found";
}

//echo 'Good';
//die();
$id=$_GET['id'];
echo $id;
echo ' i pass here ';
//die();
//$qry="SELECT * FROM assignment WHERE id='$id'";
//$rs=mysqli_query($con,$qry);

$qry="SELECT * FROM assignment WHERE id='$id'";
$rs=mysqli_query($con,$qry);
$row=mysqli_fetch_array($rs);
//print_r($row);
//die();
$status=$row['status'];

//echo $status;
//die();
if($status==1)
{
	$qry1="UPDATE assignment SET status=2 where id='$id'";
	$rs1=mysqli_query($con,$qry1);
	
	 header("location:select-assignmnet.php");
}

?>