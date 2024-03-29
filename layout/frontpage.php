<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
$haslogo = (!empty($PAGE->theme->settings->logo));

//get userpref for col open or closed 
///MCG If we disable the accordion menu, this is not going to be of use for us
cover_initialise_colpos($PAGE);
$usercol = cover_get_colpos();
if($usercol == "headerclosed") {
	$thedisplay = "inherit";
	$themenu = "handleclosed";
} else {
	$thedisplay = "block";
	$themenu = "down";
}


$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

if ($hascustommenu) {
    $bodyclasses[] = 'has_navbar';
}

if ($haslogo) {
	$bodyclasses[] = 'has_logo';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">
	<div id="wrapper">
	
<!-- start OF header -->
<div id="header-wrapper" style="display: <?php echo $thedisplay; ?>" class="<?php echo $usercol; ?>">		
<div id="b-wrapper">
	<div id="b-wrapper-inner">
	<!-- start of navbar -->
	<?php if ($hasnavbar) { ?>
        <div class="navbar clearfix2">
          <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
        </div>
	<?php } ?>
	<!-- end of navbar -->
	
	
	<div class="headermenu">
        		<?php
	        	    echo $OUTPUT->login_info();
    	        	echo $OUTPUT->lang_menu();
	        	    echo $PAGE->headingmenu;
		        ?>	    
	</div>
	</div>
</div>
	<div id="page-header" class="page-header-home"  >
			<?php if ($haslogo) {
						// MCG I modified this bit adding height and width for our logo 25-06-2012
                        echo html_writer::link(new moodle_url('/'), "<img src='".$PAGE->theme->settings->logo."' id='logo'   alt='logo'  />");
                    } else { ?>
			<img src="<?php echo $OUTPUT->pix_url('logo', 'theme')?>"  id="logo">
			<?php } ?>
				
		</div>
</div>		
<!-- end of header -->		

<!-- start of custom menu -->
<div id="menu-wrap" class="<?php echo $usercol; ?>">	
<?php if ($hascustommenu) { ?>
<div id="custommenu">
<div id="menu-shortname"><?php echo $this->page->course->shortname ?></div>
<?php echo $custommenu;

///MCG in this bit is where you get rid of that annoying toggle icon
 ?>

</div>

<?php } ?>
<!-- end of menu -->	
</div>

<div id="page-content-wrapper">
<!-- start OF moodle CONTENT -->
 <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">
            
                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                        
      		 <?php /// MCG this is the bit changed to display different information for looged/unlogged users
		if (!isloggedin() or isguestuser()) {
   		 include('top-heading.php');
		} else {
   		 include ('logged_frontpage.php') ;
		} /// MCG keep all the changes limited to this area
		
		?> 

                 <?php 
						
						 
						 echo  $OUTPUT->main_content() ;
						 
					
						 ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>
                
                <?php if ($hassidepost) { ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
<!-- end OF moodle CONTENT -->
<div class="clearer"></div>
</div>
<!-- end OF moodle CONTENT wrapper -->


<!-- start of footer -->	
<div id="page-footer">
<?php

 customised_footer($PAGE, $OUTPUT); 

///echo $OUTPUT->home_link();
echo $OUTPUT->standard_footer_html();
?>
</div>
<!-- end of footer -->	


<div class="clearer"></div>

	</div><!-- end #wrapper -->
</div><!-- end #page -->	

<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>