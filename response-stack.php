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
		?>
		<div class="rs-comments" id="rs-comment-<?php echo $comment; ?>">
			<?php $c .= $this->the_rscomment($comment, $thread); ?>
		</div>
		<?php 
	}
	
	public static function the_rscomment($id, $thread_depth, $depth_count = 0){
		$count = $depth_count+1;
		$comment = get_comment($id);
		$author_email = $comment->comment_author_email;
		$author_email = get_avatar( $author_email, 96 );
		$args = array();
		$args['avatar_size'] = 96;
		$args['max_depth'] = $thread_depth;
		
		?>
		<div class="rs-comment rs-depth-<?php $depth_count ?>" id="rsc-<?php echo $count ?>">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<div class="author">
						<?php printf( __( '%s <span class="says">says:</span>', 'cfo' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link($id) ) ); ?>
					</div>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'cfo' ), get_comment_date('m/d/y', $id), date('H:i:s',  $comment->comment_date ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text($id); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => 1,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ), $id );
			?>
		</div>
		<?php 
		if ($thread_depth > $count){
			?><div class="comment-indent">
				<?php $this->the_rscomment($next_id, $thread_depth, $depth_count); ?>
			</div><?php 
		}
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
