<?php 
/**
 * @author Oliver Hader <oliver@typo3.org>
 */

$I = new AcceptanceTester($scenario);

// Invokes TYPO3 Flow to provide a proper user account
$I->executeFlowCommand('testdata:createuser --identifier admin@openagenda.org --password password --firstname Mark --lastname Mabuse');

$I->wantTo('modify my user profile');
$I->am('administrator');
$I->amOnPage('/');

$I->loginWithCredentials('admin@openagenda.org', 'password');

$I->click('//a[@href="#"][contains(text(),"Einstellung")]', 'div.sidebar-nav');
$I->waitForText('Profilverwaltung', NULL, 'div.sidebar-nav');
$I->click('//a[contains(text(),"Profilverwaltung")]', 'div.sidebar-nav');
$I->waitForText('Profileinstellung', NULL, 'h1.page-header');

$I->waitForElementVisible('form #password1');
$I->waitForElementVisible('form #password2');
$I->seeInField('form #firstName', 'Mark');
$I->seeInField('form #lastName', 'Mabuse');

$I->fillField('form #firstName', 'Firstname');
$I->fillField('form #lastName', 'Lastname');
$I->fillField('form #email', 'test@openagenda.org');
$I->fillField('form #phone', '01234/56789');
$I->fillField('form #password1', 'different');
$I->fillField('form #password2', 'different');
$I->click('button[ng-click="persist()"]');

$I->waitForElement('div.modal-dialog');
$I->see('Erfolg', 'div.modal-dialog div.modal-header');
$I->click('OK', 'div.modal-dialog');

$I->reloadPage();
$I->waitForText('Profileinstellung', NULL, 'h1.page-header');

$I->seeInField('form #firstName', 'Firstname');
$I->seeInField('form #lastName', 'Lastname');
$I->seeInField('form #email', 'test@openagenda.org');
$I->seeInField('form #phone', '01234/56789');

$I->logout();

$I->loginWithCredentials('admin@openagenda.org', 'different');
$I->waitForText('Hallo Firstname', NULL, 'h4.ng-binding');
$I->see('Hallo Firstname', 'h4.ng-binding');

$I->logout();