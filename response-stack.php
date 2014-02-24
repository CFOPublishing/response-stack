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
		add_shortcode( 'responser', array($this, 'response') );
		add_action('init', array($this,'register_scripts') );
		add_action('init', array($this,'register_styles') );
		add_action('wp_enqueue_scripts', array($this,'enqueue') );
	}
	
	function includes() {
	
	}
	
	public function response($atts) {
		extract( shortcode_atts( array(
			'comment' => 0,
			'thread' => 0,
			'source' => 'false'
		), $atts ) );
		
		$o = '<div class="rs-comments" id="rs-comment-' .  $comment; . '">';
		$o .=	$this->the_rscomment($comment, $thread);
		$o .= '</div>';
		return $o;
		
	}
	
	public static function the_rscomment($id, $thread_depth, $depth_count = 0){
		global $wpdb;
		$count = $depth_count+1;
		$comment = get_comment($id);
		$id = (int)$id;
		$author_email = $comment->comment_author_email;
		$author_email = get_avatar( $author_email, 96 );
		$args = array();
		$args['avatar_size'] = 32;
		$args['max_depth'] = $thread_depth;
		
		
		$o = '<div class="rs-comment rs-depth-' . $depth_count .'" id="rsc-' . $count . '">
				<footer class="comment-meta">
				<div class="comment-author vcard">';
					if ( 0 != $args['avatar_size'] ) 
		$o .= 			get_avatar( $comment, $args['avatar_size'] ); 
		$o .=		'<div class="author">';
		$o .=			sprintf( __( '%s <span class="says">says:</span>', 'cfo' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link($id) ) );
		$o .=		'</div>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) .'">
						<time datetime="' . date('c',  strtotime($comment->comment_date) ) . '">'
							. sprintf( _x( '%1$s at %2$s', '1: date, 2: time', 'cfo' ), get_comment_date('m/d/y', $id), date('H:i:s',  time($comment->comment_date )))
						. '</time>
					</a>
				</div><!-- .comment-metadata -->

			</footer><!-- .comment-meta -->

			<div class="comment-content">
			';
		$o .=	get_comment_text($id);
		$o .= '</div><!-- .comment-content -->';

		$o .=
				get_comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => 1,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ), $id );
			
		$o.= '</div>';
		
		if ($thread_depth > $count){
			$children = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_parent = $id");
			foreach($children as $child_obj){
				#echo '<pre>';
				#var_dump($children);
				#echo '</pre>';
		$o .=	'<div class="comment-indent">';
		$o .= 		self::the_rscomment($child_obj->comment_ID, $thread_depth, $depth_count);
		$o .=	'</div>';
			}
		}
		return $o;
	}
	
	public static function register_scripts(){
	
	}
	
	public static function register_styles(){
		wp_register_style('response-stack-css', plugins_url('library/rs-style.css', __FILE__), array(), '1.0', 'all');
	}
	
	public static function enqueue(){
		wp_enqueue_style('response-stack-css');
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
