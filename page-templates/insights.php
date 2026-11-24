<?php
/** Template Name: Insights (review mock-up) */
$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['template'] = 'insights';
$context['mainMod'] = '--insights';
$context['hasSideBar'] = false;
$context['insights_eyebrow'] = get_field('insights_eyebrow', get_the_ID());
$context['insights_introduction'] = get_field('insights_introduction', get_the_ID());
$items = act_insights_catalogue();
$featured = array();
foreach (array(1, 2, 3) as $slot) {
    $key = get_field('insights_featured_'.$slot, get_the_ID());
    if (isset($items[$key])) {
        $featured[$key] = $items[$key];
    }
}
$remaining = array_diff_key($items, $featured);
usort($remaining, function($a, $b) {
    return strcmp(isset($b['date']) ? $b['date'] : '', isset($a['date']) ? $a['date'] : '');
});
$context['insights_featured'] = $featured;
$context['insights_items'] = $remaining;
$context['insights_types'] = array(
    'all'=>__('All', '_act'), 'articles'=>__('Articles', '_act'),
    'case-studies'=>__('Case Studies', '_act'), 'downloads'=>__('Downloads', '_act'),
    'research'=>__('Research', '_act'),
);
Timber::render('page-insights.twig', $context);
