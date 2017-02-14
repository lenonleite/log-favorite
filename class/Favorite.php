<?php

/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 12/02/17
 * Time: 19:58
 */

namespace LogFavorite;

class Favorite {

	public static function HookInsertStarAfterTheContent( $content ) {
		$content .= "<div>";

		$link = "";
		$link .= "<a href=\"#\" class=\"add-favorite\" data-id-favorite=\"" . get_the_ID() . "\">";
		$link .= "<img class=\"star-favorite\" src=\"" . plugins_url( '/log-favorite/assets/img/star-no-gold.png' ) . "\">" . __( "Favorite" );
		$link .= "</a>";

		if ( self::CheckExistFavorite( get_the_ID(), self::OrganizeFavorites() ) ) {
			$link = "";
			$link .= "<a href=\"#\" class=\"remove-favorite\" data-id-favorite=\"" . get_the_ID() . "\">";
			$link .= "<img class=\"star-favorite\" src=\"" . plugins_url( '/log-favorite/assets/img/star-gold.png' ) . "\">" . __( "Favorite" );
			$link .= "</a>";
		}

		$content .= $link;
		$content .= "</div>";

		return $content;
	}

	private static function CheckExistFavorite( $id, $favorites ) {
		$exist = array_search( $id, $favorites );

		return $exist !== false;
	}

	public static function OrganizeFavorites() {

		if ( ! isset( $_COOKIE['log-favorites'] ) ) {
			self::CreateEmptyFavorites();
		}

		return self::CookieToArray( @$_COOKIE['log-favorites'] );
	}

	private static function CreateEmptyFavorites() {
		self::SaveCookies( ',' );
	}

	private static function CookieToArray( $cookieFavorites ) {
		$arrayFavorites = explode( ",", $cookieFavorites );
		$key            = array_search( "", $arrayFavorites );
		if ( $key !== false ) {
			unset( $arrayFavorites[ $key ] );
		}

		return $arrayFavorites;
	}

	protected static function SaveCookies( $text ) {
		//add_action( 'init', 'set_new_cookie');
		if ( isset( $_COOKIE['log-favorites'] ) ) {
			unset( $_COOKIE['log-favorites'] );
		}
		@setcookie( 'log-favorites', null, - 1, '/' );
		@setcookie( 'log-favorites', $text, time() + 3600, "/" );

	}


	protected function ArrayToCookie( $arrayFavorites ) {
		return implode( ",", $arrayFavorites );
	}

	public static function GetListTitleFavorites() {
		$listOfFavorites = self::OrganizeFavorites();
		$titles          = array();
		foreach ( $listOfFavorites as $favorite ) {
			if ( $favorite != "" ) {
				$titles[] = get_the_title( $favorite );
			}

		}

		return $titles;
	}

}