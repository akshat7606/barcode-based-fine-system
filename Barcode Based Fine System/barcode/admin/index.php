<?php
  session_start();
   error_reporting(0);
     
      if( $_SESSION['id'] == session_id().$_SESSION['salt'] )
	 {
		header('Location:home.php');
		exit();

	 }
 
      if(isset($_POST['adminlogin']))
	 {
		mysql_connect('localhost','root','')or die("Connection Problem");
		mysql_select_db('cashdigi');			
		$un = $_POST['adminuser'];
		$pwd = $_POST['adminpass'];
		
		if( trim($un) == '' || trim($pwd) == '')
		{
			$err=" ID PASSWORD REQUIRED !!!";
			
		}else{
		
		$q = "select * from admin_login where username='$un' and password='$pwd'";
		$rs = mysql_query($q);
		$num=mysql_num_rows($rs);
		
		if($num==1)
		{
			$_SESSION['salt'] = time().$_SERVER['REMOTE_ADDR'] ; //to make unique
			$_SESSION['id']=session_id().$_SESSION['salt'];
			header('Location:home.php');
			exit();
			
		}
		 else
		{
			$err="Invalid ID PASSWORD !!! ";
		}
	  }
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('#adminlogin').submit(function(){
				
			$('.err').remove();	
			var username = $('#adminuser').val().trim();
			var adminpass = $('#adminpass').val().trim();
			//var chkname=/^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
			var flag=1;
			
			if(username.length==0)
			{
				$('#adminuser').closest('tr').append('<td class="err" style="color:red;">* REQUIRED</td>')	;
				flag = 0;
			}
			 if(adminpass.length==0)
			{
			   $('#adminpass').closest('tr').append('<td class="err" style="color:red;">* REQUIRED</td>')	;
			   flag = 0;
			}
			
			if(flag)
			{
			   return true;	
			}
			else
			{
				
			 return false;	
			}
			
			
			});
    });

</script>

</head>

<body>
<noscript>

	<meta http-equiv="refresh" content="0;url=..\javascripterror.php">
    
</noscript>

	<h1 align="center"> ADMIN LOGIN </h1>
 <div style="text-align: center;">
  <div style="box-sizing: border-box; display: inline-block; width: auto; max-width: 480px; background-color: #FFFFFF; border: 2px solid #0361A8; border-radius: 5px; box-shadow: 0px 0px 8px #0361A8; margin: 50px auto auto;">
    <div style="background: #0361A8; border-radius: 5px 5px 0px 0px; padding: 15px;"><span style="font-family: verdana,arial; color: #D4D4D4; font-size: 1.00em; font-weight:bold;">Admin Login Panel</span></div>
    <div style="background: ; padding: 15px">
      <style type="text/css" scoped>
	td { text-align:left; font-family: verdana,arial; color: #064073; font-size: 1.00em; }
	input { border: 1px solid #CCCCCC; border-radius: 5px; color: #666666; display: inline-block; font-size: 1.00em;  padding: 5px; width: 100%; }
	input[type="button"], input[type="reset"], input[type="submit"] { height: auto; width: auto; cursor: pointer; box-shadow: 0px 0px 5px #0361A8; float: right; text-align:right; margin-top: 10px; margin-left:7px;}
	table.center { margin-left:auto; margin-right:auto; }
	.error { font-family: verdana,arial; color: #D41313; font-size: 1.00em; }
	</style>

 <?php if ( isset($err) ){  ?>   
 <div id="msg" style="background-color:#F96; color:#0CF; height:25px; width:100%;" align="center"><?php echo $err;unset($err); ?></div>
  <?php } ?>  
	<form action="" method="post" id="adminlogin">
           <table width="300px"  align="center">
          <tr>
            <td colspan="2"><input type="text" name="adminuser" id="adminuser" placeholder="username" /></td>
          </tr>
          <tr>
            <td colspan="2"><input type="password" name="adminpass" id="adminpass" placeholder="password" /></td>
          </tr>
          <tr>
            <td><input type="submit" name="adminlogin" id="adminlogin" /></td>
           </tr>
        </table>

    
    </form>
     </div>
  </div>
</div>

</body>
</html>
