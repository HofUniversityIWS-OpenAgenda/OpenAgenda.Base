<?php 
/**
 * @author Oliver Hader <oliver@typo3.org>
 */

$I = new AcceptanceTester($scenario);

// Invokes TYPO3 Flow to provide a proper user account
$I->executeFlowCommand('testdata:createuser --identifier admin@openagenda.org --password password --firstname Mark --lastname Mabuse');
$I->executeFlowCommand('testdata:createuser --identifier participant1@openagenda.org --password password --firstname Elen --lastname Kutis');

// Invokes TYPO3 Flow to provide a scenario, a new meeting in this regard
// The new meeting identity is returned in $flowResult[0]['__identity']
$flowResult = $I->executeFlowCommandWithJsonResponse('testdata:createmeetings --quantity=1 --json');
$I->executeFlowCommand('testdata:addmeetinginvitation --meetingIdentifier ' . $flowResult[0]['__identity'] . ' --personIdentifier participant1@openagenda.org');

$I->wantTo('perform actions and see result');
$I->am('administrator');
$I->amOnPage('/');

$I->loginWithCredentials('admin@openagenda.org', 'password');

$I->click('//a[@href="#"][contains(text(),"Meetings")]', 'div.sidebar-nav');
$I->waitForText('Meeting-Übersicht', NULL, 'div.sidebar-nav');
$I->click('//a[contains(text(),"Meeting-Übersicht")]', 'div.sidebar-nav');
$I->waitForText('Meeting Übersicht', NULL, 'h1.page-header');

$I->fillField('form input[ng-model="startDate"]', '01.01.2015');
$I->waitForElementVisible('//button[@type="button"]/span[contains(text(),"01")]', NULL);
$I->click('//button[@type="button"]/span[contains(text(),"01")]', 'form');
$I->waitForText('Meeting 1', NULL, 'div.table-responsive');

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

// Work-around for PhantomJS since Phantoman only can handle one session
$adminSession = $I->grabCookie('TYPO3_Flow_Session');

try {
	/** @var \Codeception\Lib\Friend $participant */
	$participant = $I->haveFriend('participant');
	$participant->does(function (AcceptanceTester $I) {
		$I->resizeWindow(1024, 768);
		$I->wantTo('follow a running meeting');
		$I->am('participant');
		$I->amOnPage('/');
		$I->resetCookie('TYPO3_Flow_Session');
		$I->reloadPage();

		$I->loginWithCredentials('participant1@openagenda.org', 'password');

		$I->waitForText('Hallo Elen', NULL, 'h4.ng-binding');
		$I->see('Hallo Elen', 'h4.ng-binding');

		$I->click('//a[@href="#"][contains(text(),"Meetings")]', 'div.sidebar-nav');
		$I->waitForText('Meeting-Übersicht', NULL, 'div.sidebar-nav');
		$I->click('//a[contains(text(),"Meeting-Übersicht")]', 'div.sidebar-nav');
		$I->waitForText('Meeting Übersicht', NULL, 'h1.page-header');

		$I->fillField('form input[ng-model="startDate"]', '01.01.2015');
		$I->waitForElementVisible('//button[@type="button"]/span[contains(text(),"01")]', NULL);
		$I->click('//button[@type="button"]/span[contains(text(),"01")]', 'form');

		$I->waitForText('Meeting 1', NULL, 'div.table-responsive');
		$I->click('//a[contains(text(),"Anzeigen")]', 'table tr td');
		$I->waitForText('Meeting anzeigen', NULL, 'h1.page-header.ng-scope');

		$I->dontSee('Meeting abschließen', 'div.page-content.ng-scope');

		$I->logout();
	});
	unset($participant);
} catch (WebDriverCurlException $exception) {
	// Ignore curl exceptions for multi-sessions
}

// Work-around for PhantomJS since Phantoman only can handle one session
$I->setCookie('TYPO3_Flow_Session', $adminSession);

$I->click('Meeting abschließen');
$I->waitForElement('div.modal-dialog');
$I->see('Erfolg', 'div.modal-dialog div.modal-header');
$I->click('OK', 'div.modal-dialog');

$I->logout();
