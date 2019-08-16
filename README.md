Page JSON
====

CONTENTS OF THIS FILE
---------------------   
* Introduction
* Architecture
* Requirements
* Installation
* Configuration
* Usage
* Maintainers

INTRODUCTION
------------

Page JSON module help serving content/node of Page content type in JSON format.\
We have used the D8's Configuration API to store **Site API key**\
Please find the Configuration API implementation please at [8.0.x](https://github.com/shinde-rahul/page_json/tree/8.0.x "Branch: 8.0.x")

ARCHITECTURE
------------

Page JSON module provides followings features,
1. "Site API Key" field in "Site Information" form
2. This module provides a URL that responds with a JSON representation of 
  a given node with the content type "page" only if the previously submitted 
  API Key and a node id (nid) of an appropriate node are present, 
  otherwise it will respond with "access denied". 

REQUIREMENTS	
------------

This module requires the following modules:
* Serialization (Core module)


INSTALLATION
------------

1. This project installs like any other Drupal module. There is extensive
documentation on how to do this here:
https://drupal.org/documentation/install/modules-themes/modules-8 
But essentially: Download the archive from https://github.com/shinde-rahul/rsvp
and expand it into the modules/ directory in your Drupal 8 installation.

2. Within Drupal, enable any Example sub-module you wish to explore in Admin
menu > Extend.



CONFIGURATION
-------------

This module allows site administer configure the API key for exporting 
the content of type Page.

Followings are the steps to setup **Site API key** for system wide.
* Navigate to Admin Site Information ('/admin/config/system/site-information')
* Scroll to **API Key** field
* Enter string of 40+ character, no whitespace.
* Click on **Update Configuration** button.


USAGE
-----

This module provides a route that responds with a JSON representation of a node 
of Page type. \
Path is <protocol://site-name.domain>/page_json/{siteapikey}/{node} \
Replace,
* <protocol://site-name.domain> with the domain e.g. http://localhost
* {siteapikey} with the string stored as API Key
* {node} with the valid node id

MAINTAINERS
-----------

Current maintainers:
* Rahul A. Shinde (rahul.shinde) - https://www.drupal.org/u/rahulshinde
