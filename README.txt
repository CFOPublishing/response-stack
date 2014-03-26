=== Plugin Name: Response Stack ===
Plugin URI: http://cfo.com
Version: 1.0.0
Author: Aram Zucker-Scharff
Author URI: http://aramzs.me
Tags: comments, embed, community, shortcode
Requires at least: 3.0.1
Tested up to: 3.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Response stack is a WordPress plugin built to bring audience response into stories. In its current form, this is done by using shortcodes to build comment chains in the body of a post. Authors can use threaded comments and even pull comments from multiple other stories, based on the comment ID. 

== Description ==

Response Stack uses WordPress shortcodes to pull comments (and comment threads) into a post from other posts on the same site. To get the shortcode working type the following into its own line in your post:

`[responser comment="id" thread="depth"]` where `id` is equal to the integer ID of the comment and `depth` is equal to the integer depth of the thread of comments you want visible. 

Readers looking at the comments can even respond to them within the shortcode's post, submitting threaded replies that will then take them to the original conversation. 

You can find the comment id by looking at the hyperlink attached to any comment datetime stamp (on the post or in the comments page of the dashboard), where it will be in the format of `http://site/post-link/#comment-CommentIDNumber`.

Response Stack assumes you are using default WordPress comments. Support for other commenting systems is to come. If you'd like to add support for your commenting system, contribute to the project [GitHub](https://github.com/CFOPublishing/response-stack/)

Developed for [CFO Magazine](http://cfo.com)
	
Styling and format based on work with Human Made.


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

