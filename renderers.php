<?php
 
class theme_cover_core_renderer extends core_renderer {

 protected function render_custom_menu(custom_menu $menu) {
 			
 			if (isloggedin()) {
 			$realuser = session_get_realuser();
            $fullname = fullname($realuser, true);
 			$branchlabel = $fullname;
            $branchurl = new moodle_url('/user/profile.php');
            $branchtitle = $branchlabel;
            $branchsort = -10000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			
 			$suburl = new moodle_url('/user/profile.php');
 			$branch->add(get_string('myprofile'), $suburl, get_string('myprofile'));
 			
 			$suburl = new moodle_url('/login/logout.php');
 			$branch->add(get_string('logout'), $suburl, get_string('logout'));
 			} else {
 			
 			$branchlabel = get_string('login');
            $branchurl = new moodle_url('/login/index.php');
            $branchtitle = $branchlabel;
            $branchsort = -10000;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			
 			}
 
 return parent::render_custom_menu($menu);
    }
	
///MCG I want the text in the breadcrump path to be displayed in white
 public function navbar() {
        $items = $this->page->navbar->get_items();

        $htmlblocks = array();
        // Iterate the navarray and display each node
        $itemcount = count($items);
        $separator = get_separator();
        for ($i=0;$i < $itemcount;$i++) {
            $item = $items[$i];
            $item->hideicon = true;
            if ($i===0) {
                $content = html_writer::tag('li_white', $this->render($item));
            } else {
                $content = html_writer::tag('li_white', $separator.$this->render($item));
            }
            $htmlblocks[] = $content;
        }

        //accessibility: heading for navbar list  (MDL-20446)
        $navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
        $navbarcontent .= html_writer::tag('ul', join('', $htmlblocks));
        // XHTML
        return $navbarcontent;
    }

}