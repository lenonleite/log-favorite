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

class WidgetTest extends \WP_UnitTestCase {

	/**
	 * @var \favorites_widget
	 */
	private $widget;

	public function setUp() {
		parent::setUp();
		$this->widget = new \favorites_widget();
		//ob_start();
		$_COOKIE['log-favorites'] = 'foo,bar';

	}

	public function testShouldUpdateOfWidget() {
		$instance['title'] = "title";
		$this->assertEquals( $this->widget->update($instance), $instance );
	}

	public function testShouldCreatForm() {
		$instance['title'] = "title";
		$this->expectOutputString( <<<EOT
        <p>
            <label for="widget-favorites_widget--title">Title:</label>
            <input class="widefat" id="widget-favorites_widget--title"
                   name="widget-favorites_widget[][title]" type="text"
                   value="title"/>
        </p>
        
EOT
);
		$this->widget->form($instance);
	}

	public function testeShouldCreateWidget() {
		$args['before_widget'] = "1";
		$args['before_title']  = "2";
		$args['after_title']   = "3";
		$args['after_widget']  = "4";
		$instance['title']     = "title";
		$this->expectOutputString( <<<EOT
12title3        <ul id="log-favorite-widget">
            <li></li><li></li>        </ul>
        4
EOT
		);
		$this->widget->widget($args, $instance);
	}
}