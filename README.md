# Page JSON

Page JSON module help serving content/node of Page content type in JSON format.

# USAGE
## Admin
This module allows site administer configure the API key for exporting the content of type Page.
Followings are the steps to setup **Site API key** for system wide.
* Navigate to Admin Site Information ('/admin/config/system/site-information')
* Scroll to **API Key** field
* Enter string of 40+ character, no whitespace.
* Click on **Update Configuration** button.

## Consumer
This module provides a route that responds with a JSON representation of a node of Page type.
Path is <protocol://site-name.domain>/page_json/{siteapikey}/{node}
Replace,
* <protocol://site-name.domain> with the domain eg http://localhost
* {siteapikey} with the string stored as API Key
* {node} with the valid node id


MAINTAINERS
==========

## Current maintainers:
 * Rahul Shinde - https://www.drupal.org/u/rahulshinde
