console.log('aw colours')
jQuery(document).ready(function($) {
    if( acf.findFields({'type': 'color_picker'})) {
        console.log('aw colours colour picker')
        // custom colors
        var palette = ['#000000', '#F7EFE9', '#FFB801', '#43ADD1', '#243A25', '#F79A52' , '#CA5780'];

        // when initially loaded find existing colorpickers and set the palette
        acf.add_action('load', function() {
            $('input.wp-color-picker').each(function() {
                $(this).iris('option', 'palettes', palette);
            });
        });

        // if appended element only modify the new element's palette
        acf.add_action('append', function(el) {
            $(el).find('input.wp-color-picker').iris('option', 'palettes', palette);
        });
    }
    else{
        console.log('')
    }
});
