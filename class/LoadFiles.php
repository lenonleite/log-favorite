<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 13/02/17
 * Time: 23:20
 */
namespace LogFavorite;

class LoadFiles {

	public static function load() {
		wp_enqueue_script( 'action-log-favorites', plugin_dir_url( __FILE__ ) . '../assets/js/action.js', [ 'jquery' ], '0.1' );
	}

}