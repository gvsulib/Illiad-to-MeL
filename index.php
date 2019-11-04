<?php
header("Access-Control-Allow-Origin: *");

include('../../libs/simple_html_dom.php');

// Load MeL search page

$book_title = $_REQUEST['t'];

$url = 'http://elibrary.mel.org/search/a?searchtype=t&searcharg=' . $book_title . '&SORT=D&submit=Submit';

$html = file_get_html($url);

// Determine if a title is available:

$html->find('.bibScreeen');

if(count($html->find('.bibScreen')) > 0) { // Takes you to a record

	echo '<div class="overlay"><div class="modal-box"><h4>Other Michigan libraries may have this item</h4><p class="line">You can get it faster by requesting it directly from the Michigan eLibrary (MeL).</p><p><span style="display:inline-block;float:left;"><a class="btn btn-default" id="mel-redirect" target="_blank" href="' . $url . '">Request from another Michigan Library</a></span> <span style="display:inline-block;float:right;" class="close-button">Request through Document Delivery</span></p></div></div>';
	
}

if(count($html->find('.browseScreen')) > 0) { // List of results

	// Is this a no results screen?
	if(count($html->find('tr.yourEntryWouldBeHere')) > 0) {

		echo '<!-- Not available in MeLCat-->';

	} else { // Possible results

		'<div class="overlay"><div class="modal-box"><h4>Other Michigan libraries may have this item</h4><p class="line">You can get it faster by requesting it directly from the Michigan eLibrary (MeL).</p><p><span style="display:inline-block;float:left;"><a class="btn btn-default" id="mel-redirect" target="_blank" href="' . $url . '">Request from another Michigan Library</a></span> <span style="display:inline-block;float:right;" class="close-button">Request through Document Delivery</span></p></div></div>';

	}

}
