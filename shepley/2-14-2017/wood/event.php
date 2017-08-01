<?php
/**
 * Template Name: Event Page 
 */
get_header(); ?>
<?php tribe_events_before_html() ?>
<h2 class="tribe-events-cal-title"><?php tribe_events_title(); ?></h2>
<div class="text">
<?php include(tribe_get_current_template()); ?>
<?php tribe_events_after_html() ?>
</div>
<?php get_footer(); ?>