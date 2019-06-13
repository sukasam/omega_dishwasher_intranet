<!-- 

class : a:current is open all menu 
class : li a:current is a now active


-->

<DIV id=sidebar>

<?php  //$pageURL = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
//	$pp = strrpos($_SERVER["SCRIPT_NAME"],"/");
 //   $pageURL = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/"));
//	echo "<center>".$_SERVER["REQUEST_URI"]."</center>";
	//echo "<center>".$pageURL."</center>";
	$arr = explode("/",$_SERVER["REQUEST_URI"]);
	//echo "directory=>".$arr[3];
	
?>
  <DIV id=sidebar-wrapper>
      
   <div align="center" style="width:100%;"><A href="#" target="_blank"><IMG  alt="Admin logo" src="../images/logo.png" border="0"></A></div><BR>
  <DIV id=profile-links>Hello,<A href="#"> <?php  echo $_SESSION["login_name"];?></A><BR>
        <BR>
        <a href="<?php  echo $s_domain.$s_paths;?>" target="_blank" title="View the Site">View the Site</a> | <A title="Sign Out" href="../logout.php">Sign Out</A>
        </DIV>
    <UL id=main-nav>
      <!-- Accordion Menu -->
     
      
      <?php 

	  $mid=$_GET['mid'];

	  $subid=$_GET['smid'];

	  

	  if($mid==""){

		  $mid=1;

		}

      

	  $sqlmenu = "select * from tb_menu_cate order by rank asc";

	  $query = @mysqli_query($conn,$sqlmenu)or die(mysql_error());

	  while($rsmenu = @mysqli_fetch_array($query)){

			

			$sqlsubmenu ="select * from tb_menu_submenu where menucate_id=$rsmenu[menucate_id] order by tb_menu_submenu.rank asc";

			$querysubmenu = @mysqli_query($conn,$sqlsubmenu)or die(mysql_error());

			$count = @mysqli_num_rows($querysubmenu);

			//echo $sqlsubmenu;

				

			if($count<1){ ?>
      <li><a class='nav-top-item no-submenu <?php  if($mid==$rsmenu['menucate_id']){ echo "current";}?>' href="<?php =$rsmenu['url_link']?>?mid=<?php =$rsmenu['menucate_id']?>">
        <?php =$rsmenu['menucate_name']?>
      </a></li>
      <?php  }else{?>
      <li><a class='nav-top-item <?php  if($mid==$rsmenu['menucate_id']){ echo "current";}?>' href='#' >
        <?php =$rsmenu['menucate_name']?>
        </a>
          <?php   echo "<UL>";

						while($rssubmenu=@mysqli_fetch_array($querysubmenu)){ ?>
      </li>
      <li><a href="<?php =$rssubmenu['submenu_url_link']?>?smid=<?php =$rssubmenu['id']?>&amp;mid=<?php =$rsmenu['menucate_id']?>" <?php  if($subid==$rssubmenu['id']){echo "class='current'";}?>>
        <?php =$rssubmenu['submenu_name']?>
      </a></li>
      <?php  }

                     	echo "</UL>"; // end sub menu

			echo "</LI>";

			} // end if $count

	  }//end while menu

	  ?>
<LI></LI>
      
      <LI></LI>
      
      <LI><A class='nav-top-item <?php  if($_GET[mid]==9999){ echo "current";}?>'  href="#">User Management</A>
          <UL>
            <LI><A   href="../../administrator/user/?smid=3&mid=9999" onclick="setCurrent(this)" <?php  if($_GET[smid]==3){echo "class='current'";}?>>User / permission</A></LI>
            <LI><A  href="../../administrator/group/?smid=4&mid=9999" <?php  if($_GET[smid]==4){echo "class='current'";}?>>User Group / permission</A></LI>   
          </UL>
      </LI>    
      <LI><A class='nav-top-item <?php  if($_GET[mid]==8888){ echo "current";}?>'  href="#">Setting</A>
       <UL>
       	<?php  if($_SESSION["login_id"]==1){?>
         <LI><A  href="../../administrator/menu/?smid=5&mid=8888" <?php  if($_GET[smid]==5){echo "class='current'";}?>>Menu</A></LI>  
         <LI><A  href="../../administrator/module/?smid=6&mid=8888" <?php  if($_GET[smid]==6){echo "class='current'";}?>>Module</A></LI> 
         <?php  }?>
         <!--<LI><A  href="../../administrator/footer/?smid=7&mid=2" <?php  if($_GET[smid]==7){echo "class='current'";}?>>Webpage Footer</A></LI>       -->
          </UL>
      </LI>
      
      <LI>
      	<A class="nav-top-item no-submenu" href="../logout.php">Sign Out</A>      </LI>
    </UL>
    <!-- End #main-nav -->
    <DIV style="DISPLAY: none" id=messages>
      <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
      <H3>3 Messages</H3>
      <P> <STRONG>17th May 2009</STRONG> by Admin<BR>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <SMALL><A class=remove-link title="Remove message" href="#">Remove</A></SMALL> </P>
      <P><STRONG>2nd May 2009</STRONG> by Jane Doe<BR>
        Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est 
        malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est. <SMALL> <A class=remove-link title="Remove message" href="#">Remove</A></SMALL> </P>
      <P><STRONG>25th April 2009</STRONG> by Admin<BR>
        Lorem ipsum dolor sit amet,consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <SMALL><A class=remove-link title="Remove message" href="#">Remove</A></SMALL> </P>
      <FORM method=post action="">
        <H4>New Message</H4>
        <FIELDSET>
          <TEXTAREA class=textarea rows=5 cols=79 name=textfield></TEXTAREA>
        </FIELDSET>
        <FIELDSET>
          <SELECT class=small-input name=dropdown>
            <OPTION selected 
  value=option1>Send to...</OPTION>
            <OPTION value=option2>Everyone</OPTION>
            <OPTION value=option3>Admin</OPTION>
            <OPTION value=option4>Jane 
              Doe</OPTION>
          </SELECT>
          <INPUT class=button value=Send type=submit>
        </FIELDSET>
      </FORM>
    </DIV>
    <!-- End #messages -->
  </DIV>
</DIV>

