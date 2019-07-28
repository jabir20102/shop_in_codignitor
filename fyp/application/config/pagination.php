<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// the following array is for the pagination general setting

$config = array(
	'use_page_numbers' => true,
	'full_tag_open' => '<ul class="pagination pagination-sm">',
	'full_tag_close' => '</ul>',
	'prev_link' => '&laquo;',
	'prev_tag_open' => '<li class="page-item">',
	'prev_tag_close' => '</li>',
	'next_link' => '&raquo;',
	'next_tag_open' => '<li class="page-item">',
	'next_tag_close' => '</li>',
	'num_tag_open' => '<li class="page-item">',
	'num_tag_close' => '</li>',
	'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="javascript:void(0)">',
	'cur_tag_close' => '</a></li>',
	'attributes' => array('class' => 'page-link'),
	'page_query_string' => true,
	'query_string_segment' => 'page',
);


?>