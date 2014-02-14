<?php 

/*
Plugin Name: Response Stack
Plugin URI: http://cfo.com/
Description: This plugin allows users to build posts around user comments in WordPress.
Version: 0.0.1
Author: Aram Zucker-Scharff
Author URI: http://aramzs.me
License: GPL2
*/

/*  Developed for the CFO Magazine

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

class ResponseStack {

	function __construct() {
		
	}
	
	function includes() {
	
	}
	
	public function response($atts) {
		extract( shortcode_atts( array(
			'comment' => 0,
			'thread' => 0,
			'source' => 'false'
		), $atts ) );
		
		$c = '<div class="rs-comments" id="rs-comment-'.$comment.'">';
			$c
		$c.= '</div>';
		
	}
	
	public static function get_the_rscomment($id, $thread_count, $depth = 0){
		$count = $depth+1;
		$c = '<div class="rs-comment" id="rsc-'.$count.'">';
			$c .=
		$c .= '</div>';
		
		return $c;
	}

}

/**
 * Bootstrap
 *
 * You can also use this to get a value out of the global, eg
 *
 *    $foo = responsestack()->bar;
 *
 * @since 1.7
 */
function responsestack() {
	global $rsstk;
	if ( ! is_a( $rsstk, 'ResponseStack' ) ) {
		$rsstk = new ResponseStack();
	}
	return $rsstk;
}

// Start me up!
responsestack();
