=== Delete Post Revisions ===
Contributors: donalmacarthur
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HHSJFSHRKRKQS
Tags: revisions, post revisions, delete revisions, delete post revisions
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 1.3

A simple plugin for deleting unwanted post revisions from your database.

== Description ==

By default, whenever you update a post or page, WordPress saves a backup or 'revision' copy of the old page. There's no default limit to how many revisions are saved for each page, so these revision copies tend to build up over time, bloating your database unnecessarily. This simple tool cleans up your database by deleting all existing revisions.

You should only need to run this plugin once, then you can deactivate and delete it. Deleting your existing revisions won't prevent them from building up again in future, but you can disable the revision feature or limit the number of revisions WordPress saves to a number of your choice by setting WordPress's `WP_POST_REVISIONS` constant. You can find full instructions on how to do this on the [plugin's homepage](http://cranesandskyhooks.com/wordpress-plugins/delete-post-revisions/).

== Installation ==

1. Install the plugin in the usual way - preferably through the WordPress automatic plugin installer.
1. Activate the plugin from the 'Plugins' menu on your dashboard.
1. Navigate to `Tools > Delete Revisions` and click the delete button.
1. You're all done. You can deactivate and delete the plugin.

== Screenshots ==

1. You can find the Delete Revisions page under the WordPress Tools menu.
2. Deleting unwanted revisions is as simple as clicking a button.
3. Leaves your database lean, clean, and revision-free.

== Changelog ==

= 1.3 =
* Updated all backend functionality to the new DMAC plugin framework to ensure compatibility with future plugin releases.
* Updated dashboard support links.

= 1.2 =
* Earlier versions of the plugin ran into memory issues and failed if the user attempted to delete a particularly large number (tens or hundreds of thousands) of revisions. This update implements a more robust deletion routine that can handle indefinitely large numbers of revisions.
* 'Show details' is now an optional extra. Turns out showing details by default isn't such a great idea when you're deleting 40,000 revisions...

= 1.1 =
* Improved interface.

= 1.0 =
* Initial release.






