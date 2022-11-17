<?php
require_once "connection.php";
$a1 = $a2 = $a3 = "";
$a4 = $a5 = $a6 = "";
$a7 = $a8 = "";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
$sql = "SELECT id FROM users WHERE email = ? OR mnumber = ? ";
$stmt = mysqli_prepare($conn, $sql);
	if($stmt)
	{
		mysqli_stmt_bind_param($stmt,"ss",$param_username1,$param_username2);
		$param_username1=$_POST['email'];
		$param_username2=$_POST['mnumber'];
		
		if(mysqli_stmt_execute($stmt))
		{
			mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) == 1)
		{
			echo '<script type="text/JavaScript"> 
     alert("Already taken");
     </script>'
	 ;
		}
		else
		{
			$a1=$_POST['Fname'];
			$a2=$_POST['Lname'];
			$a3=$_POST['email'];
			$a4=$_POST['password'];
			$a5=$_POST['gender'];
			$a6=$_POST['mnumber'];
		}
		}
	}
	else{
		error11();
	}
mysqli_stmt_close($stmt);

if(empty($a1))
{
	echo "unknown error";
}
else
{
	$sql="INSERT INTO users(Fname,Lname,email,password,gender,mnumber) values (?,?,?,?,?,?)";
	$sqml = mysqli_prepare($conn ,$sql);
	if($sqml)
	{
		mysqli_stmt_bind_param($sqml ,"sssssi",$pa1,$pa2,$pa3,$pa4,$pa5,$pa6);
		$pa1=$a1;
		$pa2=$a2;
		$pa3=$a3;
		$pa4=$a4;
		$pa5=$a5;
		$pa6=$a6;
		
		if (mysqli_stmt_execute($sqml))
        {
			sleep(5);
            header("location: index.html");
			echo '<script type="text/JavaScript"> 
     				alert("successful!! wait 5 sec to get redirected...");
     				</script>'
					;
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
	}
	mysqli_stmt_close($sqml);
}
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign in</title>
	</head>
	<body>
	<h1>Sign in</h1>
	<form  action="" method="post">
	<table  cellpadding="15" bgcolor="#ffffff" width="1000">
	<TR>
	<td>FIRST NAME</td>	
	<td><input type="text" name="Fname" placeholder="ENTER  FIRST NAME" required/></td>	
	</TR>
	<TR>
	<td>LAST NAME</td>	
	<td><input type="text" name="Lname" placeholder="ENTER LAST NAME" required/></td>	
	</TR>
	<TR>
	<td>E-MAIL</td>	
	<td><input type="email" name="email" placeholder="ENTER YOUR EMAIL" required/></td>	
	</TR>	
	<TR>
	<td>PASSWORD</td>	
	<td><input type="password" name="password" placeholder="ENTER  PASSWORD" required/></td>	
	</TR>	
	<TR>
	<td>GENDER</td>
	<td>
	<input type="radio" name="gender"  id="male" required/><label for="male">MALE</label>
	<input type="radio" name="gender"  id="female" required/><label for="female">FEMALE</label>
	<input type="radio" name="gender"  id="others" required/><label for="others">OTHERS</label>
	</td>
	</TR>	
	<TR>
	<td>MOBILE NO.</td>	
	<td><input type="number" name="mnumber" placeholder="ENTER MOBILE NO." onselect="keyboardme();" required/></td>	
	</TR>
	<tr>
	<td colspan="2"><input type="checkbox" required/>TERMS AND CONDITIONS</td>	
		
	</tr>	
	<TR>	
	<td><button type="submit" name="sumn" onsubmit="subme();">submit</button></td>
	<td><button type="reset" onclick="retme();" >reset</button></td>
	</TR>	
	</table>	
	</form>
	<script>
		function subme(){
			alert("successful")
		}
		function retme(){
			alert("reset")
		}
		function keyboardme(){
			alert("error")
		}
	</script>
	</body>
</html>