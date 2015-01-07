<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);
$I->wantTo('login and logout as admin user');
$I->am('administrator');
$I->amOnPage('/');

$I->loginWithCredentials('admin@openagenda.org', 'password');

$I->waitForText('Hallo Mark', NULL, 'h4.ng-binding');
$I->see('Hallo Mark', 'h4.ng-binding');

$I->logout();