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

class FavoriteTest extends \WP_UnitTestCase {

    private $favorites;

    public function setUp()
    {
	    parent::setUp();
        $this->favorites = new \LogFavorite\Favorite();
        //ob_start();
	    $_COOKIE['log-favorites'] = 'foo,bar';

    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testShouldReturnSuccessfulWhenHookInsertStarAfterTheContent()
    {
        $stub = $this->getMockBuilder(Favorite::class)->getMock();
        $stub->method('OrganizeFavorites')->willReturn(array(1,2));

        $foo = $this->favorites->HookInsertStarAfterTheContent('foo');
        $this->assertEquals( 'foo<div><a href="#" class="add-favorite" data-id-favorite=""><img class="star-favorite" src="http://example.org/wp-content/plugins/log-favorite/assets/img/star-no-gold.png">Favorite</a></div>', $foo );
    }

    public function testShouldCheckExistFavorite()
    {
        $retorno = $this->invokeMethod($this->favorites, 'CheckExistFavorite', array('param1', array('param1','param2')));
        $this->assertTrue($retorno);
    }

    public function testShouldCheckFavoriteNotFound()
    {
        $retorno = $this->invokeMethod($this->favorites, 'CheckExistFavorite', array('param', array('param1','param2')));
        $this->assertFalse($retorno);
    }
    public function testShouldReturnOrganizeFavorites()
    {
        $favorites = $this->favorites->OrganizeFavorites();
        $this->assertEquals(array('foo', 'bar'), $favorites);
    }

    public function testShouldOrganizeEmptyFavorites()
    {
        $_COOKIE['log-favorites'] = null;
        $favorites = $this->favorites->OrganizeFavorites();
        $this->assertEmpty($favorites);
    }

	public function testShouldTransformStringCookieToArray()
	{
		$retorno = $this->invokeMethod($this->favorites, 'CookieToArray', array('param,param2'));
		$this->assertEquals(array('param', 'param2'), $retorno);
	}

	public function testShouldSaveCookie()
	{
		$this->markTestIncomplete();
	}

	public function testShouldConvertArrayToCookieString()
	{
		$retorno = $this->invokeMethod($this->favorites, 'ArrayToCookie', array(array('foo', 'bar')));

		$this->assertEquals('foo,bar', $retorno);
	}
//    public function testHookInsertStarAfterTheContent()
//    {
//        $foo = $this->favorite->HookInsertStarAfterTheContent('foo');
//        $this->assertEquals( 'umacaralhadadecoisa', $foo );
//    }

    public function testGetListTitleFavorites()
    {
	    $_COOKIE['log-favorites'] = '1,2';
        $listFavorites = $this->favorites->GetListTitleFavorites();
    }


    /**
     * A single example test.
     */
//    function test_sample() {
//        // Replace this with some actual testing code.
//        $this->assertTrue( true );
//    }
}