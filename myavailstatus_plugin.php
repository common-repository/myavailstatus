<?php /*
Plugin Name: MyAvailStatus
Plugin URI:  http://www.431verstaerker.de/myavailstatus-2/
Description: Display your Availability Status to in your sidebar using widget to your visitor. Based on MyMood 1.2 by Webgarb.
Version: 0.9.1
Author: Anders Balari
Author URI: http://www.431verstaerker.de
*/


/*  Copyright 2012  Anders Balari  (email : anders.balari@431verstaerker.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


register_activation_hook(__FILE__, 'myavailstatus_activ');
add_action('admin_menu', 'myavailstatus_adminoption');

function myavailstatus_activ() {

add_option("myavailstatus_news","");
add_option("myavailstatus_news_date","");
add_option("myavailstatus_smiley","2.png");
add_option("myavailstatus_status","Schwebend");
add_option('myavailstatus_smiley_show','1');
add_option("myavailstatus_mood_text","Status:");
add_option('myavailstatus_separator_color','c0c0c0');
add_option('myavailstatus_separator_show','1');
add_option('myavailstatus_status_show','1');
add_option('myavailstatus_widget_title','Verfügbarkeit');

add_option("myavailstatus_else","Ho, I have just installed MyAvailStatus!");
return true;
}
function myavailstatus_adminoption() {
  
  add_options_page('MyAvailStatus Plugin option area','MyAvailStatus', 7,__FILE__, 'myavailstatus_adminpanel');

  }
  
  
  
  
function myavailstatus_adminpanel() {  ?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>

<h2>MyAvailStatus (0.9) <?php _e("Settings"); ?></h2>
<div style="clear:both"></div>
<?php
 
$myavailstatus_moods = array('Frei', 'Verf&uuml;gbar', 'Gebucht', 'Besch&auml;ftigt', 'Nicht verf&uuml;gbar', 'Eingeschr&auml;nkt verfügbar', 'Schwebend', 'Free', 'Available', 'Booked', 'Busy', 'Not Available', 'Pending', 'Partly Available');

if($_POST[Update] == true) {
update_option('myavailstatus_smiley', $_POST['myavailstatus_smiley']);
update_option('myavailstatus_status', $_POST['myavailstatus_status']);
update_option('myavailstatus_else',stripslashes($_POST['myavailstatus_else']));
update_option('myavailstatus_mood_text', stripslashes($_POST['myavailstatus_mood_text']));
update_option('myavailstatus_separator_color',$_POST["myavailstatus_separator_color"]);
update_option('myavailstatus_separator_show',$_POST["myavailstatus_separator_show"]);
update_option('myavailstatus_smiley_show',$_POST['myavailstatus_smiley_show']);
update_option('myavailstatus_status_show',$_POST['myavailstatus_status_show']);
_e('<div id="message" class="updated fade">
  <p>
    <strong>Status saved.</strong>
  </p>
</div>');
} 


$myavailstatusdir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

?>

<div class="postbox-container" style="width:70%">

<!-- JS COLOR SCRIPT -->
<script type="text/javascript" src="<?php echo $myavailstatusdir; ?>/jscolor/jscolor.js"></script>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class="form-table">

<tr valign="top">
<th scope="row">Icon <br />
 <span class="description">Select the icon representing your status.</span>
</th>

    <td  style="height:48px;"><img style="margin-left:6px; margin-top:-2px" src="<?php echo $myavailstatusdir; ?>/status/<?php echo get_option('myavailstatus_smiley'); ?>" width="35" height="35" alt="icon" id="myavailstatus_smileyimg" onclick="smiley_myavailstatusopen()" /> 
   
    <div id="myavailstatus_smileys" style="display:none">  
      <div style="position:absolute; z-index:110; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:smiley_myavailstatusopen();" onclick="smiley_myavailstatusopen();">X</a></strong></div>
  <div style="position:absolute; margin-top:-10px; z-index:4; border-style:solid; border-width:2px; border-color:#FC0; background-color:#FFC; overflow:scroll; height:150px;  width:400px"> 
<?php 
for($i = 1; $i <= 18; $i++) {
_e(' <img src="'.$myavailstatusdir.'/status/'.$i.'.png" alt="Loading..." onclick="smiley_myavailstatus(this)" />
   ');
}
?>
   </div>  
   
   
    </div>
    
    <script type="text/javascript">
        function smiley_myavailstatusopen() {
        var availstatus = document.getElementById("myavailstatus_smileys");
                if(availstatus.style.display == '') {        
availstatus.style.display = 'none';                
                } else {
availstatus.style.display = '';                                
                }
        availstatus.onblur = function () {
        availstatus.style.display = 'none';        
        }
        }
    function smiley_myavailstatus(id) {

        image = id.src;
   image = image.split("/");
   for(i=0; i < image.length; i++) {
        tmp = image[i];   
   }
 var image = tmp;
 document.getElementById("myavailstatus_smiley").value = tmp;
document.getElementById("myavailstatus_smileyimg").src = id.src;

          }
      </script>
	 <br /> <br /><label for="myavailstatus_smiley_show">Show icon
<select name="myavailstatus_smiley_show">
<option value="1" <?php echo (get_option("myavailstatus_smiley_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("myavailstatus_smiley_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>
      <input  name="myavailstatus_smiley" id="myavailstatus_smiley" value="<?php echo get_option('myavailstatus_smiley'); ?>" type="hidden" />
    </td>
  </tr>
  
  
  <tr valign="top">
<th scope="row"><?php _e("Status") ?> :<br />
<span class="description">Enter your availability status or select it.</span>
</th>
  
      <td> <label for="myavailstatus_status"> Your Status </label> : <input class="regular-text" onfocus="status_myavailstatusopen();" value="<?php echo get_option('myavailstatus_status'); ?>" type="text" name="myavailstatus_status" id="myavailstatus_status" /> 
      <a href="javascript:;" onclick="status_myavailstatusopen();">Select one</a> 
      <script type="text/javascript">
        function status_myavailstatusopen() {
        var availstatus = document.getElementById("myavailstatus_statusdiv");
                if(availstatus.style.display == '') {        
availstatus.style.display = 'none';                
                } else {
availstatus.style.display = '';                                
                }
        availstatus.onblur = function () {
        availstatus.style.display = 'none';        
        }
        }
      function status_myavailstatus(id) {
        document.getElementById("myavailstatus_status").value = id.innerHTML;        status_myavailstatusopen();
          }
      </script>
      <div style="display:none" id="myavailstatus_statusdiv"> 
      <div style="position:absolute; z-index:110; margin-top:-15px; background-color:#E6E6E6"><strong><a href="javascript:;" onclick="status_myavailstatusopen()">X</a></strong></div>
      <div style="overflow:scroll; position:absolute;  z-index:111; z-index:2px; height:150px; background-color:white; border-color:gray; border-width:1px; border-style:solid;">
      <table border="0">
          <?php
          foreach($myavailstatus_moods as $myavailstatus_moods) {
         echo ' <tr>
    <td onclick="status_myavailstatus(this)" style="background-color:#FFC; border-style:solid; border-width:1px; border-color:#CCC;">'.$myavailstatus_moods.'</td>
  </tr>'; 
          
          
          }
          ?>
</table></div></div><br />
<label for="myavailstatus_separator_show">Show Status
<select name="myavailstatus_status_show">
<option value="1" <?php echo (get_option("myavailstatus_status_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("myavailstatus_status_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>

</td>
  </tr>
  
  <tr valign="top">
<th scope="row"><?php _e("Description") ?> :<br />
<span class="description"> Enter description of your status (optional). </span>
</th>
    <td>
	<script type="text/javascript" src="<?php echo $myavailstatusdir; ?>/nicEdit.js"></script> 
	<textarea  cols="70" rows="10" name="myavailstatus_else" id="myavailstatus_else"  class="codepress css"><?php echo get_option('myavailstatus_else'); ?></textarea>
	
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { 
	  new nicEditor({ 	buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','indent','outdent','link','unlink','forecolor','bgcolor'],iconsPath : '<?php echo $myavailstatusdir; ?>/nicEditorIcons.gif'}).panelInstance('myavailstatus_else');
});
	</script></td>
  </tr>

  <!-- Separator  TEXT -->
  <tr>
  <th scope="row"><?php _e("Separator") ?> : <br />
 <span class="description">Separator Setting.</span>
</th>
<td>
<label for="myavailstatus_separator_color">Color :</label> 
<input class="color regular-text" value="<?php echo get_option('myavailstatus_separator_color'); ?>" type="text" name="myavailstatus_separator_color"/> 
<br/>
<label for="myavailstatus_separator_show">Show Separator
<select name="myavailstatus_separator_show">
<option value="1" <?php echo (get_option("myavailstatus_separator_show") != "0")?'selected="selected"':''; ?>>Yes</option>
<option value="0" <?php echo (get_option("myavailstatus_separator_show") == "0")?'selected="selected"':''; ?>>No</option>
</select></label>
</td>  
  </tr>
  <!-- Status TEXT -->
  <th scope="row"><?php _e("Mood Text") ?> : <br />
 <span class="description">Status text to be shown to visitor.</span>
</th>
<td>
<input class="regular-text" value="<?php echo get_option('myavailstatus_mood_text'); ?>" type="text" name="myavailstatus_mood_text"/> 
</td>

  
  <tr>
    <td height="26">&nbsp;</td>
    <td>
      <input type="submit" name="Update" class="button-primary" value="Update" />
    </td>
  </tr>
</table></form></div></div>


<!-- NEWS (inactive) -->

<?php 
if(get_option("myavailstatus_news") == "") {
/** $balari_news = wp_remote_fopen("http://www.431verstaerker.de/2012/03/09/myavailstatus-v0-9/"); */
$balari_news = "Currently no news. Enjoy life!";
update_option("myavailstatus_news",$balari_news);
update_option("myavailstatus_news_date",date("Y-m-d",strtotime("+2 day")));
}
$extime = strtotime(get_option("balari_news_date"));
$nowtime = strtotime(date("Y-m-d"));
if($nowtime > $extime) {
/* $balari_news = wp_remote_fopen("http://www.431verstaerker.de/2012/03/09/myavailstatus-v0-9/"); */
$balari_news = "Currently no news. Enjoy life!";
update_option("myavailstatus_news",$balari_news);
update_option("myavailstatus_news_date",date("Y-m-d",strtotime("+2 day")));
}

