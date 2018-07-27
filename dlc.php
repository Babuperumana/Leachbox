<?php

require_once('rl_init.php');
error_reporting(0);
ignore_user_abort(true);

login_check();

require(TEMPLATE_DIR . '/header.php');
?>
    <?
     
    error_reporting(E_ALL);
    ini_set("display_errors",1);
     
    
    ?>
	  <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-dashboard"></i> 
				<span>Downloadmanager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-share"></i> Download</a></li>
				<?php
				if (!$options['auto_download_disable']) {
				?>
                <li><a href="audl.php"><i class="fa fa-share"></i> Multidownload</a></li>
				<?php
				}
				if (!$options['auto_upload_disable']) {
				?>
				<li><a href="auul.php"><i class="fa fa-upload"></i> <?php echo lang(335); ?></a></li>
				<?php
				}
				if (!$options['notes_disable']) {
				?>
				<li><a href="javascript:openNotes();"><i class="fa fa-edit"></i> <?php echo lang(327); ?></a></li>
				<?php
				}
				?>
              </ul>
            </li>
          </ul>
        </section>
      </aside>

<div class="content-wrapper">		

<section class="content-header">
          <ol class="breadcrumb" style="cursor:pointer;">
            <li><a href="./"><i class="fa fa-dashboard"></i> Zur Startseite</a></li>
          </ol>
</section>

<section class="content" style="padding-top:50px;">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-check"></i> W&auml;hle einen oder mehrere Container aus:</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
    <form role="form" action="" method="POST">
	<div class="form-group">
    <?php
	if(!isset($_POST['submit'])) {
    $path = dirname(__FILE__)."/files/";
    foreach (glob($path."*.dlc") as $filename) {
        echo "<input type='radio' name='file' value='".basename($filename)."' /> ".basename($filename)."<br />";
    }
    echo "<br><input type='submit' class='btn btn-primary' style='cursor:pointer;' name='submit' value='DLC Entschl&uuml;sseln' />";
    echo "</div>";
	echo "</form>";
     } else {
    //print_r($_POST);
     
    $header = array(
                    "Accept-Language: en-us,en;q=0.5",
                    "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
                    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
                    "Keep-Alive: 115",
                    "Connection: keep-alive",
            );             
                           
                            $file = dirname(__FILE__)."/files/".$_POST['file'];
                            $postfields = array("dlcfile" => "@$file",
                                                                    'dlcfile"; filename="'=> basename($file)
                                                                    );
                            $ch = curl_init();
                            curl_setopt($ch,CURLOPT_URL,"http://dcrypt.it/decrypt/upload");
                            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
                            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
                            curl_setopt($ch, CURLOPT_REFERER,'http://dcrypt.it/');
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS,$postfields);                      
                            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,"120");
                            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux x86_64; en-GB; rv:1.9.1.7) Gecko/20100106 Ubuntu/9.10 (karmic) Firefox/3.5.7');
                            curl_setopt ($ch, CURLOPT_HEADER, 1 );
                            $result = curl_exec($ch);
                            $error=curl_error($ch);
                            curl_close($ch);
     
    preg_match_all('#(http://[^"]+)#i', $result, $matches);
    $links = implode("<br />", $matches[1]);
    //print_r($matches);
                    echo "<a href='dlc.php'>Weitere Archive verarbeiten</a><br /><br><br><b>Die Links des Containers:</b><br><br>";
                    echo $links;
                    echo ("<br>");         
                   
    }?>
    </div></div>
	</section>
	</div>
    
<?php include(TEMPLATE_DIR.'footer.php'); ?>
