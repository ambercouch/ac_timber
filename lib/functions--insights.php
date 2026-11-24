<?php
/** Page-scoped review catalogue; no permanent content model or taxonomy. */
function act_insights_catalogue() {
    $items = array(
        'ai-costs' => array('type'=>'articles', 'title'=>'Four reasons AI translation costs more than you think', 'summary'=>'A closer look at the hidden costs of automated translation.', 'slug'=>'eine-ki-uebersetzung-ist-teurer-als-man-denkt'),
        'qualifications' => array('type'=>'articles', 'title'=>'What specialist translation qualifications mean', 'summary'=>'Understanding the expertise behind a professional translation.', 'slug'=>'qualifikationen-im-fachuebersetzen'),
        'food-markets' => array('type'=>'articles', 'title'=>'Opening new markets for food businesses', 'summary'=>'How translation can help specialist products reach a wider audience.', 'slug'=>'produkthorizonte-erweitern-wie-ubersetzungen-neue-markte-fur-ihr-unternehmen-im-lebensmittelbereich-erschliessen-konnen'),
        'translation-brief' => array('type'=>'downloads', 'title'=>'Your translation brief', 'summary'=>'A practical brief for your next translation project.', 'file'=>'2026/04/Translation-brief.pdf'),
        'case-product' => array('type'=>'case-studies', 'title'=>'Taking a specialist product to an English-speaking market', 'summary'=>'From specialist terminology to product benefits: communicating technical value across borders.', 'sample'=>true),
        'case-research' => array('type'=>'case-studies', 'title'=>'Making complex research clear', 'summary'=>'Turning specialist knowledge into accessible English for an international audience.', 'sample'=>true),
        'research-language' => array('type'=>'research', 'title'=>'How language shapes trust in scientific communication', 'summary'=>'Exploring clarity, precision and credibility in communication between scientists and their audiences.', 'sample'=>true),
        'download-checklist' => array('type'=>'downloads', 'title'=>'Scientific publication checklist', 'summary'=>'A practical checklist covering structure, terminology and clarity in an English-language manuscript.', 'sample'=>true),
    );
    foreach ($items as $key => &$item) {
        $item['key'] = $key;
        $item['sample'] = !empty($item['sample']);
        if (!empty($item['slug'])) {
            $source = get_page_by_path($item['slug'], OBJECT, 'post');
            if ($source) {
                $translated_id = apply_filters('wpml_object_id', $source->ID, 'post', true, apply_filters('wpml_current_language', null));
                $source = get_post($translated_id);
            }
            if ($source && $source->post_status === 'publish') {
                $language = apply_filters('wpml_post_language_details', null, $source->ID);
                $item['language'] = !empty($language['language_code']) ? $language['language_code'] : 'de';
                $item['language_label'] = $item['language'] === 'en' ? __('English', '_act') : __('German', '_act');
                $item['url'] = get_permalink($source);
                $item['date'] = substr($source->post_date, 0, 10);
                $item['image'] = get_the_post_thumbnail_url($source, 'medium_large');
            }
        }
        if (!empty($item['file'])) {
            $uploads = wp_upload_dir();
            if (is_file($uploads['basedir'].'/'.$item['file'])) {
                $item['url'] = $uploads['baseurl'].'/'.$item['file'];
            }
        }
    }
    unset($item);
    return $items;
}

add_action('acf/init', function() {
    $choices = array();
    foreach (act_insights_catalogue() as $key => $item) {
        $choices[$key] = $item['title'];
    }
    $fields = array(
        array(
            'key'=>'field_insights_eyebrow', 'name'=>'insights_eyebrow',
            'label'=>__('Title eyebrow', '_act'), 'type'=>'text',
            'wpml_cf_preferences'=>2,
        ),
        array(
            'key'=>'field_insights_introduction', 'name'=>'insights_introduction',
            'label'=>__('Introduction', '_act'), 'type'=>'textarea',
            'rows'=>4, 'new_lines'=>'', 'wpml_cf_preferences'=>2,
        ),
    );
    for ($slot = 1; $slot <= 3; $slot++) {
        $fields[] = array(
            'key'=>'field_insights_featured_'.$slot,
            'name'=>'insights_featured_'.$slot,
            'label'=>sprintf(__('Featured card %d', '_act'), $slot),
            'type'=>'select', 'choices'=>$choices, 'required'=>1,
            'instructions'=>__('Choose a different item for each position. Position 1 appears first.', '_act'),
            'wpml_cf_preferences'=>2,
        );
    }
    acf_add_local_field_group(array(
        'key'=>'group_insights_mockup', 'title'=>__('Insights content', '_act'),
        'fields'=>$fields,
        'location'=>array(array(array('param'=>'page_template','operator'=>'==','value'=>'page-templates/insights.php'))),
    ));
});

// Guard against duplicate selections while editing, including block-editor saves.
add_action('acf/validate_save_post', function() {
    $values = isset($_POST['acf']) && is_array($_POST['acf']) ? $_POST['acf'] : array();
    $seen = array();
    for ($slot = 1; $slot <= 3; $slot++) {
        $key = 'field_insights_featured_'.$slot;
        if (empty($values[$key])) { continue; }
        $value = sanitize_key($values[$key]);
        if (in_array($value, $seen, true)) {
            acf_add_validation_error('acf['.$key.']', __('Choose three different featured items.', '_act'));
        }
        $seen[] = $value;
    }
});
