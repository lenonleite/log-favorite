<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 13/02/17
 * Time: 13:23
 */


namespace LogFavorite\Favorite\Test;

//use \LogFavorite\Favorite;


use LogFavorite\Favorite;
use LogFavorite\ShortCode;

class ShortCodeTest extends \WP_UnitTestCase {

	/**
	 * @var \favorites_widget
	 */
	private $shortCode;

	public function setUp() {
		parent::setUp();
		$_COOKIE['log-favorites'] = 'foo,bar';

	}

	public function testShouldOutputMyFavorites()
	{
		$this->expectOutputString('<ul id="log-favorite-shortcode"><li></li><li></li></ul>');
		ShortCode::ShowOfFavorites();
	}
}