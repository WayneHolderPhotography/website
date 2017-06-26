=== Plugin Name ===
Contributors: aadilali
Tags: multiple images, multiple images to post, multiple images to custom post type, multiple media, multiple images metabox,gallery, images, metabox, multiple, multiple post thumbnail, pictures, thumbnail
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a multiple image metabox to your posts, pages and custom post types

== Description ==

This plugin add a metabox which allox to upload multiple images to one post. Pictures are linked by the way of comma seperated string of attachment IDs. They can delete by clicking on desired picture.

Number of allowed pictures and concerned post types can be overited using hooks. Pictures rendered on post page or under while loop using shortcodes.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `multiple-images-upload.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php do_shortcode('[multiple_images]'); ?>` in your templates
4. Place `<?php do_shortcode('[multiple_images post_id='postid']'); ?>` in your templates to display gallery from specific post

== Frequently Asked Questions ==


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.