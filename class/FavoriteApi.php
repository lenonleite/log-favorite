<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 12/02/17
 * Time: 20:39
 */

namespace LogFavorite;


class FavoriteApi extends Favorite {

	public function GetFavorites() {
		self::ReturnData( self::OrganizeFavorites() );
	}

	public function UpdateFavorites() {
		$favorites   = self::OrganizeFavorites();
		$favorites[] = $_POST['IdFavorite'];
		$favorites   = array_unique( $favorites );
		self::SaveCookies( self::ArrayToCookie( $favorites ) );
		self::ReturnData( $favorites );
	}

	private function ReturnData( $data ) {
		@header( 'Content-Type: application/json' );
		echo json_encode( $data, JSON_PRETTY_PRINT );
		wp_die();
	}

	public function RemoveFavorites() {
		$favorites = self::OrganizeFavorites();
		if ( ( $key = array_search( $_POST['IdFavorite'], $favorites ) ) !== false ) {
			unset( $favorites[ $key ] );
		}
		self::SaveCookies( self::ArrayToCookie( $favorites ) );
		self::ReturnData( $favorites );
	}

	public function GetTitleFavorites() {
		self::ReturnData( self::GetListTitleFavorites() );
	}

}

