<?php
if (!defined('ABSPATH')) { exit; }
// Local-only, idempotent setup. Does not modify existing pages or menus.
$page = get_page_by_path('insights-review', OBJECT, 'page');
if (!$page) {
    $id = wp_insert_post(array('post_type'=>'page','post_status'=>'publish','post_title'=>'Insights','post_name'=>'insights-review','post_content'=>''), true);
    if (is_wp_error($id)) { throw new Exception($id->get_error_message()); }
} else {
    echo 'Page already exists; leaving its language and featured selections unchanged. ID: '.$page->ID;
    return;
}
update_post_meta($id, '_wp_page_template', 'page-templates/insights.php');
do_action('wpml_set_element_language_details', array('element_id'=>$id,'element_type'=>'post_page','trid'=>false,'language_code'=>'en','source_language_code'=>null));
foreach(array(1=>'ai-costs',2=>'translation-brief',3=>'case-product') as $slot=>$key) {
    update_field('field_insights_featured_'.$slot, $key, $id);
}
update_field('field_insights_eyebrow', 'Ideas, expertise & practical resources', $id);
update_field('field_insights_introduction', 'Explore the science of clear communication. Perspectives on specialist translation, stories from practice and resources for your next project.', $id);
echo 'Insights page ID: '.$id."\n";
do_action('wpml_switch_language', 'en');
echo get_permalink($id)."\n";
