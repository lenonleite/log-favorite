/**
 * Created by lenonleite on 12/02/17.
 */



function AddFavorite(id){
    jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {"action": "update_favorites","IdFavorite":id},
        success: function (response) {
            jQuery('a[data-id-favorite="' + id + '"] .star-favorite').attr('src','/wp-content/plugins/log-favorite/assets/img/star-gold.png');
            jQuery('a[data-id-favorite="' + id + '"] .star-favorite').closest('a').removeClass('add-favorite').addClass('remove-favorite');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function RemoveFavorite(id){
    jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {"action": "remove_favorites","IdFavorite":id},
        success: function (response) {
            jQuery('a[data-id-favorite="' + id + '"] .star-favorite').attr('src','/wp-content/plugins/log-favorite/assets/img/star-no-gold.png');
            jQuery('a[data-id-favorite="' + id + '"] .star-favorite').closest('a').removeClass('remove-favorite').addClass('add-favorite');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function mountWidget(){
    jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {"action": "get_title_favorites"},
        success: function (response) {
            jQuery("#log-favorite-widget").html('');
            jQuery.each(response, function( key, value ){
                jQuery("#log-favorite-widget").append('<li>'+value+'</li>');
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function mountWidgetShortCode(){
    jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {"action": "get_title_favorites"},
        success: function (response) {
            jQuery("#log-favorite-widget").html('');
            jQuery("#log-favorite-shortcode").html('');
            jQuery.each(response, function( key, value ){
                jQuery("#log-favorite-widget").append('<li>'+value+'</li>');
                jQuery("#log-favorite-shortcode").append('<li>'+value+'</li>');
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

jQuery(document).on('click', ".add-favorite", function () {
    AddFavorite(jQuery(this).attr('data-id-favorite'));
    setTimeout(function(){
        mountWidgetShortCode();
    }, 1000);
});

jQuery(document).on('click', ".remove-favorite", function () {
    RemoveFavorite(jQuery(this).attr('data-id-favorite'));
    setTimeout(function(){
        mountWidgetShortCode();
    }, 1000);
});