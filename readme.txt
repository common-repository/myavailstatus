=== MyAvailStatus ===
Contributors: andersbalari
Donate link: http://www.431verstaerker.de/myavailstatus-2/
Version 0.9.1
Tags: current, status, availability status, availability
Requires at least: 2.7
Tested up to: 3.3.1
Stable tag: 0.9.1

MyAvailStatus is a WordPress plugin for showing the availability status of the site owner.

== Description ==

Using MyAvailStatus you can show your availability status message to your client very easily. Just set the options and use the widget or the code. It is based on MyMood by Webgarb.

Please note that this plugin is very basic in the moment. Following weaknesses occur, which have to be taken care of in versions to come and of course in the meantime can be handled by adapting the code in "myavailstatus_plugin.php".

*   No localization possible
*   No custom CSS for Widget and code implementetion supported
*   No custom icons supported

**CSS Guidance**

*   Widget Container ID: myavailstatus-widget
*   Widget Container class: myavailstatus_widget
*   Icon class (`<img>`): myavailstatus_wicon
*   Status text class (`<p>`): myavailstatus_wtext
*   Status description classe (`<li>`): myavailstatus_wdesc  

== Installation ==

1. Download and unpack the "mystatus" directory from the .zip-file
1. Upload the "mystatus" directory to the "/wp-content/plugins/" directory
1. Activate the plugin in the "Plugins" menu of WordPress
1. Define your settings and drag the widget to the desired place or implement the code within the template

== Frequently Asked Questions ==

None this far.

== Screenshots ==
1. The Admin Panel, to be found within "Settings". 
2. The Widget.
3. The result (within my specific theme for www.glehner.de)

== Changelog ==

= 0.9.1 =
*   Separated display code for widget and template implementation
*   Changed HTML tags of widget display code to match with WordPress Codex
*   Added classes to Widget elements to allow design modification

= 0.9 =
*   Adapted from MyMood 1.2 by Webgarb.