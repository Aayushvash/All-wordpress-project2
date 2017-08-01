<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */



get_header();

?>



<!--  / np box \ -->

<div class="npBox">



    <?php if(function_exists('bcn_display'))

    {

    bcn_display();

    }?>

    

</div>

<!--  \ np box / -->

        

<!--  / left container \ -->

<div id="leftCntr">

	

    <!--  / text box \ -->

    <div class="textBox">



		<h1 align="center"><?php _e('Error 404 - Not Found', 'kubrick'); ?></h1>



    </div>

    <!--  \ text box / -->

        

</div>

<!--  \ left container / -->



<?php get_sidebar(); ?>



<?php get_footer(); ?>

