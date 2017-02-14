<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 13/02/17
 * Time: 13:23
 */


namespace LogFavorite\Favorite\Test;

use LogFavorite\FavoriteApi;

class FavoriteApiTest extends \WP_UnitTestCase {

	/**
	 * @var FavoriteApi
	 */
    private $favorites;

    public function setUp()
    {
	    parent::setUp();
        $this->favorites = new \LogFavorite\FavoriteApi();
    }

	/**
	 * @expectedException \WPDieException
	 */
    public function testShouldGetFavorites() {
	    $_POST['IdFavorite'] = 1;
	    $this->expectOutputString(<<<EOT
[
    "1",
    "2"
]
EOT
);
	    $this->favorites->GetFavorites();
    }

	/**
	 * @expectedException \WPDieException
	 */
    public function testShouldUpdateFavorites() {
	    $_POST['IdFavorite'] = 1;
	    $this->expectOutputString(<<<EOT
[
    "1",
    "2"
]
EOT
);
	    $this->favorites->UpdateFavorites();
    }

	/**
	 * @expectedException \WPDieException
	 */
    public function testShouldGetTitleFavorites() {
	    $_POST['IdFavorite'] = 1;
	    $this->expectOutputString('[]');
	    $this->favorites->GetTitleFavorites();
    }

	/**
	 * @expectedException \WPDieException
	 */
	public function testShouldRemoveFavorite() {
		$_POST['IdFavorite'] = 1;
		$this->expectOutputString('[]');
		$this->favorites->RemoveFavorites();
	}


}