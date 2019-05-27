<?php
/*
Plugin Name:    Proposals
Plugin URI:     xxx
Description:    A plugin to run the proposal system for xxx
Author:         Jennifer Brueske
Author URI:     https://jenniferbrueske.com
License:        GPL2
License URI:    https://www.gnu.org/licenses/gpl-2.0.html
Version:        1.0
*/


function iceberg_register_my_cpts_proposal() {

    /**
     * Post Type: Proposals.
     */

    $labels = array(
        "name" => __( "Proposals", "iceberg-child" ),
        "singular_name" => __( "Proposal", "iceberg-child" ),
    );

    $args = array(
        "label" => __( "Proposals", "iceberg-child" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "proposal", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 5,
        "menu_icon" => "/wp-content/uploads/2018/07/Sales.png",
        "supports" => array( "title", "thumbnail", "author" ),
    );

    register_post_type( "proposal", $args );
}

add_action( 'init', 'iceberg_register_my_cpts_proposal' );


// Add options page for Proposal Settings
if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
		'page_title' 	=> 'Proposal Pricing',
		'menu_title'	=> 'Proposal Settings',
		'menu_slug' 	=> 'proposal-settings',
		'capability'	=> 'activate_plugins',
		'redirect'		=> false
	));
	
}

// Update CSS within in Admin
function proposal_admin_style() {
    
    wp_enqueue_style('admin-styles', plugin_dir_url( __FILE__ ) .'/css/iceberg-proposal-admin.css');
}
add_action('admin_enqueue_scripts', 'proposal_admin_style');

function proposal_frontend_style() {
    
    wp_enqueue_style('frontend-styles', plugin_dir_url( __FILE__ ) .'/css/iceberg-proposal-style.css');
}
add_action('wp_enqueue_scripts', 'proposal_frontend_style');


/**
 * @param $post_ID
 * @param $post
 */
