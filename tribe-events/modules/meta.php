<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

tribe_get_template_part( 'modules/meta/details' );
tribe_get_template_part( 'modules/meta/venue' );
if ( tribe_has_organizer() )
{
	tribe_get_template_part( 'modules/meta/organizer' );
}
tribe_get_template_part( 'modules/meta/map' );
?>