# OpenAgenda Base Distribution

Warning: This package is currently in development and highly experimental


## How to install

```shell
git clone https://github.com/OpenAgenda/OpenAgenda.Base.git
cd OpenAgenda.Base
composer install --dev
sudo ./flow core:setfilepermissions <your-CLI-username> www-data www-data
```

Find further details in the [TYPO3 Flow documentation](http://docs.typo3.org/flow/TYPO3FlowDocumentation/TheDefinitiveGuide/PartII/Installation.html).

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

## API Documentation

* [PHP API Documentation](http://openagenda.github.io/OpenAgenda.Base/Api/Php/)
* [JavaScript API Documentation](http://openagenda.github.io/OpenAgenda.Base/Api/JavaScript/)