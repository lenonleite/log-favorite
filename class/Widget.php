<?php
/**
 * Created by PhpStorm.
 * User: lenonleite
 * Date: 12/02/17
 * Time: 23:33
 */

//namespace LogFavorite;
include_once 'Favorite.php';
use LogFavorite\Favorite;

class favorites_widget extends WP_Widget {

    public $favorites;

    function __construct() {
        parent::__construct(
                'favorites_widget',
                __( 'Favorites Widget' ),
                array( 'description' => __( 'List of Favorites' ) )
        );
        $this->favorites = new Favorite();

    }

    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $listOfFavorites = array();
        $listOfFavorites = $this->favorites->GetListTitleFavorites();

        ?>
        <ul id="log-favorite-widget">
            <?php
            foreach ( $listOfFavorites as $favorite ) {
                echo "<li>" . $favorite . "</li>";
            }
            ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = __( 'New title' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance = "" ) {
        $instance          = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}


function favorites_load_widget() {
    register_widget( 'favorites_widget' );
}