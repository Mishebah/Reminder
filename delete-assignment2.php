<?php
session_start();
?>

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
?>


<!DOCTYPE html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
	table{
border-collapse: collapse;
width: 100%;
background-color:white;
box-shadow: 0 4px 8px 0 rgba(0  , 0,0,0.2), 0 6px 20px 0 rgba(0 , 0,0,0.19);
margin-bottom:25px
}

th,td{
text-align:center;
padding:8px;}

tr:nth-child(even) {background-color: #f2f2f2}
th{ 
background-color: #222211;
color: white;
}
</style>
</head>
<body>
	<table border="1" width="100%">
		<th><font color="white"> <b> No. </b></font></th>
		<th><font color="white"> <b> TASK NAME </b></font></th>
		<th><font color="white"> <b> DATE TO BE DONE</b></font></th>
		<th><font color="white"> <b> DESCRIPTION </b></font></th>
		<th><font color="white"> <b> UNDO </b></font></th>
	
<?php
$email=$_SESSION["email2"];
$sql="SELECT * FROM assignment where status=0 && email='$email'";
$query=mysqli_query($con,$sql);
$num=1;
while($fetch=mysqli_fetch_array($query))
{
?>
	<tr>
		<td><?php echo $num;?></td>
		<td><?php echo $fetch['task'];?></td>
		<td><?php echo $fetch['dates'];?></td>
		<td><?php echo $fetch['message'];?></td>
		<td><a href="undo-assignment.php?id=<?php echo $fetch['id'];?>"> <i class="material-icons">&#xe166;</i> </a></td>
		<td> <?php ++$num ?></td>
	</tr>
	<?php	
}	

?>

</table>
</body>
</html>