?>
<div class="postbox-container" style="width:28%">

 <center>
 <a href="http://www.431verstaerker.de/myavailstatus-2/" target="_blank" title="Visit the Plugin Page on 431verstaerker"><img src="<?php echo $myavailstatusdir."/logo.png"; ?>" border="0">
 </a> 
 </center>
 
<?php 
echo get_option("myavailstatus_news"); 
?>
</div>
<div class="clear"></div>

<!-- NEWS END -->





<span class="description"><a href="http://www.431verstaerker.de/2012/03/09/myavailstatus-v0-9/">MyAvailStatus</a> &copy;2012 Anders Balari.<br />
</span>


<h2>PHP Code for adding into Templete.</h2>
You can add a MyAvailStatus Widget or use the code below to insert it into your theme.
<br />
<!--PHP CODE-->
<div class="php" style="font-family:monospace;color: #006; border: 1px solid #d0d0d0; background-color: #f0f0f0;"><ol><li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;"><span style="color: #000000; font-weight: bold;">&lt;?php</span> </div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;</div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;myavailstatus_display<span style="color: #009900;">&#40;</span><span style="color: #009900;">&#41;</span></div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;">&nbsp;</div></li>
<li style="font-weight: normal; vertical-align:top;font: normal normal 130% 'Courier New', Courier, monospace; color: #003030;"><div style="font: normal normal 1em/1.2em monospace; margin:0; padding:0; background:none; vertical-align:top;;white-space: nowrapcolor: #000020;"><span style="color: #000000; font-weight: bold;">?&gt;</span></div></li>
</ol></div>
<!--END PHP CODE-->

