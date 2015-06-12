=== Plugin Name ===
Contributors: WP-Biz
Donate link: http://wpbiz.co/donate
Tags: woocommerce, shortcode
Requires at least: 3.0.1
Tested up to: 3.9
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add WooCommerce products into posts and pages using a shortcode, along with formatting options.

== Description ==

Add WooCommerce products into posts and pages using a shortcode, along with formatting options. The default WooCommerce shortcode for a single product had undesired formatting results, due to the way it was structured within a list. This plugin creates to [wooproduct] shortcode to drop single products into the text of your posts while having control over the formatting and CSS styles.

Please note this will not necesarily make your product info look "pretty", as this plugin provides no CSS styles. It does, however, give you the required class ("wooproduct") to apply custom CSS styles the resulting product info box to your heart's content.

You are welcome to add comments and questions into the Plugin Support page. I will be as active as possible with responses.

== Installation ==

1. Upload and activate the 'WooProducts Shortcode' plugin.
1. You can add [wooproduct sku="widget123"] into any page or post
1. Alternatively, you can specify products using the post ID number [wooproduct ID="321"]
1. Your post will now show a box with product photo, title, and price information.

== Frequently Asked Questions ==

= Can I add multiple products within the same page or post? =

Yes, there is no limit to the number of [wooproduct] shortcodes on a single page. It was built with the intention of creating lists of recommended products.

= Does it work for any shopping cart? =

No, this shortcode works exclusively with WooCommerce.

= I paste my product SKU or ID into the shortcode and nothing shows up! Why? =

You have to be careful copying and pasting numbers from your product list into your page editor. Sometimes it can also copy over colors and formatting code (HTML) that will break the shortcode. If you're having trouble with a code, try highlighting the shortcode and clicking "Remove Formatting", then save your post again.

== Screenshots ==

1. The shortcode in use on an "out-of-the-box" WooCommerce test site

== Changelog ==

= 0.3 =
* Date: May 7, 2014
* NEW: Default CSS stylesheet to make the boxes look nicer within the content. (easily customized using the .wooproduct class in your theme styles)
* FIX: Removed undesired text output when using SKU codes
* TWEAK: Removed default inline style
* TWEAK: Changed code to PHP class (prevents future plugin conflicts)

= 0.2 =
* Date: April 30, 2014
* NEW: You can add class="classname" to the shortcode for more styling options
* NEW: Uses wooproduct-template.php to format product boxes.
* NEW: Strips stray HTML formatting from product IDs and SKUs to prevent issues.
* FIX: Show products regardless of "catalog visibility" setting.

= 0.1 =
* Date: October 23, 2013
* Initial release.

== Upgrade Notice ==

= 0.3 =
Fixes and tweaks. Adds CSS default styling to product boxes.

= 0.2 =
Show hidden products properly, and ability to add CSS classes.

= 0.1 =
Initial release.

