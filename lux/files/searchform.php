<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="submit" id="searchsubmit" value="" />
    <input type="text" value="Suchbegriff" onblur="if (this.value == '') {this.value = 'Suchbegriff';}" onfocus="if(this.value == 'Suchbegriff') {this.value = '';}" name="s" id="s" />    
</form>