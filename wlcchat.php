<style type="text/css">#dwin {width: 400px;background-color: #000;border: solid 5px #7e7e7e;text-align: center;font-family: AGoogle;font-size: 16px;color: #6e6e6e;font-family: AGoogle;box-shadow: #bdbdbd 1px 1px 1px;padding-right: 5px;padding-left: 5px;border-radius: 10px;position: fixed;left: 35%;top: 30%;padding-bottom: 15px;background-color: #000000b3;border: 3px solid rgb(0, 0, 0);font-family: AGoogle}#dwin:hover {background-color: #000000b3;border: 3px solid rgb(0, 0, 0);box-shadow: 0 0 20px rgb(0, 126, 253) }#dclose {float: right;margin-right: 5px;color: #f03;cursor: pointer;font-weight: bold;font-family: AGoogle}#ptablig {margin-top: 30px;font-size: .9em;font-family: AGoogle}
#head_Title{
font-size: medium; 
color: #29a2d5;
text-align:center;
}
</style>
<?php $pmwlc = json_decode($options['pmwlc'], true); ?>
<div id="closead">
<div id="dwin">
<div id="dclose" onclick="document.getElementById ('closead').style.display='none'" >بستن اين پنجره [X]</div>
<div id="ptablig" align="center">
<span id="head_Title"><?php echo($pmwlc['head_Title']) ?></span>
</div>
<br>
<div align="center">
<font color="<?php echo($pmwlc['title_color']); ?>" size="3"><?php echo($pmwlc['Title']) ?></font><br>
</div>
<br>
<span style="font-size: medium; color: <?php echo($pmwlc['pmone_color']); ?>;"><marquee direction="right" behavior="scroll" dir="rtl" style=" border: dashed 1px #016E92;border-left: 4px #ff1010 solid;border-right: 4px #ff1010 solid;border-radius: 20px;" loop="-1" scrollamount="2" scrolldelay="1" onmouseover="this.setAttribute('scrollAmount', 0, 0)" onmouseout="this.setAttribute('scrollAmount', 2, 0)" height="24" width="350"><?php echo($pmwlc['pm_one']) ?></span></marquee>
<br><br>
<div align="center"><font face="AGoogle" color="<?php echo($pmwlc['Fsturl_color']); ?>" size="5"><?php echo($pmwlc['Fst_url']) ?></font></div>
<div align="center"><font face="AGoogle" color="<?php echo($pmwlc['Securl_color']); ?>" size="5"><?php echo($pmwlc['Sec_url']) ?></font></div>
<div align="center"><font face="AGoogle" color="<?php echo($pmwlc['thdurl_color']); ?>" size="5"><?php echo($pmwlc['thd_url']) ?></font></div>
<br>
<div align="center"><b class="vbirancheshmak" >
<a href="<?php echo($pmwlc['link']) ?>" target="_blank" style="font-size: 20px;color: <?php echo($pmwlc['id_color']); ?>;"> <?php echo($pmwlc['id_tel']) ?><br><?php echo($pmwlc['pm_link']) ?> </a>
<br><br>
<font size="3" color="<?php echo($pmwlc['pmelse_color']); ?>" face="AGoogle"> <?php echo($pmwlc['pm_else']) ?> </font>
<br></div>