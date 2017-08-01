<?php $data = get_option('bo_options'); 
$cur = AdminPageFramework::getOption( 'bo_options', array( 'basis4', 'bo_currency'), 'EUR' ); ?>
<table>
	 <?php if (get_post_meta($post->ID, '_boP_prop-id', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Object ID', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-id', true); ?> </td>
    </tr>
<?php } ?>
<?php if (get_post_meta($post->ID, '_boP_prop-price', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Purchase price', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price', true); echo '&nbsp;'; echo $cur; ?> </td>
    </tr>
<?php } ?>
<?php if (get_post_meta($post->ID, '_boP_prop-price6', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('House costs', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price6', true); echo '&nbsp;'; echo $cur; ?> </td>
    </tr>
<?php } ?>
<?php if (get_post_meta($post->ID, '_boP_prop-price2', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Rent', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price2', true); echo '&nbsp;'; echo $cur;  ?> </td>
    </tr>
<?php } ?>
       
<?php if (get_post_meta($post->ID, '_boP_prop-price3', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Additional costs', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price3', true); echo '&nbsp;'; echo $cur;  ?> </td>
    </tr>
<?php } ?>

  <?php if (get_post_meta($post->ID, '_boP_prop-heat-costs', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Heating costs', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-heat-costs', true) ?> </td>
    </tr>
        <?php } ?>
        
<?php if (get_post_meta($post->ID, '_boP_prop-price5', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Rent garage/carport', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price5', true); echo '&nbsp;'; echo $cur;  ?> </td>
    </tr>
<?php } ?>

<?php if (get_post_meta($post->ID, '_boP_prop-price4', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Total rent', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-price4', true); echo '&nbsp;'; echo $cur;  ?> </td>
    </tr>
<?php } ?>        
  
        
    <?php if (get_post_meta($post->ID, '_boP_prop-deposit', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Deposit', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-deposit', true) ?> </td>
    </tr>
        <?php } ?>
        
          <?php if (get_post_meta($post->ID, '_boP_prop-prov1', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Commission for tenant', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-prov1', true) ?> </td>
    </tr>
        <?php } ?>
        
         <?php if (get_post_meta($post->ID, '_boP_prop-prov2', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Commission for buyer', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-prov2', true) ?> </td>
    </tr>
        <?php } ?>
     
     
    <?php if (get_post_meta( $post->ID, '_boP_prop-rooms', true)) { ?>
 <tr>
    <td class="keys"><?php echo __('Rooms', 'bobox'); ?>:</td>
        <td><?php echo get_post_meta( $post->ID, '_boP_prop-rooms', true);  ?></td>
    </tr>
    <?php } ?>
    <?php if (get_post_meta( $post->ID, '_boP_prop-livrooms', true)) { ?>
 <tr>
    <td class="keys"><?php echo __('Bedrooms', 'bobox'); ?>:</td>
        <td><?php echo get_post_meta( $post->ID, '_boP_prop-livrooms', true);  ?></td>
    </tr>
    <?php } ?>
    
    
    <?php if (get_post_meta( $post->ID, '_boP_prop-bathrooms', true)) { ?>
 <tr>
    <td class="keys"><?php echo __('Bathrooms', 'bobox'); ?>:</td>
        <td><?php echo get_post_meta( $post->ID, '_boP_prop-bathrooms', true);  ?></td>
    </tr>
    <?php } ?> 
        <?php if (get_post_meta( $post->ID, '_boP_prop-basement-rooms', true)) { ?>
 <tr>
    <td class="keys"><?php echo __('Basement rooms', 'bobox'); ?>:</td>
        <td><?php echo get_post_meta( $post->ID, '_boP_prop-basement-rooms', true);  ?></td>
    </tr>
    <?php } ?>
        
    <?php if (get_post_meta($post->ID, '_boP_prop-size', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Living space','bobox'); ?>:</td>
             <td><?php echo get_post_meta($post->ID, '_boP_prop-size', true) ?> m&sup2;</td>
    </tr>
    <?php } ?>
       
     <?php if (get_post_meta($post->ID, '_boP_prop-size3', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Land area','bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-size3', true) ?> m&sup2;</td>
    </tr>
    <?php } ?>
    <?php if (get_post_meta($post->ID, '_boP_prop-size4', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Floorspace','bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-size4', true) ?> m&sup2;</td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-size2', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Total area','bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-size2', true) ?> m&sup2;</td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-size5', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Sales area','bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-size5', true) ?> m&sup2;</td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-level', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Floor', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-level', true) ?></td>
    </tr>
    <?php } ?>
    <?php if (get_post_meta($post->ID, '_boP_prop-level-count', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Floors', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-level-count', true) ?></td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-year', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Year of construction', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-year', true) ?></td>
    </tr>
    <?php } ?>
    
    
    <?php if (get_post_meta($post->ID, '_boP_prop-re', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Last renovation', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-re', true) ?></td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-status', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Property condition', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-status', true) ?></td>
    </tr>
    <?php } ?>
    <?php if (get_post_meta($post->ID, '_boP_prop-start', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Available from', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-start', true) ?></td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-heat-tool', true)) { ?>
     <tr>
        <td class="keys"> <?php echo __('Heating', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-heat-tool', true) ?> </td>
    </tr>
        <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-heat', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Type of heating', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-heat', true) ?> </td>
    </tr>
        <?php } ?>
        
        <?php if (get_post_meta($post->ID, '_boP_prop-eco', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Energy consumption value', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-eco', true) ?> </td>
    </tr>
        <?php } ?>
        
  <?php if (get_post_meta($post->ID, '_boP_prop-eco-mode', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Type of energy certificate', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-eco-mode', true) ?> </td>
    </tr>
        <?php } ?>   
        
      <?php if (get_post_meta($post->ID, '_boP_prop-eco-class', true)) { ?>
    <tr>
        <td class="keys"> <?php echo __('Energy efficiency class', 'bobox'); ?>: </td>
        <td><?php echo get_post_meta($post->ID, '_boP_prop-eco-class', true) ?> </td>
    </tr>
        <?php } ?>        
        
     <?php if (get_post_meta($post->ID, '_boP_prop-extras', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Miscellaneous info', 'bobox'); ?>:</td>
    <td><?php echo get_post_meta($post->ID, '_boP_prop-extras', true) ?></td>
    </tr>
    <?php } ?>
    
     <?php
$cd = get_post_meta($post->ID,"custom_data",true);
if($cd != '') { ?>


<?php
  $c = 0;
  if (count($cd) > 0){
    foreach((array)$cd as $i ){
      if (isset($i['i']) || isset($i['d'])){ ?>
<tr>
<td class="keys"><?php echo $i['d']; ?>:</td><td><?php echo $i['i']; ?></td>
</tr>
      <?php
        }
    }
  }
?>

<?php } ?>

  <?php if (get_post_meta($post->ID, '_boP_prop-lift', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Lift', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
      <?php if (get_post_meta($post->ID, '_boP_prop-access', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Wheelchair accessible', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    


 <?php if (get_post_meta($post->ID, '_boP_prop-garage', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Garage', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>


     <?php if (get_post_meta($post->ID, '_boP_prop-carport', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Carport', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    
     <?php if (get_post_meta($post->ID, '_boP_prop-garden', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Garden', 'bobox'); ?>:</td>
    <td> <i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-balkony', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Balkony', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-patio', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Patio', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-kitchen', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Kitchen', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-wc', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Guest WC', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    <?php if (get_post_meta($post->ID, '_boP_prop-basement', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Basement', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-washing', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Laundry', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
     <?php if (get_post_meta($post->ID, '_boP_prop-basement-bic', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Bicycle storage', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
     
    
     <?php if (get_post_meta($post->ID, '_boP_prop-pets', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Pets', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    
    
     <?php if (get_post_meta($post->ID, '_boP_prop-pool', true)) { ?>
    <tr>
    <td class="keys"><?php echo __('Pool', 'bobox'); ?>:</td>
    <td><i class="icon-check-1"></i></td>
    </tr>
    <?php } ?>
    
    
    <?php
$cdb = get_post_meta($post->ID,"custombox_data",true);
if($cdb != '') { ?>

<?php
  $c = 0;
  if (count($cdb) > 0){
    foreach((array)$cdb as $i ){
      if (isset($i['i']) || isset($i['d'])){ ?>
<tr>
<td class="keys"><?php echo $i['d']; ?>:</td><td><i class="icon-check-1"></i></td>
</tr>
      <?php
        }
    }
  }
?>
<?php } ?>
    
    </table>