function iceberg_add_proposal_meta($post) {
    //Check that the post type being edited is our custom post type
    // if ( $post->post_type != 'proposal' ) {
    //     return;
    // }
    $post_ID =  get_the_ID();
    $pricing_reset = get_field('pricing_reset', $post_ID);

    // hosting price meta
    $hosting_prices = get_field('hosting_prices_default', 'option');
    $hosting_prices_custom = get_field('hosting_prices_custom', $post_ID);
    add_post_meta( $post_ID, '_ecomm_price_orig', $hosting_prices['ecommerce'], true);
    add_post_meta( $post_ID, '_hostmaint_price_orig', $hosting_prices['hosting_maintenance'], true );
    add_post_meta( $post_ID, '_hostreport_price_orig', $hosting_prices['hosting_monthly_reports'] , true);
    add_post_meta( $post_ID, '_webemail_price_orig', $hosting_prices['website_email_hosting'] , true);
    add_post_meta( $post_ID, '_webonly_price_orig', $hosting_prices['website_only_hosting'] , true);
    add_post_meta( $post_ID, '_premium_price_orig', $hosting_prices['premium'] , true);

    // development price meta
    $development_prices = get_field('development_prices_default', 'option');
    $development_prices_custom = get_field('development_prices_custom', $post_ID);
    add_post_meta( $post_ID, '_base_website_price_orig', $development_prices['base_website_development'], true );
    add_post_meta( $post_ID, '_custom_website_price_orig', $development_prices['custom_website_development'], true);
    add_post_meta( $post_ID, '_ecommerce_website_price_orig', $development_prices['ecommerce_website_development'], true );
    add_post_meta( $post_ID, '_transfer_price_orig', $development_prices['transfer_website_to_iceberg_hosting'], true );
    add_post_meta ($post_ID, '_additional_hours_price_orig', $development_prices['additional_development_hours'], true );

    //downpayment percent meta
    $downpayment_percent = get_field('downpayment_percent_default', 'option');
    $downpayment_percent_custom = get_field('downpayment_percent_custom', $post_ID);
    add_post_meta( $post_ID, '_downpayment_percent_orig', $downpayment_percent, true );

    //seo price meta
    $seo_prices = get_field('seo_prices', 'option');
    $seo_prices_custom = get_field('seo_prices_custom', $post_ID);
    add_post_meta( $post_ID, '_seo_five_price_orig', $seo_prices['five_pages_seo_content'], true);
    add_post_meta( $post_ID, '_seo_ten_price_orig', $seo_prices['ten_pages_seo_content'], true);

    //custom feature price meta
    $custom_feature_prices = get_field('custom_feature_prices_default', 'option');
    $custom_feature_prices_custom = get_field('custom_feature_prices_custom', $post_ID);
    add_post_meta( $post_ID, '_cpt_price_orig', $custom_feature_prices['custom_post_base'], true);
    add_post_meta( $post_ID, '_individual_cpt_price_orig', $custom_feature_prices['individual_custom_post_price'], true);
    add_post_meta( $post_ID, '_dynamic_port_price_orig', $custom_feature_prices['dynamic_portfolio_base'], true);
    add_post_meta( $post_ID, '_individual_port_price_orig', $custom_feature_prices['individual_portfolio_price'], true );
    add_post_meta( $post_ID, '_product_manage_price_orig', $custom_feature_prices['product_management_base'] , true);
    add_post_meta( $post_ID, '_individual_product_price_orig', $custom_feature_prices['individual_product_price'] , true);
    add_post_meta( $post_ID, '_dynamic_team_price_orig', $custom_feature_prices['dynamic_team_base'] , true);
    add_post_meta( $post_ID, '_individual_team_price_orig', $custom_feature_prices['individual_team_price'] , true);
    add_post_meta( $post_ID, '_store_locator_price_orig', $custom_feature_prices['store_locator_base'], true);
    add_post_meta( $post_ID, '_individual_store_price_orig', $custom_feature_prices['individual_store_location'], true );
    add_post_meta( $post_ID, '_bilingual_price_orig', $custom_feature_prices['bilingual'] , true);
    add_post_meta( $post_ID, '_career_price_orig', $custom_feature_prices['career'] , true);
    add_post_meta( $post_ID, '_custom_search_price_orig', $custom_feature_prices['custom_search'] , true);
    add_post_meta( $post_ID, '_events_calendar_price_orig', $custom_feature_prices['events_calendar'] , true);
    add_post_meta( $post_ID, '_complex_forms_price_orig', $custom_feature_prices['complex_forms'] , true);
    add_post_meta( $post_ID, '_logo_design_price_orig', $custom_feature_prices['logo_design'] , true);
    add_post_meta( $post_ID, '_transfer_wp_blog_price_orig', $custom_feature_prices['transfer_wp_blog'] , true);
    add_post_meta( $post_ID, '_transfer_non_wp_blog_price_orig', $custom_feature_prices['transfer_non_wp_blog'] , true);
    add_post_meta( $post_ID, '_video_price_orig', $custom_feature_prices['video_background_support'] , true);
    add_post_meta( $post_ID, '_included_pages_orig', $development_prices['included_pages'], true);
    add_post_meta( $post_ID, '_page_tier_one_orig', $development_prices['page_tier_one'], true);
    add_post_meta( $post_ID, '_page_tier_two_orig', $development_prices['page_tier_two'], true);
    add_post_meta( $post_ID, '_page_tier_one_price_orig', $development_prices['page_tier_one_price'], true);
    add_post_meta( $post_ID, '_page_tier_two_price_orig', $development_prices['page_tier_two_price'], true);
    add_post_meta( $post_ID, '_page_tier_three_price_orig', $development_prices['page_tier_three_price'], true);

    // If Reset Pricing is true, this will fetch current default pricing and then update the reset pricing field to false.
    if( '1' == $pricing_reset ){
        update_post_meta( $post_ID, '_ecomm_price_orig', $hosting_prices['ecommerce']);
        update_post_meta( $post_ID, '_hostmaint_price_orig', $hosting_prices['hosting_maintenance']);
        update_post_meta( $post_ID, '_hostreport_price_orig', $hosting_prices['hosting_monthly_reports']);
        update_post_meta( $post_ID, '_webemail_price_orig', $hosting_prices['website_email_hosting']);
        update_post_meta( $post_ID, '_webonly_price_orig', $hosting_prices['website_only_hosting']);
        update_post_meta( $post_ID, '_premium_price_orig', $hosting_prices['premium']);
        update_post_meta( $post_ID, '_base_website_price_orig', $development_prices['base_website_development']);
        update_post_meta( $post_ID, '_custom_website_price_orig', $development_prices['custom_website_development']);
        update_post_meta( $post_ID, '_ecommerce_website_price_orig', $development_prices['ecommerce_website_development']);
        update_post_meta( $post_ID, '_transfer_price_orig', $development_prices['transfer_website_to_iceberg_hosting']);
        update_post_meta( $post_ID, '_downpayment_percent_orig', $downpayment_percent);
        update_post_meta( $post_ID, '_additional_hours_price_orig', $development_prices['additional_development_hours']);
        update_post_meta( $post_ID, '_cpt_price_orig', $custom_feature_prices['custom_post_base']);
    	update_post_meta( $post_ID, '_individual_cpt_price_orig', $custom_feature_prices['individual_custom_post_price']);
        update_post_meta( $post_ID, '_dynamic_port_price_orig', $custom_feature_prices['dynamic_portfolio_base']);
        update_post_meta( $post_ID, '_individual_port_price_orig', $custom_feature_prices['individual_portfolio_price']);
        update_post_meta( $post_ID, '_product_manage_price_orig', $custom_feature_prices['product_management_base']);
        update_post_meta( $post_ID, '_individual_product_price_orig', $custom_feature_prices['individual_product_price']);
        update_post_meta( $post_ID, '_dynamic_team_price_orig', $custom_feature_prices['dynamic_team_base']);
        update_post_meta( $post_ID, '_individual_team_price_orig', $custom_feature_prices['individual_team_price']);
        update_post_meta( $post_ID, '_store_locator_price_orig', $custom_feature_prices['store_locator_base']);
        update_post_meta( $post_ID, '_individual_store_price_orig', $custom_feature_prices['individual_store_location']);
        update_post_meta( $post_ID, '_bilingual_price_orig', $custom_feature_prices['bilingual']);
        update_post_meta( $post_ID, '_custom_search_price_orig', $custom_feature_prices['custom_search']);
        update_post_meta( $post_ID, '_career_price_orig', $custom_feature_prices['career']);
        update_post_meta( $post_ID, '_events_calendar_price_orig', $custom_feature_prices['events_calendar']);
        update_post_meta( $post_ID, '_complex_forms_price_orig', $custom_feature_prices['complex_forms']);
        update_post_meta( $post_ID, '_logo_design_price_orig', $custom_feature_prices['logo_design']);
        update_post_meta( $post_ID, '_transfer_wp_blog_price_orig', $custom_feature_prices['transfer_wp_blog']);
        update_post_meta( $post_ID, '_transfer_non_wp_blog_price_orig', $custom_feature_prices['transfer_non_wp_blog']);
        update_post_meta( $post_ID, '_video_price_orig', $custom_feature_prices['video_background_support']);
        update_post_meta( $post_ID, '_included_pages_orig', $development_prices['included_pages']);
        update_post_meta( $post_ID, '_page_tier_one_orig', $development_prices['page_tier_one']);
        update_post_meta( $post_ID, '_page_tier_two_orig', $development_prices['page_tier_two']);
        update_post_meta( $post_ID, '_page_tier_one_price_orig', $development_prices['page_tier_one_price']);
        update_post_meta( $post_ID, '_page_tier_two_price_orig', $development_prices['page_tier_two_price']);
        update_post_meta( $post_ID, '_page_tier_three_price_orig', $development_prices['page_tier_three_price']);
        update_post_meta( $post_ID, '_seo_five_price_orig', $seo_prices['five_pages_seo_content']);
        update_post_meta( $post_ID, '_seo_ten_price_orig', $seo_prices['ten_pages_seo_content']);
        update_field('pricing_reset', '0', $post_ID);
    }

    if(!empty($hosting_prices_custom['ecommerce'])){
        update_post_meta($post_ID, '_ecomm_price', $hosting_prices_custom['ecommerce'] );
    }else{
        $orig = get_post_meta($post_ID,'_ecomm_price_orig',true);
        update_post_meta($post_ID, '_ecomm_price', $orig );
    }
    if(!empty($hosting_prices_custom['hosting_maintenance'])){
        update_post_meta($post_ID, '_hostmaint_price', $hosting_prices_custom['hosting_maintenance'] );
    }else{
        $orig = get_post_meta($post_ID,'_hostmaint_price_orig',true);
        update_post_meta($post_ID, '_hostmaint_price', $orig );
    }
    if(!empty($hosting_prices_custom['hosting_monthly_reports'])) {
        update_post_meta($post_ID, '_hostreport_price', $hosting_prices_custom['hosting_monthly_reports']);
    }else{
        $orig = get_post_meta($post_ID,'_hostreport_price_orig',true);
        update_post_meta($post_ID, '_hostreport_price', $orig );
    }
    if(!empty($hosting_prices_custom['website_email_hosting'])){
        update_post_meta($post_ID, '_webemail_price', $hosting_prices_custom['website_email_hosting'] );
    }else{
        $orig = get_post_meta($post_ID,'_webemail_price_orig',true);
        update_post_meta($post_ID, '_webemail_price', $orig );
    }
    if(!empty($hosting_prices_custom['website_only_hosting'])){
        update_post_meta($post_ID, '_webonly_price', $hosting_prices_custom['website_only_hosting'] );
    }else{
        $orig = get_post_meta($post_ID,'_webonly_price_orig',true);
        update_post_meta($post_ID, '_webonly_price', $orig );
    }
    if(!empty($hosting_prices_custom['premium'])){
        update_post_meta($post_ID, '_premium_price', $hosting_prices_custom['premium'] );
    }else{
        $orig = get_post_meta($post_ID,'_premium_price_orig',true);
        update_post_meta($post_ID, '_premium_price', $orig );
    }

    if(!empty($seo_prices_custom['five_pages_seo_content'])){
        update_post_meta($post_ID, '_seo_five_price', $seo_prices_custom['five_pages_seo_content'] );
    }else{
        $orig = get_post_meta($post_ID,'_seo_five_price_orig',true);
        update_post_meta($post_ID, '_seo_five_price', $orig );
    }
    if(!empty($seo_prices_custom['ten_pages_seo_content'])){
        update_post_meta($post_ID, '_seo_ten_price', $seo_prices_custom['ten_pages_seo_content'] );
    }else{
        $orig = get_post_meta($post_ID,'_seo_ten_price_orig',true);
        update_post_meta($post_ID, '_seo_ten_price', $orig );
    }

    if(!empty($development_prices_custom['base_website_development'])){
        update_post_meta($post_ID, '_base_website_price', $development_prices_custom['base_website_development'] );
    }else{
        $orig = get_post_meta($post_ID,'_base_website_price_orig',true);
        update_post_meta($post_ID, '_base_website_price', $orig );
    }
    if(!empty($development_prices_custom['custom_website_development'])){
        update_post_meta($post_ID, '_custom_website_price', $development_prices_custom['custom_website_development'] );
    }else{
        $orig = get_post_meta($post_ID,'_custom_website_price_orig',true);
        update_post_meta($post_ID, '_custom_website_price', $orig );
    }
    if(!empty($development_prices_custom['ecommerce_website_development'])){
        update_post_meta($post_ID, '_ecommerce_website_price', $development_prices_custom['ecommerce_website_development'] );
    }else{
        $orig = get_post_meta($post_ID,'_ecommerce_website_price_orig',true);
        update_post_meta($post_ID, '_ecommerce_website_price', $orig );
    }
    if(!empty($development_prices_custom['transfer_website_to_iceberg_hosting'])){
        update_post_meta($post_ID, '_transfer_price', $development_prices_custom['transfer_website_to_iceberg_hosting'] );
    }else{
        $orig = get_post_meta($post_ID,'_transfer_price_orig',true);
        update_post_meta($post_ID, '_transfer_price', $orig );
    }
    if(!empty($development_prices_custom['additional_development_hours'])){
        update_post_meta($post_ID, '_additional_hours_price', $development_prices_custom['additional_development_hours'] );
    }else{
        $orig = get_post_meta($post_ID,'_additional_hours_price_orig',true);
        update_post_meta($post_ID, '_additional_hours_price', $orig );
    }

    if(!empty($downpayment_percent_custom)){
        update_post_meta($post_ID, '_downpayment_percent', $downpayment_percent_custom);
    }else{
        $orig = get_post_meta($post_ID,'_downpayment_percent_orig',true);
        update_post_meta($post_ID, '_downpayment_percent', $orig );
    }

    if(!empty($custom_feature_prices_custom['custom_post_base'])){
    	update_post_meta( $post_ID, '_cpt_price', $custom_feature_prices_custom['custom_post_base']);
    }else{
    	$orig = get_post_meta($post_ID,'_cpt_price_orig', true);
    	update_post_meta( $post_ID, '_cpt_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['individual_custom_post_price'])){
    	update_post_meta( $post_ID, '_individual_cpt_price', $custom_feature_prices_custom['individual_custom_post_price']);
    }else{
    	$orig = get_post_meta($post_ID,'_individual_cpt_price_orig', true);
    	update_post_meta( $post_ID, '_individual_cpt_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['dynamic_portfolio_base'])){
        update_post_meta($post_ID, '_dynamic_port_price', $custom_feature_prices_custom['dynamic_portfolio_base'] );
    }else{
        $orig = get_post_meta($post_ID,'_dynamic_port_price_orig',true);
        update_post_meta($post_ID, '_dynamic_port_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['individual_portfolio_price'])){
        update_post_meta($post_ID, '_individual_port_price', $custom_feature_prices_custom['individual_portfolio_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_individual_port_price_orig',true);
        update_post_meta($post_ID, '_individual_port_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['product_management_base'])){
        update_post_meta($post_ID, '_product_manage_price', $custom_feature_prices_custom['product_management_base'] );
    }else{
        $orig = get_post_meta($post_ID,'_product_manage_price_orig',true);
        update_post_meta($post_ID, '_product_manage_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['individual_product_price'])){
        update_post_meta($post_ID, '_individual_product_price', $custom_feature_prices_custom['individual_product_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_individual_product_price_orig',true);
        update_post_meta($post_ID, '_individual_product_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['dynamic_team_base'])){
        update_post_meta($post_ID, '_dynamic_team_price', $custom_feature_prices_custom['dynamic_team_base'] );
    }else{
        $orig = get_post_meta($post_ID,'_dynamic_team_price_orig',true);
        update_post_meta($post_ID, '_dynamic_team_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['individual_team_price'])){
        update_post_meta($post_ID, '_individual_team_price', $custom_feature_prices_custom['individual_team_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_individual_team_price_orig',true);
        update_post_meta($post_ID, '_individual_team_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['store_locator_base'])){
        update_post_meta($post_ID, '_store_locator_price', $custom_feature_prices_custom['store_locator_base'] );
    }else{
        $orig = get_post_meta($post_ID,'_store_locator_price_orig',true);
        update_post_meta($post_ID, '_store_locator_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['individual_store_location'])){
        update_post_meta($post_ID, '_individual_store_price', $custom_feature_prices_custom['individual_store_location'] );
    }else{
        $orig = get_post_meta($post_ID,'_individual_store_price_orig',true);
        update_post_meta($post_ID, '_individual_store_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['bilingual'])){
        update_post_meta($post_ID, '_bilingual_price', $custom_feature_prices_custom['bilingual'] );
    }else{
        $orig = get_post_meta($post_ID,'_bilingual_price_orig',true);
        update_post_meta($post_ID, '_bilingual_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['career'])){
        update_post_meta($post_ID, '_career_price', $custom_feature_prices_custom['career'] );
    }else{
        $orig = get_post_meta($post_ID,'_career_price_orig',true);
        update_post_meta($post_ID, '_career_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['custom_search'])){
        update_post_meta($post_ID, '_custom_search_price', $custom_feature_prices_custom['custom_search'] );
    }else{
        $orig = get_post_meta($post_ID,'_custom_search_price_orig',true);
        update_post_meta($post_ID, '_custom_search_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['events_calendar'])){
        update_post_meta($post_ID, '_events_calendar_price', $custom_feature_prices_custom['events_calendar'] );
    }else{
        $orig = get_post_meta($post_ID,'_events_calendar_price_orig',true);
        update_post_meta($post_ID, '_events_calendar_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['complex_forms'])){
        update_post_meta($post_ID, '_complex_forms_price', $custom_feature_prices_custom['complex_forms'] );
    }else{
        $orig = get_post_meta($post_ID,'_complex_forms_price_orig',true);
        update_post_meta($post_ID, '_complex_forms_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['logo_design'])){
        update_post_meta($post_ID, '_logo_design_price', $custom_feature_prices_custom['logo_design'] );
    }else{
        $orig = get_post_meta($post_ID,'_logo_design_price_orig',true);
        update_post_meta($post_ID, '_logo_design_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['transfer_wp_blog'])){
        update_post_meta($post_ID, '_transfer_wp_blog_price', $custom_feature_prices_custom['transfer_wp_blog'] );
    }else{
        $orig = get_post_meta($post_ID,'_transfer_wp_blog_price_orig',true);
        update_post_meta($post_ID, '_transfer_wp_blog_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['transfer_non_wp_blog'])){
        update_post_meta($post_ID, '_transfer_non_wp_blog_price', $custom_feature_prices_custom['transfer_non_wp_blog'] );
    }else{
        $orig = get_post_meta($post_ID,'_transfer_non_wp_blog_price_orig',true);
        update_post_meta($post_ID, '_transfer_non_wp_blog_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['video_background_support'])){
        update_post_meta($post_ID, '_video_price', $custom_feature_prices_custom['video_background_support'] );
    }else{
        $orig = get_post_meta($post_ID,'_video_price_orig',true);
        update_post_meta($post_ID, '_video_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['included_pages'])){
        update_post_meta($post_ID, '_included_pages', $custom_feature_prices_custom['included_pages'] );
    }else{
        $orig = get_post_meta($post_ID,'_included_pages_orig',true);
        update_post_meta($post_ID, '_included_pages', $orig );
    }
    if(!empty($custom_feature_prices_custom['page_tier_one'])){
        update_post_meta($post_ID, '_page_tier_one', $custom_feature_prices_custom['page_tier_one'] );
    }else{
        $orig = get_post_meta($post_ID,'_page_tier_one_orig',true);
        update_post_meta($post_ID, '_page_tier_one', $orig );
    }
    if(!empty($custom_feature_prices_custom['page_tier_two'])){
        update_post_meta($post_ID, '_page_tier_two', $custom_feature_prices_custom['page_tier_two'] );
    }else{
        $orig = get_post_meta($post_ID,'_page_tier_two_orig',true);
        update_post_meta($post_ID, '_page_tier_two', $orig );
    }
    if(!empty($custom_feature_prices_custom['page_tier_one_price'])){
        update_post_meta($post_ID, '_page_tier_one_price', $custom_feature_prices_custom['page_tier_one_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_page_tier_one_price_orig',true);
        update_post_meta($post_ID, '_page_tier_one_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['page_tier_two_price'])){
        update_post_meta($post_ID, '_page_tier_two_price', $custom_feature_prices_custom['page_tier_two_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_page_tier_two_price_orig',true);
        update_post_meta($post_ID, '_page_tier_two_price', $orig );
    }
    if(!empty($custom_feature_prices_custom['page_tier_three_price'])){
        update_post_meta($post_ID, '_page_tier_three_price', $custom_feature_prices_custom['page_tier_three_price'] );
    }else{
        $orig = get_post_meta($post_ID,'_page_tier_three_price_orig',true);
        update_post_meta($post_ID, '_page_tier_three_price', $orig );
    }

}
add_action('publish_proposal', 'iceberg_add_proposal_meta');
add_action(  'save_post_proposal',  'iceberg_add_proposal_meta', 10, 3 );

// set single template
function load_proposal_template($template) {
    global $post;

    if ($post->post_type == "proposal" && $template !== locate_template(array("single-proposal.php"))){
        /* This is a "proposal" post 
         * AND a 'single proposal template' is not found on 
         * theme or child theme directories, so load it 
         * from our plugin directory
         */
        return plugin_dir_path( __FILE__ ) . "single-proposal.php";
    }

    return $template;
}

add_filter('single_template', 'load_proposal_template');

//allow rounding in Gravity Forms
/**
 * Gravity Wiz // Gravity Forms // Rounding by Increment
 *
 * Provides a variety of rounding functions for Gravity Form Number fields powered by the CSS class setting for each field. Functions include:
 *
 *  + rounding to an increment            (i.e. increment of 100 would round 1 to 100, 149 to 100, 150 to 200, etc) | class: 'gw-round-100'
 *  + rounding up by an increment         (i.e. increment of 50 would round 1 to 50, 51 to 100, 149 to 150, etc)    | class: 'gw-round-up-50'
 *  + rounding down by an increment       (i.e. increment of 25 would round 1 to 0, 26 to 25, 51 to 50, etc)        | class: 'gw-round-down-25'
 *  + rounding up to a specific minimum   (i.e. min of 50 would round 1 to 50, 51 and greater would not be rounded) | class: 'gw-round-min-50'
 *  + rounding down to a specific maximum (i.e. max of 25 would round 26 to 25, 25 and below would not be rounded)  | class: 'gw-round-max-25'
 *
 * @version 1.7
 * @author  David Smith <david@gravitywiz.com>
 * @license GPL-2.0+
 * @link    http://gravitywiz.com/rounding-increments-gravity-forms/
 */
class GW_Rounding {

    private static $instance = null;

    protected static $is_script_output = false;

    protected $class_regex = 'gw-round-(\w+)-?(\w+)?';

    public static function get_instance() {
        if( null == self::$instance )
            self::$instance = new self;
        return self::$instance;
    }

    private function __construct( $args = array() ) {

        // make sure we're running the required minimum version of Gravity Forms
        if( ! property_exists( 'GFCommon', 'version' ) || ! version_compare( GFCommon::$version, '1.8', '>=' ) )
            return;

        // time for hooks
        add_filter( 'gform_pre_render',            array( $this, 'prepare_form_and_load_script' ), 10, 2 );
        add_filter( 'gform_register_init_scripts', array( $this, 'add_init_script' ) );
        add_filter( 'gform_enqueue_scripts',       array( $this, 'enqueue_form_scripts' ) );

        add_action( 'gform_pre_submission',     array( $this, 'override_submitted_value' ), 10, 5 );
        add_filter( 'gform_calculation_result', array( $this, 'override_submitted_calculation_value' ), 10, 5 );

    }

    public function prepare_form_and_load_script( $form, $is_ajax_enabled ) {

        if( ! $this->is_applicable_form( $form ) ) {
            return $form;
        }

        if( $this->is_applicable_form( $form ) && ! has_action( 'wp_footer', array( $this, 'output_script' ) ) ) {
            add_action( 'wp_footer', array( $this, 'output_script' ) );
            add_action( 'gform_preview_footer', array( $this, 'output_script' ) );
        }

        foreach( $form['fields'] as &$field ) {
            if( preg_match( $this->get_class_regex(), $field['cssClass'] ) ) {
                $field['cssClass'] .= ' gw-rounding';
            }
        }

        return $form;
    }

    public function is_ajax_submission( $form_id, $is_ajax_enabled ) {
        return class_exists( 'GFFormDisplay' ) && isset( GFFormDisplay::$submission[ $form_id ] ) && $is_ajax_enabled;
    }

    function output_script() {
        ?>

        <script type="text/javascript">

            var GWRounding;

            ( function( $ ) {

                GWRounding = function( args ) {

                    var self = this;

                    // copy all args to current object: (list expected props)
                    for( prop in args ) {
                        if( args.hasOwnProperty( prop ) )
                            self[prop] = args[prop];
                    }

                    self.init = function() {

                        self.fieldElems = $( '#gform_wrapper_' + self.formId + ' .gw-rounding' );

                        self.parseElemActions( self.fieldElems );

                        self.bindEvents();

                    };

                    self.parseElemActions = function( elems ) {

                        elems.each( function() {

                            var cssClasses      = $( this ).attr( 'class' ),
                                roundingActions = self.parseActions( cssClasses );

                            $( this ).data( 'gw-rounding', roundingActions );

                        } );

                    }

                    self.parseActions = function( str ) {

                        var matches         = getMatchGroups( String( str ), new RegExp( self.classRegex.replace( /\\/g, '\\' ), 'i' ) ),
                            roundingActions = [];

                        for( var i = 0; i < matches.length; i++ ) {

                            var action      = matches[i][1],
                                actionValue = matches[i][2];

                            if( typeof actionValue == 'undefined' ) {
                                actionValue = action;
                                action = 'round';
                            }

                            var roundingAction = {
                                'action':      action,
                                'actionValue': actionValue
                            };

                            roundingActions.push( roundingAction );

                        }

                        return roundingActions;
                    }

                    self.bindEvents = function() {

                        self.fieldElems.find( 'input' ).each( function() {
                            self.applyRoundingActions( $( this ) );
                        } ).blur( function() {
                            self.applyRoundingActions( $( this ) );
                        } );

                        gform.addFilter( 'gform_calculation_result', function( result, formulaField, formId, calcObj ) {

                            var $input = $( '#input_' + formId + '_' + formulaField.field_id )
                            $field = $input.parents( '.gfield' );

                            if( $field.hasClass( 'gw-rounding' ) ) {
                                result = self.getRoundedValue( $input, result );
                            }

                            return result;
                        } );

                    }

                    self.applyRoundingActions = function( $input ) {
                        var value = self.getRoundedValue( $input );
                        if( $input.val() != value ) {
                            $input.val( value ).change();
                        }
                    }

                    self.getRoundedValue = function( $input, value ) {

                        var $field  = $input.parents( '.gfield' ),
                            actions = $field.data( 'gw-rounding' );

                        // allows setting the 'gw-rounding' data for an element to null and it will be reparsed
                        if( actions === null ) {
                            self.parseElemActions( $field );
                            actions = $field.data( 'gw-rounding' );
                        }

                        if( typeof actions == 'undefined' || actions === false || actions.length <= 0 ) {
                            return;
                        }

                        if( typeof value == 'undefined' ) {

                            value = gformToNumber( $input.val() );

                            var currency = new Currency(gf_global.gf_currency_config);
                            value = gformCleanNumber( value, currency.currency.symbol_right, currency.currency.symbol_left, currency.currency.decimal_separator );

                        }

                        if( value != '' ) {
                            for( var i = 0; i < actions.length; i++ ) {
                                value = GWRounding.round( value, actions[i].actionValue, actions[i].action );
                            }
                        }

                        return isNaN( value ) ? '' : value;
                    };

                    GWRounding.round = function( value, actionValue, action ) {

                        var interval, base, min, max;

                        value = parseFloat( value );
                        actionValue = parseInt( actionValue );

                        switch( action ) {
                            case 'min':
                                min = actionValue;
                                if( value < min ) {
                                    value = min;
                                }
                                break;
                            case 'max':
                                max = actionValue;
                                if( value > max ) {
                                    value = max;
                                }
                                break;
                            case 'up':
                                interval = actionValue;
                                base     = Math.ceil( value / interval );
                                value    = base * interval;
                                break;
                            case 'down':
                                interval = actionValue;
                                base     = Math.floor( value / interval );
                                value    = base * interval;
                                break;
                            default:
                                interval = actionValue;
                                base     = Math.round( value / interval );
                                value    = base * interval;
                                break;
                        }

                        return parseInt( value );
                    }

                    self.init();

                }

            } )( jQuery );

        </script>

        <?php
    }

    function add_init_script( $form ) {

        if( ! $this->is_applicable_form( $form ) ) {
            return;
        }

        $args = array(
            'formId'    => $form['id'],
            'classRegex' => $this->class_regex
        );
        $script = 'new GWRounding( ' . json_encode( $args ) . ' );';

        GFFormDisplay::add_init_script( $form['id'], 'gw_rounding', GFFormDisplay::ON_PAGE_RENDER, $script );

    }

    function enqueue_form_scripts( $form ) {

        if( $this->is_applicable_form( $form ) ) {
            wp_enqueue_script( 'gform_gravityforms' );
        }

    }

    function override_submitted_value( $form ) {

        foreach( $form['fields'] as $field ) {
            if( $this->is_applicable_field( $field ) ) {
                $value = $this->process_rounding_actions( rgpost( "input_{$field['id']}" ), $this->get_rounding_actions( $field ) );
                $_POST[ "input_{$field['id']}" ] = $value;
            }
        }

    }

    function override_submitted_calculation_value( $result, $formula, $field, $form, $entry ) {

        if( $this->is_applicable_field( $field ) ) {
            $result = $this->process_rounding_actions( $result, $this->get_rounding_actions( $field ) );
        }

        return $result;
    }

    function process_rounding_actions( $value, $actions ) {

        foreach( $actions as $action ) {
            $value = $this->round( $value, $action['action'], $action['action_value'] );
        }

        return $value;
    }

    function round( $value, $action, $action_value ) {

        $value = intval( $value );
        $action_value = intval( $action_value );

        switch( $action ) {
            case 'min':
                $min = $action_value;
                if( $value < $min ) {
                    $value = $min;
                }
                break;
            case 'max':
                $max = $action_value;
                if( $value > $max ) {
                    $value = $max;
                }
                break;
            case 'up':
                $interval = $action_value;
                $base     = ceil( $value / $interval );
                $value    = $base * $interval;
                break;
            case 'down':
                $interval = $action_value;
                $base     = floor( $value / $interval );
                $value    = $base * $interval;
                break;
            default:
                $interval = $action_value;
                $base     = round( $value / $interval );
                $value    = $base * $interval;
                break;
        }

        return intval( $value );
    }

    // # HELPERS

    function is_applicable_form( $form ) {

        foreach( $form['fields'] as $field ) {
            if( $this->is_applicable_field( $field ) ) {
                return true;
            }
        }

        return false;
    }

    function is_applicable_field( $field ) {
        return preg_match( $this->get_class_regex(), rgar( $field, 'cssClass' ) ) == true;
    }

    function get_class_regex() {
        return "/{$this->class_regex}/";
    }

    function get_rounding_actions( $field ) {

        $actions = array();

        preg_match_all( $this->get_class_regex(), rgar( $field, 'cssClass' ), $matches, PREG_SET_ORDER );

        foreach( $matches as $match ) {

            list( $full_match, $action, $action_value ) = array_pad( $match, 3, false );

            if( $action_value === false ) {
                $action_value = $action;
                $action = 'round';
            }

            $action = array(
                'action'       => $action,
                'action_value' => $action_value
            );

            $actions[] = $action;

        }

        return $actions;
    }

}

function gw_rounding() {
    return GW_Rounding::get_instance();
}

gw_rounding();