# vim: ts=2 et st=2 sts=2 syn=ruby

load 'deploy'

# Start editting here

set :application, "tmdh"
set :repository,  "git@github.com:trinitymirror/digitalhub.git"
set :base_domain, "trinitymirror.com"

set :technology, "wordpress" # symfony2, zf1, magento, wordpress, pimcore
set :ssl_enabled, false
set :handler, "apache" # php-fpm, apache

# Set this to the application server's DNS hostname
role :web, "trinitymirrordigitalhub.ams1.do.rippleffect.tv"

# Crontab Definition
# 
# Usage: set "output" to the user/email address for cron output for this application.
# Omitting (i.e; removing) the "output" directive disables this feature.
# "defs" is an array of commands to be run:
# - freq: crontab-style frequency (i.e; @hourly/daily/weekly/monthly/yearly, or * * * * *, etc..)
# - command: the command to run
# The task is prefixed with a "cd /path/to/application;" so the command will always command running
# in the application's current working directory.
#
# Uncomment and complete the below to enable crontabs. Leave commented to disable.
#
# set :crondef, '{"output": "me@example.com", "defs": [{"freq": "@hourly", "command": "echo test"}]}'

# Leave this be, it commences the initialization of the capistrano environment
load 'capistrano/common'

# Uncomment the relevant load deploy script for the technology in use:
#
# load 'capistrano/magento/deploy.rb'
# load 'capistrano/pimcore/deploy.rb'
# load 'capistrano/symfony2/deploy.rb'
load 'capistrano/wordpress/deploy.rb'
# load 'capistrano/zf1/deploy.rb'
