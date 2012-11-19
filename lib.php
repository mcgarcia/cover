<?php
 //user defined columns to show or now
function cover_initialise_colpos(moodle_page $page) {
    user_preference_allow_ajax_update('theme_cover_chosen_colpos', PARAM_ALPHA);
}

function cover_get_colpos($default='panelopen') {
    return get_user_preferences('theme_cover_chosen_colpos', $default);
}


function cover_process_css($css, $theme) {
	
	
	if (!empty($theme->settings->headercolor)) {
        $headercolor = $theme->settings->headercolor;
    } else {
        $headercolor = null;
    }
    $css = cover_set_headercolor($css, $headercolor);
	
	
    // Set the link color
    if (!empty($theme->settings->linkcolor)) {
        $linkcolor = $theme->settings->linkcolor;
    } else {
        $linkcolor = null;
    }
    $css = cover_set_linkcolor($css, $linkcolor);

	// Set the link hover color
    if (!empty($theme->settings->linkhover)) {
        $linkhover = $theme->settings->linkhover;
    } else {
        $linkhover = null;
    }
    $css = cover_set_linkhover($css, $linkhover);
        

    // Return the CSS
    return $css;
}

/**
 * Sets the link color variable in CSS
 *
 */
 
function cover_set_headercolor($css, $headercolor) {
    $tag = '[[setting:headercolor]]';
    $replacement = $headercolor;
    if (is_null($replacement)) {
        $replacement = '#E2472F';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
} 
 
function cover_set_linkcolor($css, $linkcolor) {
    $tag = '[[setting:linkcolor]]';
    $replacement = $linkcolor;
    if (is_null($replacement)) {
        $replacement = '#0b4a5b';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function cover_set_linkhover($css, $linkhover) {
    $tag = '[[setting:linkhover]]';
    $replacement = $linkhover;
    if (is_null($replacement)) {
        $replacement = '#666666';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

///MCG  Customising footer

function customised_footer($page, $output) {
?>
 <div id="page-footer">
     <ul id="footer_links">
     <li><a href="http://www.dasmaninstitute.org/">Dasman Diabetes Institute</a></li>
     <li><a href="http://www.moh.gov.kw/">Ministry of Health, State of Kuwait</a></li>
    <li><a href="http://www.moh.gov.kw/">&copy;  UoD in partnership with DDI</a></li>
   
  </ul>
 
  <ul id="footer_powered_by">
   <li class="moh"><a href="http://www.moh.gov.kw/">&nbsp;</a></li>
   <li class="dundee"><a href="http://www.dundee.ac.uk">&nbsp;</a></li>
   <li class="dasmaninstitute"><a href="http://www.dasmaninstitute.org">&nbsp;</a></li>
   <li class="idf"><a href="http://www.idf.org">&nbsp;</a></li>
   <li class="nhstayside"><a href="http://www.nhstayside.scot.nhs.uk/">&nbsp;</a></li>
   <li class="aridhia"><a href="http://www.aridhia.com">&nbsp;</a></li>
  </ul>
   <p class="copyright"> brought to you by &copy; Mari Cruz García 2013 </p>
    
    </div>
<?php
}

