<?php

namespace Detain\MyAdminSlack;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class Plugin
 *
 * @package Detain\MyAdminSlack
 */
class Plugin {

	public static $name = 'Slack Plugin';
	public static $description = 'Allows handling of Slack Chat Bot Hooks';
	public static $help = '';
	public static $type = 'plugin';

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
	}

	/**
	 * @return array
	 */
	public static function getHooks() {
		return [
			//'system.settings' => [__CLASS__, 'getSettings'],
			//'ui.menu' => [__CLASS__, 'getMenu'],
		];
	}

	/**
	 * @param \Symfony\Component\EventDispatcher\GenericEvent $event
	 */
	public static function getMenu(GenericEvent $event) {
		$menu = $event->getSubject();
		if ($GLOBALS['tf']->ima == 'admin') {
			function_requirements('has_acl');
					if (has_acl('client_billing'))
							$menu->add_link('admin', 'choice=none.abuse_admin', '/bower_components/webhostinghub-glyphs-icons/icons/development-16/Black/icon-spam.png', 'Slack');
		}
	}

	/**
	 * @param \Symfony\Component\EventDispatcher\GenericEvent $event
	 */
	public static function getRequirements(GenericEvent $event) {
		$loader = $event->getSubject();
		$loader->add_requirement('class.Slack', '/../vendor/detain/myadmin-slack-chat/src/Slack.php');
		$loader->add_requirement('deactivate_kcare', '/../vendor/detain/myadmin-slack-chat/src/abuse.inc.php');
		$loader->add_requirement('deactivate_abuse', '/../vendor/detain/myadmin-slack-chat/src/abuse.inc.php');
		$loader->add_requirement('get_abuse_licenses', '/../vendor/detain/myadmin-slack-chat/src/abuse.inc.php');
	}

	/**
	 * @param \Symfony\Component\EventDispatcher\GenericEvent $event
	 */
	public static function getSettings(GenericEvent $event) {
		$settings = $event->getSubject();
		$settings->add_text_setting('General', 'Slack', 'abuse_imap_user', 'Slack IMAP User:', 'Slack IMAP Username', ABUSE_IMAP_USER);
		$settings->add_text_setting('General', 'Slack', 'abuse_imap_pass', 'Slack IMAP Pass:', 'Slack IMAP Password', ABUSE_IMAP_PASS);
	}

}