<?php


}
//ADMIN PANEL FUNCTION END !
//Manual 
function myavailstatus_display() {
$myavailstatusdir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
echo '
<!-- MyAvailStatus Plugin 0.9.1 -->
  '.((get_option("myavailstatus_smiley_show") =='0')?'':'<img src="'.$myavailstatusdir.'/status/'.get_option("myavailstatus_smiley").'" border="0" style="float:left;margin: 5px 4px 5px 5px;">').'

  '.((get_option("myavailstatus_status_show") == '0')?'':'<p style="margin-top: 5px; margin-bottom: 0;"><b>'.__(get_option("myavailstatus_mood_text")).'</b><br />'.__(get_option("myavailstatus_status")).'').'  </p><br />
   
   '.((get_option("myavailstatus_separator_show") == '0')?'<div style="display:block"></div>':'<div style="background-color:#'.get_option("myavailstatus_separator_color").'; border:0; height: 1px; width:50%; margin-left: 10px; margin-top: 3px; margin-bottom: 3px"></div>').' 
   
	<div style="margin: 10px 10px 5px 10px;">'.stripslashes(get_option("myavailstatus_else")).'</div><div style="clear:left;"></div>';
} 

//Display Widget
function myavailstatus_display_widget() {
$myavailstatusdir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
echo '
    <ul>
        <li>
            '.((get_option("myavailstatus_smiley_show") =='0')?'':'<img src="'.$myavailstatusdir.'/status/'.get_option("myavailstatus_smiley").'" border="0" class="myavailstatus_wicon" style="float:left;margin: 0 4px 5px 0;">').'

            '.((get_option("myavailstatus_status_show") == '0')?'':'<p class="myavailstatus_wtext" style="margin-top: 5px; margin-bottom: 0;"><b>'.__(get_option("myavailstatus_mood_text")).'</b><br />'.__(get_option("myavailstatus_status")).'').'  </p></li><br />
   
            '.((get_option("myavailstatus_separator_show") == '0')?'<div style="display:block"></div>':'<div style="background-color:#'.get_option("myavailstatus_separator_color").'; border:0; height: 1px; width:50%; margin-left: 10px; margin-top: 3px; margin-bottom: 3px"></div>').' 
   
        <li class="myavailstatus_wdesc" style="clear: left;">'.stripslashes(get_option("myavailstatus_else")).'</li>
    </ul>
    ';
} 
 
//Widget
function myavailstatus_widget($args) {
extract($args);

$myavailstatusdir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

$title = get_option("myavailstatus_widget_title");

echo $before_widget; 
echo $before_title.$title. $after_title; 
myavailstatus_display_widget();
echo $after_widget;
}

//WIDGET CONTROL 

function myavailstatus_control() {
if(isset($_POST["myavailstatus_widget_title"])) {
update_option("myavailstatus_widget_title",$_POST["myavailstatus_widget_title"]);
}
echo '<p><label for="myavailstatus_widget_title">Title :</label><input class="widefat" name="myavailstatus_widget_title" value="'.get_option("myavailstatus_widget_title").'"  type="text"></p>';
}
function myavailstatus_widget_installer() {
register_sidebar_widget(_('MyAvailStatus Widget'),'myavailstatus_widget');
  register_widget_control("MyAvailStatus Widget",'myavailstatus_control',0 , 0 );
}
add_action("plugins_loaded", "myavailstatus_widget_installer");
?>