<?php
/**
 * The template for displaying all single posts and attachments
 */
global $post;
$author_id = $post->post_author;
$author_email = get_the_author_meta( 'user_email' , $author_id );
$author_name = get_the_author_meta( 'first_name' , $author_id );
$author_phone = get_field( 'author_phone' , 'user_'. $author_id );

if( $post->post_status == 'won' ) {
    //fetch regular header
    get_header();
    ?>
    
        <div class="iceberg-content-area" style="padding: 0px;">
            <div class="iwd-core-pbf-section" style="padding: 0px;">

                <div class="iwd-core-pbf-section-container iwd-core-container clearfix" style="max-width: unset;">
                    <div class="iwd-core-pbf-wrapper-container clearfix iwd-core-pbf-wrapper-full-no-space">
                    <div class="iwd-core-pbf-column iwd-core-column-30 iwd-core-column-first">
                        <div class="iwd-core-pbf-column-content-margin iwd-core-js  iwd-core-column-extend-left" data-sync-height="iceberg-size" >
                            <div class="iwd-core-pbf-background-wrap">
                                <?php
                                $won_content = get_field('won_content', 'option');
                                $image = $won_content['image'];
                                ?>
                                <div class="iwd-core-pbf-background iwd-core-parallax iwd-core-js" style="background-image: url('<?php echo $image['url']; ?>') ;background-size: cover ;background-position: center ;" data-parallax-speed="0">
                                </div>
                            </div>
                            <div class="iwd-core-pbf-column-content clearfix iwd-core-js  iwd-core-sync-height-content">
                            </div>
                        </div>
                    </div>                
                     <div class="iwd-core-pbf-column iwd-core-column-30">
                        <div class="iwd-core-pbf-column-content-margin iwd-core-js " style="padding: 240px 30px 240px 60px;" data-sync-height="iceberg-size" data-sync-height-center="">
                            <div class="iwd-core-sync-height-pre-spaces" style="padding-top: 10px;"></div>
                            <div class="iwd-core-pbf-column-content clearfix iwd-core-js  iwd-core-sync-height-content">
                                <div class="iwd-core-pbf-element">
                                    <div class="iwd-core-text-box-item iwd-core-item-pdlr iwd-core-item-pdb iwd-core-left-align" style="padding-bottom: 0px ;">
                                        <div class="iwd-core-text-box-item-content" style="text-transform: none ; text-align: center;">
                                            <?php echo $won_content['content']; ?>
                                            <p>Your sales contact is <strong><?php echo $author_name; ?></strong> 
                                            <?php if( !empty($author_phone) ) { ?> 
                                                at <a href="tel:<?php echo $author_phone; ?>"><?php echo $author_phone; ?></a> 
                                                or by email <?php } ?>
                                                at <a href="mailto:<?php echo $author_email; ?>"><?php echo $author_email; ?></a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>                                            
                    </div>          
                </div>
            </div>
        </div>
    
<?php
}elseif( $post->post_status == 'lost' ){
    //fetch regular header
    get_header();
    ?>
    
        <div class="iceberg-content-area" style="padding: 0px;">
            <div class="iwd-core-pbf-section" style="padding: 0px;">

                <div class="iwd-core-pbf-section-container iwd-core-container clearfix" style="max-width: unset;">
                    <div class="iwd-core-pbf-wrapper-container clearfix iwd-core-pbf-wrapper-full-no-space">
                    <div class="iwd-core-pbf-column iwd-core-column-30 iwd-core-column-first">
                        <div class="iwd-core-pbf-column-content-margin iwd-core-js  iwd-core-column-extend-left" data-sync-height="iceberg-size" >
                            <div class="iwd-core-pbf-background-wrap">
                                <?php
                                $lost_content = get_field('lost_content', 'option');
                                $image = $lost_content['image'];
                                ?>
                                <div class="iwd-core-pbf-background iwd-core-parallax iwd-core-js" style="background-image: url('<?php echo $image['url']; ?>') ;background-size: cover ;background-position: center ;" data-parallax-speed="0">
                                </div>
                            </div>
                            <div class="iwd-core-pbf-column-content clearfix iwd-core-js  iwd-core-sync-height-content">
                            </div>
                        </div>
                    </div>                
                     <div class="iwd-core-pbf-column iwd-core-column-30">
                        <div class="iwd-core-pbf-column-content-margin iwd-core-js " style="padding: 240px 30px 240px 60px;" data-sync-height="iceberg-size" data-sync-height-center="">
                            <div class="iwd-core-sync-height-pre-spaces" style="padding-top: 10px;"></div>
                            <div class="iwd-core-pbf-column-content clearfix iwd-core-js  iwd-core-sync-height-content">
                                <div class="iwd-core-pbf-element">
                                    <div class="iwd-core-text-box-item iwd-core-item-pdlr iwd-core-item-pdb iwd-core-left-align" style="padding-bottom: 0px ;">
                                        <div class="iwd-core-text-box-item-content" style="text-transform: none ; text-align: center;">
                                            <?php echo $lost_content['content']; ?>
                                            <p>Your sales contact is <strong><?php echo $author_name; ?></strong> 
                                            <?php if( !empty($author_phone) ) { ?> 
                                                at <a href="tel:<?php echo $author_phone; ?>"><?php echo $author_phone; ?></a> 
                                                or by email <?php } ?>
                                                at <a href="mailto:<?php echo $author_email; ?>"><?php echo $author_email; ?></a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                            
                </div>          
            </div>
        </div>
    </div>
    
<?php
}else{

//fetch proposal header - no menu
get_header('proposal');


// print header title
if( get_post_type() == 'post' ){
    get_template_part('header/header', 'title-blog');
}

        $proposal_maintenance = get_field('proposal_maintenance_mode', 'option');
        $proposal_maintenance_mode_settings = get_field('proposal_maintenance_mode_settings', option);
        $background_image = $proposal_maintenance_mode_settings['proposal_maintenance_background_image'];
    

        if( !is_user_logged_in() && true == $proposal_maintenance ){ 

            ?>


            <div class="iceberg-maintenance" style="background-image: url(<?php echo $background_image['url']; ?>); background-size: cover; height: 800px;"> 

                <div class="iceberg-maintenance-content" style="padding-top: 350px;">

                    <?php echo $proposal_maintenance_mode_settings['proposal_maintenance_content']; ?>

                </div>
            


            </div>

               

            
            <?php
        }else{


while( have_posts() ){ the_post();

    $post_option = iceberg_get_post_option(get_the_ID());

    if( empty($post_option['sidebar']) || $post_option['sidebar'] == 'default' ){
        $sidebar_type = iceberg_get_option('general', 'blog-sidebar', 'none');
        $sidebar_left = iceberg_get_option('general', 'blog-sidebar-left');
        $sidebar_right = iceberg_get_option('general', 'blog-sidebar-right');
    }else{
        $sidebar_type = empty($post_option['sidebar'])? 'none': $post_option['sidebar'];
        $sidebar_left = empty($post_option['sidebar-left'])? '': $post_option['sidebar-left'];
        $sidebar_right = empty($post_option['sidebar-right'])? '': $post_option['sidebar-right'];
    }

    echo '<div class="iceberg-content-container iceberg-container">';
    echo '<div class="' . iceberg_get_sidebar_wrap_class($sidebar_type) . '" >';

    // sidebar content
    echo '<div class="' . iceberg_get_sidebar_class(array('sidebar-type'=>$sidebar_type, 'section'=>'center')) . '" >';
    echo '<div class="iceberg-content-wrap iceberg-item-pdlr clearfix" >';

    // propsal vars and calculations

    function roundUpToAny($n,$x=5) {
        return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
    }

    // vars
    setlocale(LC_MONETARY, 'en_US.utf8');
    $post_ID = get_the_ID();
    $company_address = get_field('company_address');
    $website_hosting = get_field('website_hosting');
    $website_development = get_field('website_development');
    $website_development_select = $website_development['website_development_select'];
    $custom_features = get_field('custom_features');
    $order_multiplier = get_field('order_multiplier');
    $website_hosting_service = $website_hosting['website_hosting_service'];
    $seo = get_field('seo');
    $seo_content_choice = $seo['seo_content'];
    // $go_live_date = get_field('go_live_date');
    $goals = get_field('goals');
    // get sales email
    $sales_email = get_the_author_meta( 'user_email');
    $project_options = get_field('project_options');
    $custom_options = $custom_features['custom_feature_options'];
    $email_hosting_service = $website_hosting['email_hosting'];

    $proposal_sent = get_field('proposal_sent');

    // prices
    $ecomm = $post->_ecomm_price;
    $hostmaint = $post->_hostmaint_price;
    $premium = $post->_premium_price;
    $hostreport = $post->_hostreport_price;
    $webemail = $post->_webemail_price;
    $webonly = $post->_webonly_price;

    $web_development = $post->_base_website_price;
    $custom_web_development = $post->_custom_website_price;
    $ecom_development = $post->_ecommerce_website_price;
    $transfer_development = $post->_transfer_price;

    $downpayment_percent = $post->_downpayment_percent;

    $additional_hours_price = $post->_additional_hours_price;
    // $additional_hours_quantity = $website_development['additional_hourly_website_development_hours'];
    $additional_hours_select = get_field('additional_hourly_website_development_select');

    $seo_no_content = 0;
    $seo_five_pages = $post->_seo_five_price;
    $seo_ten_pages = $post->_seo_ten_price;


    $custom_post_base = $post->_cpt_price;
    $individual_custom_post = $post->_individual_cpt_price;
    $quantity_cpt = $custom_features['quantity_custom_post'];

    $dynamic_portfolio_base = $post->_dynamic_port_price;
    $individual_portfolio = $post->_individual_port_price;
    $quantity_portfolio = $custom_features['quantity_portfolio'];

    $product_management_base = $post->_product_manage_price;
    $individual_product = $post->_individual_product_price;
    $quantity_products = $custom_features['quantity_products'];

    $dynamic_team_base = $post->_dynamic_team_price;
    $individual_team = $post->_individual_team_price;
    $quantity_team = $custom_features['quantity_team'];

    $store_locator_base = $post->_store_locator_price;
    $individual_store = $post->_individual_store_price;
    $quantity_stores = $custom_features['quantity_stores'];

    $bilingual = $post->_bilingual_price;
    $custom_search = $post->_custom_search_price;
    $career = $post->_career_price;
    $events_calendar = $post->_events_calendar_price;
    $forms = $post->_complex_forms_price;
    $logo = $post->_logo_design_price;
    $transfer_wp_blog = $post->_transfer_wp_blog_price;
    $transfer_non_wp_blog = $post->_transfer_non_wp_blog_price;
    $video = $post->_video_price;
    $included_pages = $post->_included_pages;
    $additional_pages = $website_development['page_quantity'] - $included_pages;
    $total_page_quantity = $website_development['page_quantity'];
    $page_tier_one = $post->_page_tier_one;
    $page_tier_two = $post->_page_tier_two;
    $page_tier_one_price = $post->_page_tier_one_price;
    $page_tier_two_price = $post->_page_tier_two_price;
    $page_tier_three_price = $post->_page_tier_three_price;

    // maths for website hosting
    if( $project_options && in_array('host', $project_options) ) {
    switch ($website_hosting_service['value']) {
        case 'ecomm':
            $website_hosting_service_price = $ecomm;
            $website_hosting_select_logic = 'ecomm';
            $website_hosting_service_description = $website_hosting['website_hosting_service_description_wpengine_custom'];
            break;
        case 'hostmaint':
            $website_hosting_service_price = $hostmaint;
            $website_hosting_select_logic = 'hostmaint';
            $website_hosting_service_description = $website_hosting['website_hosting_service_description_maintenance_custom'];
            break;
        case 'premium':
            $website_hosting_service_price = $premium;
            $website_hosting_select_logic = 'premium';
            $website_hosting_service_description = $website_hosting['website_hosting_service_description_wpengine_custom'];
            break;
        case 'hostreport':
            $website_hosting_service_price = $hostreport;
            $website_hosting_select_logic = 'hostreport';
            $website_hosting_service_description = $website_hosting['website_hosting_service_description_reports_custom'];
            break;
        case 'webonly':
            $website_hosting_service_price = $webonly;
            $website_hosting_select_logic = 'webonly';
            $website_hosting_service_description = $website_hosting['website_hosting_service_description_savvis_custom'];
            break;
        case 'nohost':
            $website_hosting_service_price = 0;
            $website_hosting_select_logic = 'nohost';
            $website_hosting_service_description = '';
        default:
            break;
        }
    } else {
        $website_hosting_service_price = 0;
        $website_hosting_select_logic = 'nohost';
        $website_hosting_service_description = '';
    }

    if ($email_hosting_service['value'] == 'noemail') {
        $email_hosting_service_price = 0;
    }else{
        $email_hosting_service_price = $webemail;
    }

    

    //maths - form things for extra pages and website development
    if( $project_options && in_array('develop', $project_options) ) {
    switch ($website_development_select['value']) {
        case 'ecom':
            $website_development_price = $ecom_development * $order_multiplier;
            $website_development_select_logic = 'ecom';
            $website_development_description = $website_development['ecom_website_development_description_custom'];
            break;
        case 'base':
            $website_development_price = $web_development * $order_multiplier;
            $website_development_select_logic = 'base';
            $website_development_description = $website_development['base_website_development_description_custom'];
            break;
        case 'custom':
            $website_development_price = $custom_web_development * $order_multiplier;
            $website_development_select_logic = 'custom';
            $website_development_description = $website_development['custom_website_development_description_custom'];
            break;
        case 'transfer':
            $website_development_price = $transfer_development * $order_multiplier;
            $website_development_select_logic = 'transfer';
            $website_development_description = $website_development['transfer_website_development_description_custom'];
            break;
        case 'nodev':
            $website_development_price = 0;
            $website_development_select_logic = 'nodev';
            $website_development_description = '';
        default:
            break;
        }
    } else {
            $website_development_price = 0;
            $website_development_select_logic = 'nodev';
            $website_development_description = '';
    }

   

    if($website_development_select['value'] != 'nodev' && ($project_options && in_array('develop', $project_options))) {
    if($total_page_quantity <= $included_pages) {
        $website_development_total = $website_development_price;
    }
    if($total_page_quantity <= ($included_pages + $page_tier_one) && $total_page_quantity > $included_pages) {
        $website_development_total = $website_development_price + ($additional_pages * $page_tier_one_price);
    }
    if($total_page_quantity <= ($included_pages + $page_tier_two) && $total_page_quantity > ($included_pages + $page_tier_one)) {
        $website_development_total = $website_development_price + ($additional_pages * $page_tier_two_price);
    }
    if($total_page_quantity > ($included_pages + $page_tier_two)){
        $website_development_total = $website_development_price + ($additional_pages * $page_tier_three_price);
    }
}else{
    $website_development_total = 0;
}

    //maths for seo stuffs
if($project_options && in_array('seo', $project_options)) {
    switch ($seo_content_choice['value']) {
        case 'no_content':
            $seo_content_price = $seo_no_content;
            $seo_conent_select_logic = 'no_content';
            $seo_content_description = $seo['seo_no_content_description'];
            $seo = 0;
            break;
        case 'five_pages':
            $seo_content_price = $seo_five_pages * $order_multiplier;
            $seo_conent_select_logic = 'five_pages';
            $seo_content_description = $seo['seo_five_pages_description'];
            $seo = 1;
            break;
        case 'ten_pages':
            $seo_content_price = $seo_ten_pages * $order_multiplier;
            $seo_conent_select_logic = 'ten_pages';
            $seo_content_description = $seo['seo_ten_pages_description'];
            $seo = 1;
            break;
        default:
            break;
    }
}else{
    $seo_conent_select_logic = 'no_content';
    $seo_content_price = $seo_no_content;
    $seo_content_description = $seo['seo_no_content_description'];
    $seo = 0;
}

    //can't remember why I did this
    // if($website_development_select['value']=='base') {$base_website_development = 1; $ecom_development = 0; $transfer_website_development = 0; $quantity_seo = 1;}
    // if($website_development_select['value']=='ecom') {$ecom_development = 1; $base_website_development = 0; $transfer_website_development = 0; $quantity_seo = 1;}
    // if($website_development_select['value']=='transfer') {$ecom_development = 0; $base_website_development = 0; $transfer_website_development = 1; $quantity_seo = 0;}

    //maths for additional development hours
    $consult = get_field('consulting_repeater');
    $consult_section_title_custom = get_field('consult_section_title_custom');
    $custom_consult_section_title_select = get_field('custom_consult_section_title_select');
    if( !empty($consult) && $additional_hours_select == 'hourly' && $project_options && in_array('consult', $project_options ) ){
                $additional_hours_sub_totals = [];
                // check if the repeater field has rows of data
                if( have_rows('consulting_repeater') ):

                    // loop through the rows of data
                    while ( have_rows('consulting_repeater') ) : the_row();
                    $additional_sub_total = get_sub_field('additional_hourly_website_development_hours') * $additional_hours_price;
                    // echo $sub_total . '<br>';
                    $additional_hours_sub_totals[] = $additional_sub_total;

                        // display a sub field value
                        

                    endwhile;
                $additional_hours_total = array_sum($additional_hours_sub_totals);
                else :

                // $additional_hours_total = 0;
                    // no rows found

                endif;              
    }

    // var_dump($additional_hours_sub_totals);
    // echo $additional_hours_total;

    // if($additional_hours_select == 'hourly'){
    //     $additional_hours_total = $additional_hours_quantity * $additional_hours_price;
    //     $additional_hours_description = $website_development['additional_hourly_development_description_custom'];
    //     $quantity_hours = 1;
    // }
    if($additional_hours_select == 'none' || ($project_options && !in_array('consult', $project_options))){
        $additional_hours_total = 0;
        $quantity_hours = 0;
    } else {
        $quantity_hours = 1;
    }

    //maths for credits
    if($project_options && in_array('credit', $project_options) ){
                $credit_sub_totals = [];
                $quantity_credit = 1;
                // check if the repeater field has rows of data
                if( have_rows('credits') ):

                    // loop through the rows of data
                    while ( have_rows('credits') ) : the_row();
                    $credit_sub_total = get_sub_field('credit_amount');
                    // echo $credit_sub_total . '<br>';
                    $credit_sub_totals[] = $credit_sub_total;

                        // display a sub field value
                        

                    endwhile;
                $credit_total = array_sum($credit_sub_totals);
                else :

                    // no rows found

                endif;              
    } else {
        $credit_total = 0;
        $quantity_credit = 0;
    }

    // var_dump($credit_sub_totals);
    // echo $credit_total;

    // price calculations
    if($custom_features['custom_post'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('cpt', $custom_options)) || (empty($custom_options)) ) {
        $custom_post_total = 0;
        $cpt = 0;
    }
    else {
        $custom_post_total = roundUpToAny(($custom_post_base + ($quantity_cpt * $individual_custom_post)) * $order_multiplier);
        $cpt = 1;
    }

    if($custom_features['dynamic_portfolio'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('portfolio', $custom_options)) || (empty($custom_options)) ) {
        $dynamic_portfolio_total = 0;
        $portfolio = 0;
    }
    else {
        $dynamic_portfolio_total = roundUpToAny(($dynamic_portfolio_base + ($quantity_portfolio * $individual_portfolio)) * $order_multiplier); 
        $portfolio = 1;
    }

    if($custom_features['product_management_integration'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('product', $custom_options)) || (empty($custom_options)) ) {
        $product_management_total = 0;
        $product = 0;
    }
    else {
        $product_management_total = roundUpToAny(($product_management_base + ($quantity_products * $individual_product)) * $order_multiplier);
        $product = 1;
    }

    if($custom_features['dynamic_team'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('team', $custom_options)) || (empty($custom_options)) ) {
        $dynamic_team_total = 0;
        $team = 0;
    }
    else {
        $dynamic_team_total = roundUpToAny(($dynamic_team_base + ($quantity_team * $individual_team)) * $order_multiplier);
        $team = 1;
    }

    if($custom_features['store_locator'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('map', $custom_options)) || (empty($custom_options)) ) {
        $store_locator_total = 0;
        $map = 0;
    }
    else {$store_locator_total = roundUpToAny(($store_locator_base + ($quantity_stores * $individual_store)) * $order_multiplier);
        $map = 1;
    }

    if($custom_features['quantity_bilingual'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('bilingual', $custom_options)) || (empty($custom_options)) ) {
        $bilingual_total = 0;
        $bilingual = 0;
    }
    else {
        $bilingual_total = roundUpToAny($bilingual * $order_multiplier);
        $bilingual = 1;
    }

    if($custom_features['quantity_events_calendar'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('event', $custom_options)) || (empty($custom_options)) ) {
        $events_calendar_total = 0;
        $event = 0;
    }
    else {
        $events_calendar_total = roundUpToAny($events_calendar * $order_multiplier);
        $event = 1;
    }

    if($custom_features['quantity_search'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('search', $custom_options)) || (empty($custom_options)) ) {
        $custom_search_total = 0;
        $search = 0;
    }
    else {
        $custom_search_total = roundUpToAny($custom_search * $order_multiplier);
        $search = 1;
    }

    if($custom_features['quantity_career'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('career', $custom_options)) || (empty($custom_options)) ) {
        $career_total = 0;
        $career = 0;
    }
    else {
        $career_total = roundUpToAny($career * $order_multiplier);
        $career = 1;
    }

    if($custom_features['quantity_forms'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('form', $custom_options)) || (empty($custom_options)) ) {
        $forms_total = 0;
        $form = 0;
    }
    else {
        $forms_total = roundUpToAny($forms * $order_multiplier);
        $form = 1;
    }

    if($custom_features['quantity_logos'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('logo', $custom_options)) || (empty($custom_options)) ) {
        $logo_total = 0;
        $logo = 0;
    }
    else {
        $logo_total = roundUpToAny($logo * $order_multiplier);
        $logo = 1;
    }

    if($custom_features['quantity_wp_blog'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('wp_blog', $custom_options)) || (empty($custom_options)) ) {
        $transfer_wp_blog_total = 0;
        $wp_blog = 0;
    }
    else {
        $transfer_wp_blog_total = roundUpToAny($transfer_wp_blog * $order_multiplier);
        $wp_blog = 1;
    }

    if($custom_features['quantity_non_wp_blog'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('no_wp_blog', $custom_options)) || (empty($custom_options)) ) {
        $transfer_non_wp_blog_total = 0;
        $no_wp_blog = 0;
    }
    else {
        $transfer_non_wp_blog_total = roundUpToAny($transfer_non_wp_blog * $order_multiplier);
        $no_wp_blog = 1;
    }

    if($custom_features['quantity_video'] == '0' || ($project_options && !in_array('custom', $project_options)) || ($custom_options && !in_array('video_background', $custom_options)) || (empty($custom_options)) ) {
        $video_total = 0;
        $video_background = 0;
    }
    else {
        $video_total = roundUpToAny($video * $order_multiplier);
        $video_background = 1;
    }

    $custom_feature_total = $custom_post_total + $dynamic_portfolio_total + $product_management_total + $dynamic_team_total + $store_locator_total + $bilingual_total + $custom_search_total + $career_total + $events_calendar_total + $forms_total + $logo_total + $transfer_wp_blog_total + $transfer_non_wp_blog_total + $video_total;

    $project_total = $website_development_total + $additional_hours_total + $custom_feature_total + $seo_content_price + $credit_total;
// var_dump($custom_options);
// echo '<br>' . $dynamic_portfolio_total;
// echo '<br>' . $product_management_total;
// echo '<br>' . $dynamic_team_total;
// echo '<br>' . $store_locator_total;
// echo '<br>' . $bilingual_total;
// echo '<br>' . $custom_search_total;
// echo '<br>' . $career_total;
// echo '<br>' . $events_calendar_total;
// echo '<br>' . $forms_total;
// echo '<br>' . $logo_total;
// echo '<br>' . $transfer_wp_blog_total;
// echo '<br>' . $transfer_non_wp_blog_total;
// echo '<br>' . $video_total;

// echo $custom_feature_total;
// echo '<br>' . $website_development_total;
// echo '<br>' . $additional_hours_total;
// echo '<br>' . $seo_content_price;
// echo '<br>' . $credit_total;

    // single content

    
    if( empty($post_option['show-content']) || $post_option['show-content'] == 'enable' ){
        echo '<div class="iceberg-content-area" >';
        ?>

        <div class="top-info">
            <div class="iceberg-info">
                <div class="proposal-logo">
                    <img src="https://support.icebergwebdesign.com/wp-content/uploads/2016/09/IcebergWebDesign.png">
                </div>
                <!-- <div class="proposal-name"><h2>Iceberg Web Design</h2></div> -->
                <div class="proposal-address">203 Jackson Street<br>Suite 201<br>Anoka, MN 55303</div>
                <div class="proposal-phone">763-350-8762</div>

            </div>
            <div class="proposal-customer-info">

                <?php

                $image = get_field('company_logo');

                if( $image ) {

                    echo '<div class="proposal-logo">'; ?>
                    <img src="<?php echo $image; ?>">
                    <?php echo '</div>';

                }

                else { ?> <div class="proposal-name"><h6><?php the_field('company_name'); ?></h6></div> <?php }

                ?>

                <div class="proposal-address">
                    <?php if($company_address['street_address']) { ?> <?php echo $company_address['street_address']; ?><br> <?php } ?>
                    <?php if($company_address['address_line_2']) { ?> <?php echo $company_address['address_line_2']; ?><br> <?php } ?>
                    <?php if($company_address['city']) { ?> <?php echo $company_address['city']; ?>, <?php } ?>
                    <?php if($company_address['state']) { ?> <?php echo $company_address['state']; ?> <?php } ?>
                    <?php if($company_address['zip']) { ?> <?php echo $company_address['zip']; ?> <?php } ?>
                </div>
                <div class="proposal-phone"><?php the_field('company_phone'); ?></div>

                <div class="proposal-contact_name"><?php the_field('contact_name'); ?></div>

                <div class="proposal-contact_email"><?php the_field('contact_email'); ?></div>

            </div>
        </div>
        <div class="proposal-company-title">
            <h2>Website Development Proposal</h2><strong>for</strong>
            <div class="proposal-name"><h3><?php the_field('company_name'); ?></h3></div>
            <div class="proposal-sent"><?php echo $proposal_sent; ?><br><small><em>Proposals are valid for 30 days</em></small></div>
        </div>

         
        <!-- password protect the custom fields -->
        <?php if( !post_password_required( $post )): ?>
            <?php if( !empty($goals)  && $project_options && in_array('goals', $project_options)) { ?>
                <div class="proposal-title proposal-goal_info"><h4>Goals</h4>

                    <div class="proposal-goal">
                        <?php the_field('goals'); ?>
                    </div>
                </div>
            <?php } ?>

            <?php
                $domains = get_field('domains');
                // echo $domains; 
                ?>

            <?php if( !empty($domains) && $project_options && in_array('domain', $project_options)) { ?>
            <div class="proposal-title proposal-website_domain_info"><h4>Domain</h4>

                <div class="proposal-domain_name">
                    <?php

                        // check if the repeater field has rows of data
                        if( have_rows('domains') ):

                            // loop through the rows of data
                            while ( have_rows('domains') ) : the_row();

                                // display a sub field value
                                ?>
                                <?php if(get_sub_field('domain_ownership') == 1) { ?>
                                <div class="proposal-domain_ownership">
                                    <?php the_sub_field('domain_name'); ?><br>
                                    <small><em>Iceberg will purchase and manage this domain name for <?php the_field('company_name'); ?>. This is included in the price of hosting.</em></small>
                                </div>
                                    <?php }
                                    else { ?>
                                <div class="proposal-domain_ownership">
                                        <a href="<?php the_sub_field('domain_name'); ?>" target="_blank"><?php the_sub_field('domain_name'); ?></a><br>
                                        <small><em> <?php the_field('company_name'); ?> already owns this domain name.</em></small>
                                </div>
                                    <?php } ?>
                            <?php 
                            endwhile;

                        else :

                            // no rows found

                        endif;

                        ?>
                    
                </div>
            </div>

                        <?php } ?>

            
            <div class="proposal-project-info">
            <?php if( $project_options && in_array('host', $project_options ) ) { ?>
                    <?php if($website_hosting_service['value'] != 'nohost') { ?>
                    <div class="proposal-title proposal-website_hosting_service"><h4>Website Hosting Service</h4>

                        <div class="custom-feature"><?php echo $website_hosting_service['label']; ?>
                            <span class="proposal-price"><?php echo money_format('%n', $website_hosting_service_price); ?> / month</span>
                        </div>
                        <div class="proposal-description"><?php echo $website_hosting_service_description; ?></div>
                    <?php if ($email_hosting_service['value'] == 'email') { ?>
                        <div class="custom-feature"><?php echo $email_hosting_service['label']; ?>
                            <span class="proposal-price"><?php echo money_format('%n', $email_hosting_service_price); ?> / month</span>
                        </div>
                    <?php } ?>
                    </div>
                    <?php
                    } ?>
            <?php } ?>

            <?php if( $project_options && in_array('develop', $project_options ) ) { ?>
                    <?php if($website_development_select['value'] != 'nodev') { ?>
                    <div class="proposal-title proposal-website-development"><h4>Website Development</h4>
                        <div class="custom-feature"><?php echo $website_development_select['label']; ?>
                            <span class="proposal-price"><?php echo money_format('%n', $website_development_total); ?></span>
                        </div>
                        <?php if($website_development_select['value'] != 'transfer') { ?>
                            <div class="proposal-quantity"><?php echo $website_development['page_quantity']; ?> pages developed</div>
                            <?php
                        } ?>
                        <div class="proposal-description"><?php echo $website_development_description; ?></div>

                    </div>
                    <?php } ?>
            <?php } ?>  


            <?php 
            
            if( !empty($consult) && $additional_hours_select == 'hourly' && $project_options && in_array('consult', $project_options ) ){  ?>
            <div class="proposal-title">
                <h4>
                    <?php if(!empty($consult_section_title_custom) && $custom_consult_section_title_select == 1 ){ 
                        echo $consult_section_title_custom;
                    }else{ ?>
                        Consulting
                    <?php } ?>
                </h4></div>
            <?php
                

                // check if the repeater field has rows of data
                if( have_rows('consulting_repeater') ):

                    // loop through the rows of data
                    while ( have_rows('consulting_repeater') ) : the_row();
            
                        // display a sub field value
                        ?> 
                        <div class='custom-feature'><?php echo get_sub_field('additional_hourly_development_title_custom'); ?>
                        <?php echo '<span class="proposal-price-total">' . money_format('%n', get_sub_field('additional_hourly_website_development_hours')*$additional_hours_price) . '</span></div>'; ?>
                        <div class="proposal-description"><?php echo get_sub_field('additional_hourly_development_description_custom'); ?></div>

                        <?php 
                    endwhile;

                else :

                    // no rows found

                endif;

                ?>
            <?php
            } ?>  
            
        <?php if( $project_options && in_array('seo', $project_options ) ) { ?>
            <?php if($website_development_select['value'] != 'transfer') { ?>
              <?php if($seo_content_choice['value'] != 'no_content') { ?>
                <div class="proposal-title proposal-seo">
                    <h4>SEO Content</h4>
                <?php
                    }else{ ?>
                     <div class="proposal-title proposal-seo">
                    <h4>Content</h4>
                    <?php   
                    } ?>
                    <div class="custom-feature"><?php echo $seo_content_choice['label']; ?>
                    <?php if($seo_content_choice['value'] != 'no_content') { ?>
                        <span class="proposal-price"><?php echo money_format('%n', $seo_content_price); ?></span>
                    <?php
                    } ?>
                    </div>
                    <div class="proposal-description"><?php echo $seo_content_description; ?></div>
                </div>
                <?php
            } ?>

            <?php } ?>
        

        <?php if( $project_options && in_array('custom', $project_options ) ) { ?>
            <?php if($custom_feature_total != 0 ) { ?>
                <div class="custom-features">
                <div class="proposal-title"><h4>Custom Features</h4></div> <?php } ?>
            <?php if($custom_features['custom_post'] == 1 && ($custom_options && in_array('cpt', $custom_options )) ) { ?>
                <div class="custom-feature">Custom Section
                <?php echo '<span class="proposal-price">' . money_format('%n', $custom_post_total) . '</span></div>';
                ?>
                <div class="proposal-quantity"><?php echo $quantity_cpt; ?> Custom Sections</div>
                <div class="proposal-description"><?php echo $custom_features['custom_post_description_custom']; ?>
                </div><?php
            } ?>    
            <?php if($portfolio == 1 && ($custom_options && in_array('portfolio', $custom_options )) ) { ?>
                <div class="custom-feature">Dynamic Portfolio/Gallery
                <?php echo '<span class="proposal-price">' . money_format('%n', $dynamic_portfolio_total) . '</span></div>';
                ?>
                <div class="proposal-quantity"><?php echo $quantity_portfolio; ?> Portfolios/Galleries</div>
                <div class="proposal-description"><?php echo $custom_features['dynamic_portfolio_description_custom']; ?>
                </div><?php
            } ?>
            <?php if($custom_features['product_management_integration'] == 1 && ($custom_options && in_array('product', $custom_options )) ) { ?>
                <div class="custom-feature">Product Managment Integration
                <?php echo '<span class="proposal-price">' . money_format('%n', $product_management_total) . '</span></div>';
                ?>
                <div class="proposal-quantity"><?php echo $quantity_products; ?> Products</div>
                <div class="proposal-description"><?php echo $custom_features['product_management_description_custom']; ?>
                </div><?php
            } ?>
            <?php if($custom_features['dynamic_team'] == 1 && ($custom_options && in_array('team', $custom_options )) ) { ?>
                <div class="custom-feature">Dynamic Our Team Section
                <?php echo '<span class="proposal-price">' . money_format('%n', $dynamic_team_total) . '</span></div>';
                ?>
                <div class="proposal-quantity"><?php echo $quantity_team; ?> Individual Team Bios</div>
                <div class="proposal-description"><?php echo $custom_features['dynamic_team_description_custom']; ?>
                </div><?php
            } ?>
            <?php if($custom_features['store_locator'] == 1 && ($custom_options && in_array('map', $custom_options )) ) { ?>
                <div class='custom-feature'>Locations with Map Integration
                <?php echo '<span class="proposal-price">' . money_format('%n', $store_locator_total) . '</span></div>';
                ?>
                <div class="proposal-quantity"><?php echo $quantity_stores; ?> Locations</div>
                <div class="proposal-description"><?php echo $custom_features['store_locator_description_custom']; ?>
                </div><?php
            } ?>
            <?php if($custom_features['quantity_events_calendar'] == 1 && ($custom_options && in_array('event', $custom_options )) ) {?>
                <div class='custom-feature'>
                <?php echo 'Events with Calendar Integration';
                echo '<span class="proposal-price">' . money_format('%n', $events_calendar_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['events_calendar_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_bilingual'] == 1 && ($custom_options && in_array('bilingual', $custom_options )) ) {?>
                <div class='custom-feature'>
                <?php echo 'Bilingual Website Development';
                echo '<span class="proposal-price">' . money_format('%n', $bilingual_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['bilingual_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_search'] == 1 && ($custom_options && in_array('search', $custom_options ))) {?>
                <div class='custom-feature'>
                <?php echo 'Custom Search & Filter';
                echo '<span class="proposal-price">' . money_format('%n', $custom_search_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['custom_search_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_career'] == 1 && ($custom_options && in_array('career', $custom_options ))) {?>
                <div class='custom-feature'>
                <?php echo 'Career Section';
                echo '<span class="proposal-price">' . money_format('%n', $career_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['career_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_forms'] == 1 && ($custom_options && in_array('form', $custom_options )) ) {?>
                <div class='custom-feature'>
                <?php echo 'Custom Form Development';
                echo '<span class="proposal-price">' . money_format('%n', $forms_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['complex_forms_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_logos'] == 1 && ($custom_options && in_array('logo', $custom_options ))) {?>
                <div class='custom-feature'>
                <?php echo 'Logo Design';
                echo '<span class="proposal-price">' . money_format('%n', $logo_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['logo_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_wp_blog'] == 1 && ($custom_options && in_array('wp_blog', $custom_options )) ) {?>
                <div class='custom-feature'>
                <?php echo 'Transfer of WordPress Blog';
                echo '<span class="proposal-price">' . money_format('%n', $transfer_wp_blog_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['transfer_wp_blog_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_non_wp_blog'] == 1 && ($custom_options && in_array('no_wp_blog', $custom_options ))) {?>
                <div class='custom-feature'>
                <?php echo 'Transfer of Non-WordPress Blog';
                echo '<span class="proposal-price">' . money_format('%n', $transfer_non_wp_blog_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['transfer_non_wp_blog_description_custom']; ?></div><?php
            } ?>
            <?php if($custom_features['quantity_video'] == 1 && ($custom_options && in_array('video_background', $custom_options )) ) {?>
                <div class='custom-feature'>Video Background Support
                <?php echo '<span class="proposal-price">' . money_format('%n', $video_total) . '</span></div>';
                ?>
                <div class="proposal-description"><?php echo $custom_features['video_background_description_custom']; ?></div><?php
            } ?>

            <?php if($custom_feature_total != 0) { ?>
                <div class='custom-feature-total'><h5>Custom Features Total
                    <?php echo '<span class="proposal-price-total">' . money_format('%n', $custom_feature_total) . '</span></h5>';
                    ?>
                </div><?php
            } ?>
            </div>

             <?php } ?>
         <?php if( $project_options && in_array('credit', $project_options ) ) { ?>
            <?php if( have_rows('credits') ){ ?>
            <hr>
            <div class="proposal-title"><h4>Credits</h4></div>
            <?php

                // check if the repeater field has rows of data
                if( have_rows('credits') ):

                    // loop through the rows of data
                    while ( have_rows('credits') ) : the_row();

                        // display a sub field value
                        ?> 
                        <div class='custom-feature'><?php echo get_sub_field('credit_title'); ?>
                        <?php echo '<span class="proposal-price-total">' . money_format('%n', get_sub_field('credit_amount')) . '</span></div>'; ?>
                        <div class="proposal-description"><?php echo get_sub_field('credit_description'); ?></div>

                        <?php 
                    endwhile;

                else :

                    // no rows found

                endif;

                ?>
                <?php } ?>
            <?php } ?>
            <hr>
            <div class='project-total'><h4>Website Development Total<span class="proposal-price-total"><?php echo money_format('%n', $project_total); ?></span></h4>
            </div>

            <div class="proposal-order-form" id="order">
                <a href="/orderform-proposal/?contact_first_name=<?php urlencode(the_field('contact_first_name')); ?>&contact_last_name=<?php urlencode(the_field('contact_last_name')); ?>&company_name=<?php urlencode(the_field('company_name')); ?>&go_live_date=<?php the_field('go_live_date'); ?>&company_phone=<?php the_field('company_phone'); ?>&contact_email=<?php the_field('contact_email'); ?>&domain_name=<?php echo the_field('domain_name'); ?>&domain_ownership=<?php the_field('domain_ownership'); ?>&street_address=<?php echo urlencode($company_address['street_address']); ?>&address_line_2=<?php echo urlencode($company_address['address_line_2']); ?>&city=<?php echo urlencode($company_address['city']); ?>&state=<?php echo urlencode($company_address['state']); ?>&zip=<?php echo urlencode($company_address['zip']); ?>&website_hosting_service=<?php echo $website_hosting_service['label']; ?>&downpayment_percent=<?php echo $downpayment_percent; ?>&website_hosting_service_price=<?php echo money_format('%n', $website_hosting_service_price); ?>&website_hosting_select_logic=<?php echo $website_hosting_select_logic; ?>&email_hosting_service=<?php echo $email_hosting_service['label']; ?>&email_hosting_select_logic=<?php echo $email_hosting_service['value']; ?>&email_hosting_service_price=<?php echo money_format('%n', $email_hosting_service_price); ?>&website_development_select=<?php echo $website_development_select['label'] ?>&website_development_select_logic=<?php echo $website_development_select_logic; ?>&website_development_price=<?php echo money_format('%n', $website_development_price); ?>&additional_hours_price=<?php echo $additional_hours_price ?>&total_page_quantity=<?php echo $website_development['page_quantity']; ?>&website_development_total=<?php echo money_format('%n', $website_development_total); ?>&quantity_credit=<?php echo $quantity_credit; ?>&credit_total=<?php echo $credit_total; ?>&additional_hours_total=<?php echo money_format('%n', $additional_hours_total); ?>&quantity_additional_hours=<?php echo $quantity_hours; ?>&quantity_seo=<?php echo $seo; ?>&seo_conent_select_logic=<?php echo $seo_conent_select_logic; ?>&seo_content=<?php echo $seo_content_choice['label']; ?>&seo_content_price=<?php echo money_format('%n', $seo_content_price); ?>&dynamic_portfolio=<?php echo $portfolio; ?>&dynamic_portfolio_total=<?php echo $dynamic_portfolio_total; ?>&product_management=<?php echo $product; ?>&product_management_total=<?php echo $product_management_total; ?>&quantity_products=<?php echo $custom_features['quantity_products']; ?>&store_locator=<?php echo $map; ?>&store_locator_total=<?php echo $store_locator_total; ?>&quantity_portfolio=<?php echo $custom_features['quantity_portfolio']; ?>&quantity_stores=<?php echo $custom_features['quantity_stores']; ?>&additional_features=<?php the_field('additional_features'); ?>&quantity_bilingual=<?php echo $bilingual; ?>&bilingual_total=<?php echo $bilingual_total; ?>&dynamic_team=<?php echo $team; ?>&dynamic_team_total=<?php echo $dynamic_team_total; ?>&quantity_team=<?php echo $quantity_team; ?>&quantity_events_calendar=<?php echo $event; ?>&events_calendar=<?php echo $events_calendar_total; ?>&quantity_search=<?php echo $search; ?>&custom_search_total=<?php echo $custom_search_total; ?>&quantity_forms=<?php echo $form; ?>&forms_total=<?php echo $forms_total; ?>&quantity_logos=<?php echo $logo; ?>&logo_total=<?php echo $logo_total; ?>&quantity_wp_blog=<?php echo $wp_blog; ?>&transfer_wp_blog_total=<?php echo $transfer_wp_blog_total; ?>&quantity_non_wp_blog=<?php echo $no_wp_blog; ?>&transfer_non_wp_blog_total=<?php echo $transfer_non_wp_blog_total; ?>&quantity_video=<?php echo $video_background; ?>&video_total=<?php echo $video_total; ?>&custom_feature_total=<?php echo money_format('%n', $custom_feature_total); ?>&project_total=<?php echo $project_total; ?>&order_multiplier=<?php the_field('order_multiplier'); ?>&proposal_sent=<?php the_field('proposal_sent'); ?>&sales_email=<?php echo $sales_email; ?>&prop_link=<?php the_permalink(); ?>&proposal_id=<?php echo $post_ID; ?>&quantity_cpt=<?php echo $quantity_cpt; ?>&cpt=<?php echo $cpt; ?>&custom_post_total=<?php echo $custom_post_total; ?>&quantity_career=<?php echo $career; ?>&career_total=<?php echo $career_total; ?>" target="_blank">Start Your Project</a>
            </div>

            <div style="padding-top: 10px; float: right;"><?php echo do_shortcode('[print-me title="Print Proposal" printstyle="false" do_not_print=".proposal-order-form, .printomatictext"]'); ?></div>

            <div class="additional-costs">
          
            <?php the_field('proposal_terms_conditions', 'option'); ?>

            </div>

            <div style="padding-top: 10px; float: right;"><?php echo do_shortcode('[print-me do_not_print=".proposal-price, .proposal-order-form, .monthly, .custom-feature-total, .project-total, .printomatictext"]'); ?></div>

        <?php endif; ?>
        <?php
        if( in_array(get_post_format(), array('aside', 'quote', 'link')) ){
            get_template_part('content/content', get_post_format());
        }else{
            get_template_part('content/content', 'single');
        }
        echo '</div>';

        if( !post_password_required() ){
            if( $sidebar_type != 'none' ){
                do_action('iwd_core_print_page_builder');
            }else{
                ob_start();
                do_action('iwd_core_print_page_builder');
                $pb_content = ob_get_contents();
                ob_end_clean();

                if( !empty($pb_content) ){
                    echo '</div>'; // iceberg-content-area
                    echo '</div>'; // iceberg_get_sidebar_class
                    echo '</div>'; // iceberg_get_sidebar_wrap_class
                    echo '</div>'; // iceberg_content_container
                    echo iwd_core_escape_content($pb_content);
                    echo '<div class="iceberg-bottom-page-builder-container iceberg-container" >'; // iceberg-content-area
                    echo '<div class="iceberg-bottom-page-builder-sidebar-wrap iceberg-sidebar-style-none" >'; // iceberg_get_sidebar_class
                    echo '<div class="iceberg-bottom-page-builder-sidebar-class" >'; // iceberg_get_sidebar_wrap_class
                    echo '<div class="iceberg-bottom-page-builder-content iceberg-item-pdlr" >'; // iceberg_content_container
                }
            }
        }
    }else{
        do_action('iwd_core_print_page_builder');
    }

    // social share
    if( iceberg_get_option('general', 'blog-social-share', 'enable') == 'enable' ){
        if( class_exists('iwd_core_pb_element_social_share') ){
            $share_count = (iceberg_get_option('general', 'blog-social-share-count', 'enable') == 'enable')? 'counter': 'none';

            echo '<div class="iceberg-single-social-share iceberg-item-rvpdlr" >';
            echo iwd_core_pb_element_social_share::get_content(array(
                'social-head' => $share_count,
                'layout'=>'left-text',
                'text-align'=>'center',
                'facebook'=>iceberg_get_option('general', 'blog-social-facebook', 'enable'),
                'linkedin'=>iceberg_get_option('general', 'blog-social-linkedin', 'enable'),
                'google-plus'=>iceberg_get_option('general', 'blog-social-google-plus', 'enable'),
                'pinterest'=>iceberg_get_option('general', 'blog-social-pinterest', 'enable'),
                'stumbleupon'=>iceberg_get_option('general', 'blog-social-stumbleupon', 'enable'),
                'twitter'=>iceberg_get_option('general', 'blog-social-twitter', 'enable'),
                'email'=>iceberg_get_option('general', 'blog-social-email', 'enable'),
                'padding-bottom'=>'0px'
            ));
            echo '</div>';
        }
    }

    // author section
    if( iceberg_get_option('general', 'blog-author', 'enable') == 'enable' ){
        echo '<div class="clear"></div>';
        echo '<div class="iceberg-single-author" >';
        echo '<div class="iceberg-single-author-wrap" >';
        echo '<div class="iceberg-single-author-avartar iceberg-media-image">' . get_avatar(get_the_author_meta('ID'), 90) . '</div>';

        echo '<div class="iceberg-single-author-content-wrap" >';
        echo '<div class="iceberg-single-author-caption iceberg-info-font" >' . esc_html__('About the author', 'iceberg') . '</div>';
        echo '<h4 class="iceberg-single-author-title">';
        the_author_posts_link();
        echo '</h4>';

        $author_desc = get_the_author_meta('description');
        if( !empty($author_desc) ){
            echo '<div class="iceberg-single-author-description" >' . iwd_core_text_filter($author_desc) . '</div>';
        }
        echo '</div>'; // iceberg-single-author-content-wrap
        echo '</div>'; // iceberg-single-author-wrap
        echo '</div>'; // iceberg-single-author
    }

    // prev - next post navigation
    if( iceberg_get_option('general', 'blog-navigation', 'enable') == 'enable' ){
        $prev_post = get_previous_post_link(
            '<span class="iceberg-single-nav iceberg-single-nav-left">%link</span>',
            '<i class="arrow_left" ></i><span class="iceberg-text" >' . esc_html__( 'Prev', 'iceberg' ) . '</span>'
        );
        $next_post = get_next_post_link(
            '<span class="iceberg-single-nav iceberg-single-nav-right">%link</span>',
            '<span class="iceberg-text" >' . esc_html__( 'Next', 'iceberg' ) . '</span><i class="arrow_right" ></i>'
        );
        if( !empty($prev_post) || !empty($next_post) ){
            echo '<div class="iceberg-single-nav-area clearfix" >' . $prev_post . $next_post . '</div>';
        }
    }

    // comments template
    if( comments_open() || get_comments_number() ){
        comments_template();
    }

    echo '</div>'; // iceberg-content-area
    echo '</div>'; // iceberg-get-sidebar-class

    // sidebar left
    if( $sidebar_type == 'left' || $sidebar_type == 'both' ){
        echo iceberg_get_sidebar($sidebar_type, 'left', $sidebar_left);
    }

    // sidebar right
    if( $sidebar_type == 'right' || $sidebar_type == 'both' ){
        echo iceberg_get_sidebar($sidebar_type, 'right', $sidebar_right);
    }

    echo '</div>'; // iceberg-get-sidebar-wrap-class
    echo '</div>'; // iceberg-content-container

if( !post_password_required( $post )): ?>
                <div class="iceberg_fixedbar">
                    <div class="iceberg_boxfloat">
 
                        <div id="ice_button">
                            <div id="ice_phone"><div id="ice_logo"><img src="/wp-content/uploads/2016/09/Iceberg_White.png"></div><div id="ice_phone_number"><a href="tel:763-350-8762">Questions? Call 763-350-8762</a></div></div>
                            <div id="ice_form"><a href="/orderform-proposal/?contact_first_name=<?php urlencode(the_field('contact_first_name')); ?>&contact_last_name=<?php urlencode(the_field('contact_last_name')); ?>&company_name=<?php urlencode(the_field('company_name')); ?>&go_live_date=<?php the_field('go_live_date'); ?>&company_phone=<?php the_field('company_phone'); ?>&contact_email=<?php the_field('contact_email'); ?>&domain_name=<?php echo the_field('domain_name'); ?>&domain_ownership=<?php the_field('domain_ownership'); ?>&street_address=<?php echo urlencode($company_address['street_address']); ?>&address_line_2=<?php echo urlencode($company_address['address_line_2']); ?>&city=<?php echo urlencode($company_address['city']); ?>&state=<?php echo urlencode($company_address['state']); ?>&zip=<?php echo urlencode($company_address['zip']); ?>&website_hosting_service=<?php echo $website_hosting_service['label']; ?>&downpayment_percent=<?php echo $downpayment_percent; ?>&website_hosting_service_price=<?php echo money_format('%n', $website_hosting_service_price); ?>&website_hosting_select_logic=<?php echo $website_hosting_select_logic; ?>&email_hosting_service=<?php echo $email_hosting_service['label']; ?>&email_hosting_select_logic=<?php echo $email_hosting_service['value']; ?>&email_hosting_service_price=<?php echo money_format('%n', $email_hosting_service_price); ?>&website_development_select=<?php echo $website_development_select['label'] ?>&website_development_select_logic=<?php echo $website_development_select_logic; ?>&website_development_price=<?php echo money_format('%n', $website_development_price); ?>&additional_hours_price=<?php echo $additional_hours_price ?>&total_page_quantity=<?php echo $website_development['page_quantity']; ?>&website_development_total=<?php echo money_format('%n', $website_development_total); ?>&quantity_credit=<?php echo $quantity_credit; ?>&credit_total=<?php echo $credit_total; ?>&additional_hours_total=<?php echo money_format('%n', $additional_hours_total); ?>&quantity_additional_hours=<?php echo $quantity_hours; ?>&quantity_seo=<?php echo $seo; ?>&seo_conent_select_logic=<?php echo $seo_conent_select_logic; ?>&seo_content=<?php echo $seo_content_choice['label']; ?>&seo_content_price=<?php echo money_format('%n', $seo_content_price); ?>&dynamic_portfolio=<?php echo $portfolio; ?>&dynamic_portfolio_total=<?php echo $dynamic_portfolio_total; ?>&product_management=<?php echo $product; ?>&product_management_total=<?php echo $product_management_total; ?>&quantity_products=<?php echo $custom_features['quantity_products']; ?>&store_locator=<?php echo $map; ?>&store_locator_total=<?php echo $store_locator_total; ?>&quantity_portfolio=<?php echo $custom_features['quantity_portfolio']; ?>&quantity_stores=<?php echo $custom_features['quantity_stores']; ?>&additional_features=<?php the_field('additional_features'); ?>&quantity_bilingual=<?php echo $bilingual; ?>&bilingual_total=<?php echo $bilingual_total; ?>&dynamic_team=<?php echo $team; ?>&dynamic_team_total=<?php echo $dynamic_team_total; ?>&quantity_team=<?php echo $quantity_team; ?>&quantity_events_calendar=<?php echo $event; ?>&events_calendar=<?php echo $events_calendar_total; ?>&quantity_search=<?php echo $search; ?>&custom_search_total=<?php echo $custom_search_total; ?>&quantity_forms=<?php echo $form; ?>&forms_total=<?php echo $forms_total; ?>&quantity_logos=<?php echo $logo; ?>&logo_total=<?php echo $logo_total; ?>&quantity_wp_blog=<?php echo $wp_blog; ?>&transfer_wp_blog_total=<?php echo $transfer_wp_blog_total; ?>&quantity_non_wp_blog=<?php echo $no_wp_blog; ?>&transfer_non_wp_blog_total=<?php echo $transfer_non_wp_blog_total; ?>&quantity_video=<?php echo $video_background; ?>&video_total=<?php echo $video_total; ?>&custom_feature_total=<?php echo money_format('%n', $custom_feature_total); ?>&project_total=<?php echo $project_total; ?>&order_multiplier=<?php the_field('order_multiplier'); ?>&proposal_sent=<?php the_field('proposal_sent'); ?>&sales_email=<?php echo $sales_email; ?>&prop_link=<?php the_permalink(); ?>&proposal_id=<?php echo $post_ID; ?>&quantity_cpt=<?php echo $quantity_cpt; ?>&cpt=<?php echo $cpt; ?>&custom_post_total=<?php echo $custom_post_total; ?>&quantity_career=<?php echo $career; ?>&career_total=<?php echo $career_total; ?>" target="_blank">Start Your Project</a></div>
                        </div>

                    </div>
                </div>

<?php endif;

} }// while

}

get_footer('proposal'); ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $(window).scroll(function() {
        ($(document).scrollTop() + $(window).height()) / $(document).height() > 0.60 ? $('.iceberg_fixedbar').fadeIn() : $('.iceberg_fixedbar').fadeOut();
    });
})
</script>
<?php ?>