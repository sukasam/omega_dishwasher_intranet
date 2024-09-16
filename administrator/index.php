<?php  
	include ("../include/config.php");
	include ("../include/connect.php");
	include ("../include/function.php");
	
	if($_SESSION["login_id"] != ""){
		header ("location:welcome/index.php");
	}
	
	if ($_GET['action'] == "check") { 
		$sql = "select * from s_user where username like '$_POST[login_name]' and password like '$_POST[passwd]'";
		$query = @mysqli_query($conn,$sql);
                $numuser = mysqli_num_rows($query);
                $rec = @mysqli_fetch_array($query);

		/*echo $numuser;
		break;*/

         if ($numuser != 0) { 
			$_SESSION["login_id"] = $rec["user_id"];
			$_SESSION["login_name"] = $rec["username"];
			$_SESSION["fullname"] = $rec["name"];
			$_SESSION["u_img"] = $rec["u_images"];
			header ("location:welcome/index.php");
		}else{
			/*$msg_login="Username or password incorrect !!";*/
			echo "<Script Language=\"JavaScript\">alert('Username or password incorrect !!');window.location='index.php';</Script>";}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>OMEGA Intranet System</title>
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />  
        <!--[if IE 7]><link rel="stylesheet" href="css/styleIE7.css" type="text/css" media="screen" /><![endif]-->
        <!--[if IE 8]><link rel="stylesheet" href="css/styleIE8.css" type="text/css" media="screen" /><![endif]-->
        <!--[if IE 9]><link rel="stylesheet" href="css/styleIE9.css" type="text/css" media="screen" /><![endif]-->
                
        <Script Language="JavaScript">
		function check(frm){
            if (frm.login_name.value.length==0 || frm.login_name.value == "User ID"){
                alert ('Please enter User ID!!');
                frm.login_name.focus(); return false;
            }
            if (frm.passwd.value.length==0 || frm.passwd.value == "Passwords"){
                alert ('Please enter Password!!');
                frm.passwd.focus(); return false;
            }	
		}	
		</Script>
     
    </head>
   
    <body style="background:#e1e1e1;">
       	<div id="webper_login">
        	<div id="logologin"><img src="images/template/logo_login.png" width="380" height="204" border="0" alt="" /></div>
            <div class="blogin">
            	<div id="login-wrapper" class="png_bg">
            <!-- End #logn-top -->
            <div id="login-content">
                <form name="frm" method="post" action="index.php?action=check" onSubmit="return check(this)">
                    
                    <p style="padding-bottom:17px;">
                        <input class="text-input" type="text" name="login_name" onblur="if(this.value==''){this.value='User ID';}" onclick="if(this.value=='User ID'){this.value='';}" value="User ID" style="text-align:center;"/>
                    </p>
                    <p style="padding-bottom:17px;">
                         <input class="text-input" type="password" name="passwd" onblur="if(this.value==''){this.value='Passwords';}" onclick="if(this.value=='Passwords'){this.value='';}" value="Passwords" style="text-align:center;"/>
                    </p>
                    <p>
                        <input type="image" src="images/template/bt_login.png" style="margin-right:9px;"/><a href=""><img src="images/template/bt_cancel.png" width="121" height="33" border="0" alt="" /></a>
                    </p>
                </form>
            </div>
            <!-- End #login-content -->
        </div>
            </div>            
        </div>
        <div class="footer">
        	<div class="fb">
            <ul>
            	<li class="blogo"><img src="images/template/footer_logo.png" width="106" height="42" border="0" alt="" /></li>
                <li class="bfooter" style="color:#FFFFFF;">OMEGA DISHWASHER (THAILAND) CO.,LTD. 31 Chokchai 4 (soi 50), Yak 4 Chokchai Road , Ladpraw, Bangkok 10230<br />
Tel : 02-530-6357 / Mobile : 086-085-5557<br />
Website : www.omegadishwasher-thailand.com&nbsp;&nbsp;E-mail : aapisak@hotmail.com</li>           
            </ul>
             <div class="clear"></div>
            </div>
        </div>
    </body>
</html>
