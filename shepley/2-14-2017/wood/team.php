<?php

/**

 * Template Name: Team page

 * @subpackage Default_Theme

 */



get_header(); ?>

</div>



	<!--  \ layout / -->

 <!--  / content \ -->

<div id="content">

    	<div id="contentCn">



            <!--  / center side\ -->

            <div id="centerSide">

        

                <!--  / about bar \ -->

                <div class="aboutBar">

              

        			   <?php while (have_posts()) : the_post(); ?>

                    <h2><?php the_title(); ?></h2>

                    <?php endwhile; ?>

                    

                    		<div class="text">

                            

                               <div id="st-accordion" class="st-accordion">

                            <br /><br />

                            <h2 class="pagetitle">Please Click On a Team to view Team Members and Their Contact Information</h2>

                            <ul>

                         

                        <?php $term = get_terms( 'teamcategory', array(



                        'orderby'    => 'id',



                        'hide_empty' => 0,

						'orderby'    =>'name'



                        ) );

						$counter=1;

                        foreach($term as $term)



                        {

							?>

                            <li <?php if($counter==1) { ?> class="first" <?php } ?>>

                           

                         <?php

						$a=$term->name;

						$slug=$term->slug;

						$first=strtoupper(substr($a,0,1));

						

					

						$b=$term->term_id;                       

						?>

                         

                         

                          <a href="#" class="title"><?php echo $a; ?> 

<span class="st-arrow">Open or Close</span></a> 	

                        	

						<?php

					

						

						?>

                       <div class="teamtoogle st-content">

                       <p class="teamtooglecenter">Telephone: <?php echo get_field('telephone', 'teamcategory_'.$b); ?> &nbsp;&nbsp;&nbsp;Facsimile:  <?php echo get_field('Facsimile', 'teamcategory_'.$b); ?>  </p>

                       <?php

                       	$wpq = array( 'post_type' => 'Team', 'taxonomy' => 'teamcategory', 'term' =>$slug,'orderby' => 'title', 'order' => 'ASC' );

						$brand_posts = new WP_Query ($wpq);

						

					

						?>

						<?php if ($brand_posts->have_posts()) : while ($brand_posts->have_posts()) : $brand_posts->the_post(); ?>

						

						

						<div class="teammember">

                       <?php 

					   $direct=get_field('direct');

					   $cell=get_field('telephone_number');

					   $fax=get_field('fax');

					   $email=get_field('email');				   

					   ?>

                        <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(245,170) ); ?></a></div>

						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                        <p><?php echo get_Field('title'); ?></p>

                        <?php 

						

						if(!empty($direct)) { ?>

                        <p><strong>Direct: </strong><?php echo get_field('direct'); ?></p>

                        <?php } ?>

                        <?php if(!empty($cell)) { ?>

                        <p><strong>Cell: </strong> <?php echo get_field('telephone_number'); ?></p>

                        <?php } ?>

                         <?php if(!empty($fax)) { ?>

                        <p> <strong>Fax: </strong> <?php echo get_field('fax'); ?></p> 

                        <?php } ?>

                           <?php if(!empty($email)) { ?> 

                        <p><a href="mailto:<?php echo get_field('email'); ?>"><?php echo get_field('email'); ?></a></p>

						<?php } ?>

                        </div>

						

						

						

						<?php endwhile; 

						else: 

						echo "<p>No Employee Found In This Group</p>"; 

						endif; ?>   

                          <br clear="all" />             

						</div>

						<?php

						unset($a);

						unset($b);

                        $counting++;

						?>

                      

                      

                        <?php

					

						$counter++;

						echo "</li>";

						?>

						 <?php

                        }

						if($counting==0)

						{

							echo "<p>No Employee Found in This Group</p>";

						}



                        



                        ?>

                        </div>

                     

                            </div>

          

                </div>

                <!--  \ about bar / -->

        

            </div>

            <!--  \ center side/ -->

        

    	</div>    

	</div>

	<!--  \ content / -->

    <?php get_footer(); ?>