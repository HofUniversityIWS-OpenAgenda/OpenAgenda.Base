<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

/**
 * Class AcceptanceHelper
 * @package Codeception\Module
 * @author Oliver Hader <oliver@typo3.org>
 */
class AcceptanceHelper extends \Codeception\Module\WebDriver {

	const Value_Timeout = 10;
	const ButtonLabel_Login = 'Standard-Login';
	const ButtonLabel_Logout = 'Abmelden';
	const SelectorPrefix_AuthenticationForm = 'input[name="__authentication[TYPO3][Flow][Security][Authentication][Token][UsernamePassword]';

	/**
	 * Logs into OpenAgenda web-application
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function loginWithCredentials($username, $password) {
		$I = $this;
		$I->seeElement(self::SelectorPrefix_AuthenticationForm . '[username]"]');
		$I->seeElement(self::SelectorPrefix_AuthenticationForm . '[password]"]');
		$I->fillField(self::SelectorPrefix_AuthenticationForm . '[username]"]', $username);
		$I->fillField(self::SelectorPrefix_AuthenticationForm . '[password]"]', $password);
		$I->click(self::ButtonLabel_Login, '#login-button-group');
	}

	/**
	 * Logs out from OpenAgenda web-application
	 */
	public function logout() {
		$I = $this;
		$I->click('//div[@id="wrapper"]/nav/ul/li[2]/a');
		$I->seeElement('ul.dropdown-menu.dropdown-user');
		$I->click(self::ButtonLabel_Logout, 'ul.dropdown-menu.dropdown-user');
		$I->seeElement(self::SelectorPrefix_AuthenticationForm . '[username]"]');
		$I->seeElement(self::SelectorPrefix_AuthenticationForm . '[password]"]');
	}

	/**
	 * @param string $element
	 * @param string $value
	 * @param NULL|int $wait
	 */
	public function typeIntoElement($element, $value, $wait = NULL) {
		$characters = str_split($value);
		foreach ($characters as $character) {
			$this->pressKey($element, $character);
			if ($wait === NULL) {
				$this->wait($wait);
			}
		}
	}

	/**
	 * Clears an element.
	 *
	 * @param string $selector
	 */
	public function clearField($selector) {
		$el = $this->findField($selector);
		if (!$el) {
		 throw new \Codeception\Exception\ElementNotFound($selector, 'CSS or XPath');
		}
		$el->clear();
	}

	/**
	 * Clicks with mouse.
	 *
	 * @param string $selector
	 */
	public function clickWithDefaultButton($selector) {
		$el = $this->matchFirstOrFail($this->webDriver, $selector);
		$this->webDriver->getMouse()->click($el->getCoordinates());
	}

	/**
	 * Waits $timeout seconds to have some text available.
	 *
	 * @param string $text
	 * @param int $timeout
	 * @param null $selector
	 */
	public function waitForText($text, $timeout = 10, $selector = NULL) {
		parent::waitForText($text, $timeout, $selector);
	}

}
