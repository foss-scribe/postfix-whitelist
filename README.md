# Postfix whitelist plugin and manager
A simple solution for curating emails in postfix using a configurable whitelist

Inspired by initial work by [Scott Merrill](http://archive09.linux.com/feature/40750) this is a whitelist plugin with web admin panel I wrote a mail server that I maintain for a family member.

This plugin allows you to create given email addresses by only allowing them to receive emails from an approved whitelist. The whitelist is managed by a simple PHP-powered web console.

## Installation

1. Update the included configuration files in /etc/postfix/ with your correct database details and copy them to the appropriate place in your server's filesystem
2. Update the SQL files and then execute them to alter your database
3. Edit your /etc/postfix/main.cf to include the configuration settings in _main.cf.extract_
4. Reload postfix and check your logs for any errors
5. Customise the web admin php files to your needs and then copy them to your preferred location under your web server's directory.