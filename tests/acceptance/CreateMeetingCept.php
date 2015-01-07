<?php 
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);
$I->wantTo('create a meeting');
$I->am('administrator');
$I->amOnPage('/');

$I->makeScreenshot('create');
$I->loginWithCredentials('admin@openagenda.org', 'password');

$I->click('//a[@href="#"][contains(text(),"Meetings")]', 'div.sidebar-nav');
$I->waitForText('Meeting anlegen', NULL, 'div.sidebar-nav');
$I->click('//a[contains(text(),"Meeting anlegen")]', 'div.sidebar-nav');
$I->waitForText('Meeting anlegen', NULL, 'h1.page-header.ng-scope');

$I->click('//span[@editable-text="meeting.title"]');
$I->fillField('.editable-controls input[type="text"]', 'New Meeting');
$I->click('button.btn.btn-primary');

$I->click('//a[@editable-bsdate="meeting.scheduledStartDate"]');
$I->fillField('.editable-controls input[type="text"]', '01/20/2015');
$I->click('button.btn.btn-primary');

$I->click('//a[@editable-text="meeting.location"]');
$I->fillField('.editable-controls input[type="text"]', 'New Location');
$I->click('button.btn.btn-primary');

$I->click('(//a[@editable-text="apt.title"])[1]');
$I->fillField('.editable-controls input[type="text"]', 'TOP #1');
$I->click('button.btn.btn-primary');

$I->click('(//a[@editable-textarea="apt.description"])[1]');
$I->fillField('.editable-controls textarea', 'Description #1');
$I->click('button.btn.btn-primary');

$I->click('button[ng-click="addNewAgendaItem()"]');

$I->click('(//a[@editable-text="apt.title"])[2]');
$I->fillField('.editable-controls input[type="text"]', 'TOP #2');
$I->click('button.btn.btn-primary');

$I->click('(//a[@editable-textarea="apt.description"])[2]');
$I->fillField('.editable-controls textarea', 'Description #2');
$I->click('button.btn.btn-primary');

$I->clearField('autocomplete#invitiationMail input[type="text"]');
$I->typeIntoElement('autocomplete#invitiationMail input[type="text"]', 'admin@openagenda.org');
$I->click('button[ng-click="addNewInvitation(invitiationMailAddress)"]');
$I->waitForText('Mark Mabuse <admin@openagenda.org>');

$I->clearField('autocomplete#invitiationMail input[type="text"]');
$I->typeIntoElement('autocomplete#invitiationMail input[type="text"]', 'participant1@openagenda.org');
$I->click('button[ng-click="addNewInvitation(invitiationMailAddress)"]');
$I->waitForText('Elen Kutis <participant1@openagenda.org>');

$I->click('button[ng-click="sendMeetingData()"]');
$I->waitForElement('div.modal-dialog');
$I->see('Erfolg', 'div.modal-dialog div.modal-header');

$I->logout();
