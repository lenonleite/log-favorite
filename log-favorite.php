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

add_filter( 'the_content', ['\LogFavorite\Favorite', 'HookInsertStarAfterTheContent']);
add_action( 'wp_ajax_nopriv_get_favorites', ['\LogFavorite\FavoriteApi', 'GetFavorites'] );
add_action( 'wp_ajax_nopriv_update_favorites', ['\LogFavorite\FavoriteApi', 'UpdateFavorites'] );
add_action( 'wp_ajax_nopriv_remove_favorites', ['\LogFavorite\FavoriteApi', 'RemoveFavorites'] );
add_action( 'wp_ajax_nopriv_get_title_favorites', ['\LogFavorite\FavoriteApi', 'GetTitleFavorites'] );
add_action( 'wp_ajax_get_favorites', ['\LogFavorite\FavoriteApi', 'GetFavorites'] );
add_action( 'wp_ajax_update_favorites', ['\LogFavorite\FavoriteApi', 'UpdateFavorites'] );
add_action( 'wp_ajax_remove_favorites', ['\LogFavorite\FavoriteApi', 'RemoveFavorites'] );
add_action( 'wp_ajax_get_title_favorites', ['\LogFavorite\FavoriteApi', 'GetTitleFavorites'] );
add_action( 'wp_enqueue_scripts', ['\LogFavorite\LoadFiles', 'load'] );

add_action( 'widgets_init', 'favorites_load_widget' );
add_shortcode( 'log-favorites', ['\LogFavorite\ShortCode', 'ShowOfFavorites'] );