<form data-state="off" role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
    <label class="search-form__accessibility" >
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?> </span>
        <input type="search" class="search-form__search-field" placeholder="<?php echo esc_attr_x('Type your search and hit return.', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>"/>
    </label>
</form>