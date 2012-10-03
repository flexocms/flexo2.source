Flexo CMS is open-source GPL v3 easy-to-use content management system writed on PHP, using MySQL or SQLite databases.

Directories description:
========================

*database* - contain ERP models and SQL schema of database. Not used in App. Only describe DB structure for documentation.

*framework* - conatin Yii Framework files.

*protected* - conatin application Controllers, Models, Views, Components, extensions and configuration files.

*web* - contain bootstrap index.php, assets, js and css resources. This is public directory should be DocumentRoot of application.

Requirements
============

* PHP 5.3+
* MySQL 5+
* Apache webserver

Installation
============

# Download latest version
# Put all files to webserver
# Change website DocumentRoot to [...]web/
# Rename all configuration files that containg prefix "example." to files without this prefix. Configuration files situated at protected/config/ directory
# Create new MySQL database
# Open protected/config/all.custom.php and modify database connection params
# Run website

TODO
====

# Working on section Page

