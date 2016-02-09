<?php
/**
 * Event List Widget: Standard List
 *
 * The template is used for displaying the [eo_event] shortcode *unless* it is wrapped around a placeholder: e.g. [eo_event] {placeholder} [/eo_event].
 *
 * You can use this to edit how the output of the eo_event shortcode. See http://docs.wp-event-organiser.com/shortcodes/events-list
 * For the event list widget see widget-event-list.php
 *
 * For a list of available functions (outputting dates, venue details etc) see http://codex.wp-event-organiser.com/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://docs.wp-event-organiser.com/theme-integration for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.7
 */
global $eo_event_loop, $eo_event_loop_args;

//Date % Time format for events
$date_format = get_option('date_format');
$time_format = get_option('time_format');

//The list ID / classes
$id = ($eo_event_loop_args['id'] ? 'id="' . $eo_event_loop_args['id'] . '"' : '');
$classes = $eo_event_loop_args['class'];

?>

<?php if ($eo_event_loop->have_posts()): ?>

    <div <?php echo $id; ?> class="<?php echo esc_attr($classes); ?> event-list">

        <?php while ($eo_event_loop->have_posts()): $eo_event_loop->the_post(); ?>

            <?php
            //Generate HTML classes for this event
            $eo_event_classes = eo_get_event_classes();

            //For non-all-day events, include time format
            $format = (eo_is_all_day() ? $date_format : $date_format . ' ' . $time_format);

            $event_venue = eo_get_venue_address();

            $event_content = get_the_content();
            ?>
            <div class="event-list__event">
                <dl class="event">
                    <dt class="<?php echo esc_attr(implode(' ', $eo_event_classes)); ?> event__header">
                    <h4 class="event__title">
                        <?php if ($event_content != '') : ?>
                        <a class="event__link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <?php else : ?>
                        <span class="event__link--false"><?php the_title(); ?></span>
                    <?php endif; ?>
                    </h4>
                    </dt>
                    <dd class="event__description">
                        <span class="event__date"><?php echo eo_get_the_start($format); ?></span>
                        <?php if (get_the_excerpt() != '') : ?>
                            <div class="event__excerpt">
                                <?php echo get_the_excerpt(); ?>
                            </div>
                            <?php if ($event_content != '') : ?>
                                <div class="event__read-more">
                                     <a class="event__more-link">Read More &hellip;</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($event_venue['address'] != '') : ?>
                            <div class="event__address">
                                <span>Location: </span>
                                <address>
                                    <?php echo (null !== eo_get_venue_name()) ? eo_get_venue_name() . ', ' : ''; ?>
                                    <?php echo isset($event_venue['address']) ? $event_venue['address'] . ', ' : ''; ?>
                                    <?php echo isset($event_venue['city']) ? $event_venue['city'] . ', ' : '' ?>
                                    <?php echo isset($event_venue['postcode']) ? $event_venue['postcode'] : ''; ?>
                                </address>
                            </div>
                            <div class="event__map">
                                <div class="event__control">
                                    <button class="btn--toggle-map" data-state="off"><span class="btn--toggle-map__show">View Map</span><span class="btn--toggle-map__hide">Hide Map</span></button>
                                </div>
                                <div class="event__map-container" data-state="off">
                                    <?php echo eo_get_venue_map(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </dd>
                </dl>
            </div>

        <?php endwhile; ?>

    </div>

<?php elseif (!empty($eo_event_loop_args['no_events'])): ?>

    <ul id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <li class="eo-no-events"> <?php echo $eo_event_loop_args['no_events']; ?> </li>
    </ul>

<?php endif; ?>

