<?php 
if($_POST[seo]=="Submit"){
	$sql="update s_module set tag_title='$_POST[tag_title]' ,tag_meta='$_POST[tag_meta]' where module_name='".$check_module."' ";
	@mysql_query($sql);
	//header ("location:index.php?page=$_GET[page]");
}

$sql = "select * from s_module where module_name='".$check_module."' ";
$query = @mysql_query ($sql);
$rec_tag = @mysql_fetch_array ($query);
$tag_title=$rec_tag["tag_title"];
$tag_meta=$rec_tag["tag_meta"];
?>
<fieldset>
<legend>SEO</legend>
<table width="100%" cellspacing="10" cellpadding="0" border="0">
  <tr>
    <td width="770" colspan="3" valign="bottom"><form name="form2" method="post" action="">
      <table width="100%" border="0">
        <tr >
          <td class="name" style="vertical-align:top;">Tag title </td>
          <td><textarea name="tag_title" rows="3" id="tag_title"><?php  echo $tag_title;?></textarea>
              
</td>
        </tr>
        <tr >
          <td nowrap="nowrap" class="name" style="vertical-align:top;">Tag meta</td>
        <td><textarea name="tag_meta" rows="3" id="tag_meta"><?php  echo $tag_meta;?></textarea>
               </td>
        </tr>
        <tr >
          <td>&nbsp;</td>
          <td><strong>หมายเหตุ :</strong> ข้อมูลที่กรอกใน Tag title และ Tag meta จะมีผลต่อ SEO หรือการทำให้ Google รู้จักเว็บเรามากยิ่งขึ้น</td>
        </tr>
        <tr >
          <td>&nbsp;</td>
          <td><label>
            <input type="submit" name="seo" id="seo" value="Submit">
          </label></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</fieldset>
