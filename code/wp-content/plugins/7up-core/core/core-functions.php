<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


/**
 * Register post type
 *
 *
 * */

if(!function_exists('stp_reg_post_type'))
{
    function stp_reg_post_type($post_type, $args)
    {
        register_post_type($post_type, $args);
    }
}
/**
 * Register post type
 *
 *
 * */

if(!function_exists('stp_reg_taxonomy'))
{
    function stp_reg_taxonomy($taxonomy, $object_type, $args )
    {
        register_taxonomy($taxonomy, $object_type, $args );
    }
}
/**
 * Add shortcode
 *
 *
 * */

if(!function_exists('stp_reg_shortcode'))
{
    function stp_reg_shortcode($tag , $func )
    {
        add_shortcode($tag , $func );
    }
}
if(!function_exists('sv_shortcode_param'))
{
    function sv_shortcode_param( $name, $form_field_callback, $script_url = null ){
        add_shortcode_param( $name, $form_field_callback, $script_url = null );
    }
}
if(!function_exists('sv_scrape_instagram'))
{
function sv_scrape_instagram($username, $slice = 9) {
    $username = strtolower($username);
    $instagram = array();
    if($username) {
        $remote = wp_remote_get('http://instagram.com/'.trim($username));
        if (is_wp_error($remote))
        return new WP_Error('site_down', __('Unable to communicate with Instagram.', STP_TEXTDOMAIN));
        if ( 200 != wp_remote_retrieve_response_code( $remote ) )
        return new WP_Error('invalid_response', __('Instagram did not return a 200.', STP_TEXTDOMAIN));
        $shards = explode('window._sharedData = ', $remote['body']);
        $insta_json = explode(';</script>', $shards[1]);
        $insta_array = json_decode($insta_json[0], TRUE);
        // var_dump($insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes']);
        if (!$insta_array)
        return new WP_Error('bad_json', __('Instagram has returned invalid data.', STP_TEXTDOMAIN));
        if(isset($insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'])){
            $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            foreach ($images as $image) {
                $instagram[] = array(
                    'link' => 'http://instagram.com/p/'.$image['code'],
                    'thumbnail_src' => $image['thumbnail_src'],
                );
            }
        }
        set_transient('instagram-media-'.sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS*2));
    }
    return array_slice($instagram, 0, $slice);
    }
}
if(!function_exists('sv_images_only'))
{
    function sv_images_only($media_item) {
        if ($media_item['type'] == 'image')
        return true;
        return false;
    }
}
if(!function_exists('sv_get_current_url'))
{
    function sv_get_current_url() {
        $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        return $url;
    }
}
