OpenAgenda Base Distribution
============================

Warning: This package is currently in development and highly experimental


How to install
--------------

* git clone https://github.com/OpenAgenda/OpenAgenda.Base.git
* cd OpenAgenda.Base
* composer install --dev


Database
--------

Due to some foreign key constraints on RDBMS level, correct collations are required.
For instance one would like to create a new database like this

CREATE DATABASE t3_openagenda_local DEFAULT CHARACTER SET 'utf8' DEFAULT COLLATE 'utf8_unicode_ci';