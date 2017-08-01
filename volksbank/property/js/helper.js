jQuery(document).ready(function($) {
    if( jQuery('#taxonomy-drill-down-2').length > 0 ) {

        jQuery.getScript( [chosen.js] );
        jQuery(document).find(".widget_taxonomy-drill-down select option").each(function() {
		  var $this = jQuery(this);
		  $this.html( $this.html().split('&nbsp;').join('') );
		});
		 jQuery(".widget_taxonomy-drill-down select").chosen();

    }
});