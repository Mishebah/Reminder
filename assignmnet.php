<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assignmnet.css">
</head>


<body>
	
		<form method="post" >
            <table border="1" >
		<tr>
			<td><font color="white"> <b>TASK NAME </b> </font></td>
			
            <td><font color="white"> <b>DATE TO BE DONE </b></font> </td>
            <td><font color="white"> <b>DESCRIPTION</b></font></td>
			<td><font color="white"> <b>Enter emails seperated by comma, </b> </font></td>
			
        </tr>

        
        <tr>
            <td> <input type="text" name="task"></td><br>
			
            <td> <input type="date" name="date"></td><br>
            <td><textarea name="message" rows="5" cols="30"></textarea></td>
			<td> <input type="email" name="email" multiple></td><br><br>
        </tr>

        <tr>
           
            <td colspan="3"><input type="submit" name="submit" value= "SUBMIT"></td>
        </tr>

      </table>



    </form>
  

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

if(isset($_POST['submit']))
{
	$task=$_POST['task'];
	$dates=$_POST['date'];
	$message=$_POST['message'];
    $email = trim(str_replace(' ','',$_POST['email']));
	/*
	$arra=explode(",",$e);
	
	for($i=0;$i<count($arra);++$i)
   {print_r( $arra[$i]);
    echo"<br>";
   }
	die();
	*/
	$sql="INSERT INTO assignment(id,task,dates,message,status,email,emailstatus) VALUES('','$task','$dates','$message','1','$email','1')";
	$query=mysqli_query($con,$sql);
}

?>



</body>
</html>
