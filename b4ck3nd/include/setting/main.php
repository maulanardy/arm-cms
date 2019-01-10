<?php 
use Ma\Controller\Setting\Main as Setting; 
use Ma\Model\Setting\Main as Model;

if(helper::getParam('update')){
  foreach ($_POST as $k => $v) {
    $data = Model::first('all', array('conditions' => array('key' => $k)));
    $edit = Model::find($data->id);

    if($edit){
      if(isset($_POST[$k."_title"]))
        $edit->title = $_POST[$k."_title"];
      $edit->value = $v;
      $edit->save();
    }
  }
}
?>

<div class="panel panel-default">
<div class="panel-heading">
    <div class="panel-title"><?php echo $page_title?></div>
</div>

<div class="panel-body">

<form action="" method="post" enctype="multipart/form-data" name="thesetting" id="setting">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO Basic</a></li>
    <!-- <li><a href="#theme" aria-controls="theme" role="tab" data-toggle="tab">Theme</a></li> -->
    <li><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Social</a></li>
    <li><a href="#maintenance" aria-controls="maintenance" role="tab" data-toggle="tab">Maintenance</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="seo">
      <div class="form-group">
        <label>Web Title : <em>*</em></label>
        <input class="form-control" type="text" name="default_web_title" id="default_web_title" value="<?php echo Setting::get('default_web_title')?>" />
      </div>
      <div class="form-group">
        <label>Web Keyword (Separated by commas)</label>
        <input class="form-control" type="text" name="default_web_keyword" id="default_web_keyword" value="<?php echo Setting::get('default_web_keyword')?>" /></td>
      </div>
      <div class="form-group">
          <label>Web Description
          <litle id="default_web_description-msg" class="screenHelp">Maximum 150 characters</litle></label>
          <textarea class="form-control" cols="50"  name="default_web_description" id="default_web_description" onKeyUp="checkMaxChars(default_web_description, 150)"><?php echo Setting::get('default_web_description')?></textarea>
      </div>
    </div>
    <!-- <div role="tabpanel" class="tab-pane" id="theme">
      
      <div class="form-group">      
        <p><strong>Current Theme</strong><br />
        <small>Click screenshot image to activate the theme</small>
        </p>

        <?php
        function themelist(){
          $startdir = '../themes/';
          $ignoredDirectory[] = '.';
          $ignoredDirectory[] = '..';
           if (is_dir($startdir)){
               if ($dh = opendir($startdir)){
                   while (($folder = readdir($dh)) !== false){
                       if (!(array_search($folder,$ignoredDirectory) > -1)){
                         if (filetype($startdir . $folder) == "dir"){
                               $directorylist[$startdir . $folder]['name'] = $folder;
                               $directorylist[$startdir . $folder]['path'] = $startdir;
                           }
                       }
                   }
                   closedir($dh);
               }
           }
        return($directorylist);
        }




        $folders = themelist();

        echo "<div>";

          foreach ($folders as $folder){
            $path = $folder['path'];
            $name = $folder['name'];

          if (file_exists("../themes/$name/screenshot.jpg")) 
          { $scrimage = "../themes/$name/screenshot.jpg"; }
          else if (file_exists("../themes/$name/screenshot.png")) 
          { $scrimage = "../themes/$name/screenshot.png"; }
          else 
          { $scrimage = "../images/noscreenshot.jpg"; }

          if ($name == $edit_active_template_folder) 
          { $scrstyle = "style=\"border:solid #999 3px;\""; }
          else 
          { $scrstyle = "style=\"border:none;\""; }

          echo "
            <div class=\"scrbox\" style=\"display: inline-block;margin:10px 10px 0px 0px\">
                <a href=\"javascript:update_template('$name')\"><img src=\"$scrimage\" alt=\"$name\" $scrstyle width=\"200\" height=\"200\" ></a>
              </div>\n
              ";
          
        }
        
        
        echo "</div>";
       
        ?>
      </div>

      <input type="hidden" name="templatefolder" id="templatefolder" value="<?php echo $edit_active_template_folder?>" />
    </div> -->
    <div role="tabpanel" class="tab-pane" id="profile">
      <div class="form-group">
          <label>Company Name</label>
          <input class="form-control" type="text" name="company_name" value="<?php echo Setting::get('company_name') ?>" />
      </div>
      <div class="form-group">
          <label>Address 1</label>
          <input class="form-control" type="text" name="address_1" value="<?php echo Setting::get('address_1') ?>" />
      </div>
      <div class="form-group">
          <label>Address 2</label>
          <input class="form-control" type="text" name="address_2" value="<?php echo Setting::get('address_2') ?>" />
      </div>
      <div class="form-group">  
          <label>Telepon</label>
          <input class="form-control" type="text" name="telp" value="<?php echo Setting::get('telp') ?>" />
      </div>
      <div class="form-group">  
          <label>Fax</label>
          <input class="form-control" type="text" name="fax" value="<?php echo Setting::get('fax') ?>" />
      </div>
      <div class="form-group">
          <label>Email Address</label>
          <input class="form-control" type="text" name="default_email" value="<?php echo Setting::get('default_email') ?>" />
      </div>
      <div class="form-group">
          <label>Email Address 2</label>
          <input class="form-control" type="text" name="alternate_email" value="<?php echo Setting::get('alternate_email') ?>" />
      </div>
      <div class="form-group">
          <label>Copyright</label>
          <textarea class="form-control" rows="5" name="short_company_profile" ><?php echo Setting::get('short_company_profile') ?></textarea>
      </div>
      <div class="form-group">
          <label>Google Maps Widget</label>
          <textarea class="form-control" rows="5" name="maps_widget" ><?php echo Setting::get('maps_widget') ?></textarea>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="social">
        <div class="form-group">
          <label>Facebook</label>
          <input class="form-control" type="text" name="facebook" value="<?php echo Setting::get('facebook') ?>" />
        </div>
        <div class="form-group">
          <label>Twitter</label>
          <input class="form-control" type="text" name="twitter" value="<?php echo Setting::get('twitter') ?>" />
        </div>
        <div class="form-group">
          <label>Youtube</label>
          <input class="form-control" type="text" name="youtube" value="<?php echo Setting::get('youtube') ?>" />
        </div>
        <div class="form-group">
          <label>Google Plus</label>
          <input class="form-control" type="text" name="gplus" value="<?php echo Setting::get('gplus') ?>" />
        </div>
        <div class="form-group">
          <label>Instagram</label>
          <input class="form-control" type="text" name="instagram" value="<?php echo Setting::get('instagram') ?>" />
        </div>
        <div class="form-group">
          <label>Linked In</label>
          <input class="form-control" type="text" name="linkedin" value="<?php echo Setting::get('linkedin') ?>" />
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="maintenance">
      <div class="form-group">  
        <label>Set to Offline for maintenace?</label>
        
        <?php
        $stat1 = ""; $stat2 = "";
        if ( Setting::get('web_offline_status') == "YES") { $stat1 = "checked=\"checked\" "; }
        else { $stat2 = "checked=\"checked\" ";}
        ?>
      
        <label style="font-weight:normal;">
          <input type="radio" name="web_offline_status" value="YES" id="web_offline_status" <?php echo $stat1?> />
          Yes
        </label>
        <label style="font-weight:normal;">
          <input name="web_offline_status" type="radio" id="web_offline_status" style="font-weight:normal;" value="NO" <?php echo $stat2?> />
          No
        </label>
      </div>
      <div class="form-group"> 
        <label>Maintenance Messages</label>
        <textarea class="form-control" name="web_offline_message" rows="5" id="web_offline_message" style="font-weight:normal;"><?php echo Setting::get('web_offline_message') ?>
        </textarea>
      </div>
    </div>
  </div>

</div>
    <br>
<div class="form-group">
<input type="submit" name="update" id="updbutton" value="Update Setting" class="button btn btn-primary" onclick="javascript:update_template('<?php echo $edit_active_template_folder?>')" />
</div>
</form>