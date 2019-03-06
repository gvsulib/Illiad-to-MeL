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

	// Count number of owning libraries
	$copies = $html->find('#liblink')->plaintext;
	$total_copies = split($copies, ' ');

	echo '<div class="alert alert-info" style="margin-top: 1em;"><p>' . $total_copies[0] . ' other Michigan libraries may have this book. You can get it faster by requesting it directly.<br /><a class="btn btn-default" id="mel-redirect" target="_blank" href="' . $url . '">Request from another Michigan Library</a></p></div>';
	
}

if(count($html->find('.browseScreen')) > 0) { // List of results

	// Is this a no results screen?
	if(count($html->find('tr.yourEntryWouldBeHere')) > 0) {

		echo '<!-- Not available in MeLCat-->';

	} else { // Possible results

		echo '<div class="alert alert-info" style="margin-top: 1em;"><p>Other Michigan libraries may have this book. You can get it faster by requesting it directly.<br /><a class="btn btn-default" id="mel-redirect" target="_blank" href="' . $url . '">Request from another Michigan Library</a></p></div>';

	}

}
