<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 12/02/17
 * Time: 23:33
 */

namespace LogFavorite;

use LogFavorite\Favorite;

include_once 'Favorite.php';

class ShortCode extends Favorite {

	public static function ShowOfFavorites() {
		$listFavorites = self::GetListTitleFavorites();
		echo "<ul id=\"log-favorite-shortcode\">";
		foreach ( $listFavorites as $favorite ) {
			echo "<li>" . $favorite . "</li>";
		}
		echo "</ul>";
	}
}

