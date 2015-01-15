<?php 
/**
 * @author Oliver Hader <oliver@typo3.org>
 */

$I = new AcceptanceTester($scenario);
$flowResult = $I->executeFlowCommandWithJsonResponse('testdata:createmeetings --quantity=1 --json');

$I->wantTo('perform actions and see result');
$I->am('administrator');
$I->amOnPage('/');

$I->loginWithCredentials('admin@openagenda.org', 'password');

$I->click('//a[@href="#"][contains(text(),"Meetings")]', 'div.sidebar-nav');
$I->waitForText('Meeting-Übersicht', NULL, 'div.sidebar-nav');
$I->click('//a[contains(text(),"Meeting-Übersicht")]', 'div.sidebar-nav');
$I->waitForText('Meeting Übersicht', NULL, 'h1.page-header');

$I->fillField('form input[ng-model="startDate"]', '01.01.2015');
$I->click('//button[@type="button"]/span[contains(text(),"01")]', 'form');

$I->click('//a[contains(text(),"Einladungen senden")]', 'table tr td');
$I->waitForElement('div.modal-dialog');
$I->see('Erfolg', 'div.modal-dialog div.modal-header');
$I->click('OK', 'div.modal-dialog');

$I->see('Geplant', NULL, 'span[ng-switch="meeting.status"] span.ng-scope');

$I->click('//a[contains(text(),"Anzeigen/Editieren")]', 'table tr td');
$I->waitForText('Meeting anzeigen', NULL, 'h1.page-header.ng-scope');
$I->canSeeInCurrentUrl($flowResult[0]['__identity']);

$I->click('Meeting durchführen');
$I->waitForText('Meeting durchführen', NULL, 'h1.page-header');
$I->waitForText('Meeting starten', NULL, 'div.page-content.ng-scope');

$I->click('Meeting starten');
$I->waitForElement('div.modal-dialog');
$I->click('//div[2]/table/tbody/tr/td[2]');
$I->doubleClick('//div[2]/table/tbody/tr/td[2]');
$I->waitForElementNotVisible('div.modal-dialog div.alert-info');
$I->click('Starten', 'div.modal-dialog');

$I->waitForText('Meeting abschließen', NULL, 'div.page-content.ng-scope');

$I->click('//input[@type="checkbox"]');
$I->click('(//input[@type="checkbox"])[2]');
$I->click('(//input[@type="checkbox"])[3]');

$I->click('Meeting abschließen');
$I->waitForElement('div.modal-dialog');
$I->see('Erfolg', 'div.modal-dialog div.modal-header');
$I->click('OK', 'div.modal-dialog');

$I->makeScreenshot('execute');

$I->logout();
