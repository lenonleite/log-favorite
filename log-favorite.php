<?php
/**
 * Plugin Name: Log favorite
 * Plugin URI: http://lenonleite.com.br/en/
 * Description: Log is a plugin for test for log.
 * Version: 0.0.1
 * Author: Lenon Leite
 * Author URI: http://https://lenonleite.com.br/en/
 * Tested up to: 4.7
 *
 * Domain Path: /i18n/languages/
 *
 * @package Lenon Leite
 * @category Core
 * @author Lenon Leite
 */


include 'class/Favorite.php';
include 'class/FavoriteApi.php';
include 'class/Widget.php';
include 'class/ShortCode.php';
include 'class/LoadFiles.php';

add_filter( 'the_content', array('\LogFavorite\Favorite', 'HookInsertStarAfterTheContent'));
add_action( 'wp_ajax_nopriv_get_favorites', array('\LogFavorite\FavoriteApi', 'GetFavorites') );
add_action( 'wp_ajax_nopriv_update_favorites', array('\LogFavorite\FavoriteApi', 'UpdateFavorites') );
add_action( 'wp_ajax_nopriv_remove_favorites', array('\LogFavorite\FavoriteApi', 'RemoveFavorites') );
add_action( 'wp_ajax_nopriv_get_title_favorites', array('\LogFavorite\FavoriteApi', 'GetTitleFavorites') );
add_action( 'wp_ajax_get_favorites', array('\LogFavorite\FavoriteApi', 'GetFavorites') );
add_action( 'wp_ajax_update_favorites', array('\LogFavorite\FavoriteApi', 'UpdateFavorites') );
add_action( 'wp_ajax_remove_favorites', array('\LogFavorite\FavoriteApi', 'RemoveFavorites') );
add_action( 'wp_ajax_get_title_favorites', array('\LogFavorite\FavoriteApi', 'GetTitleFavorites') );
add_action( 'wp_enqueue_scripts', array('\LogFavorite\LoadFiles', 'load') );

add_action( 'widgets_init', 'favorites_load_widget' );
add_shortcode( 'log-favorites', array('\LogFavorite\ShortCode', 'ShowOfFavorites') );