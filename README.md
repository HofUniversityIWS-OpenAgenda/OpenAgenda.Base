# OpenAgenda Base Distribution

Warning: This package is currently in development and highly experimental


## How to install

* git clone https://github.com/OpenAgenda/OpenAgenda.Base.git
* cd OpenAgenda.Base
* composer install --dev


## Database

Due to some foreign key constraints on RDBMS level, correct collations are required.
For instance one would like to create a new database like this

```sql
CREATE DATABASE t3_openagenda_local DEFAULT CHARACTER SET 'utf8' DEFAULT COLLATE 'utf8_unicode_ci';
```

## Testing

### Unit Testing

```shell
bin/phpunit -c Build/buildessentials/PhpUnit/UnitTests.xml
```

### Functional Testing

```shell
bin/phpunit -c Build/buildessentials/PhpUnit/FunctionalTests.xml
```

* make sure Configuration/Testing/Settings.yml contains proper configuration for database etc.

### Acceptance Testing

```shell
bin/codecept run acceptance
```

* make sure you have a proper configuration for the context you want to have tested
* make sure tests/acceptance.suite.yml contains the proper URL for the WebDriver
* (optional) make sure codeception.yml contains the proper TYPO3 Flow context for Flowception
