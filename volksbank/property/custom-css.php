body {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'bo_text_color'), '#454545' ); ?>; }

<?php 
$data = get_option('bo_options');
$bbg = isset( $data['colors5']['bo_body_bgcolor'] ) ? $data['colors5']['bo_body_bgcolor'] : null; 
$cbi = isset( $data['colors5']['bo_body_img'] ) ? $data['colors5']['bo_body_img'] : null; 
$repeat = AdminPageFramework::getOption( 'bo_options', array( 'colors5', 'bo_body_img_repeat'), 'repeat' );
if($cbi !='') { ?> 

body { height:100%; background-image: url(<?php echo $cbi; ?>); background-repeat: <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors5', 'bo_body_img_repeat'), 'no-repeat' ); ?>; }
<?php } ?>

<?php if($repeat == 'no-repeat') { ?>
body {-webkit-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
    background-size: 100% 100%; 
    background-attachment: fixed;}
<?php } ?>

<?php if($bbg !='') { ?> 

body { background-color:<?php echo $bbg; ?>; }
<?php } ?>

#header {background-color: <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_headerbg_color'), '#454545' ); ?>;}



<?php 
$color = AdminPageFramework::getOption( 'bo_options', array( 'colors5', 'bo_page_color'), '#ffffff' );
$op = AdminPageFramework::getOption( 'bo_options', array( 'colors5', 'bo_page_trans'), '0.1' );
$rgb = hex2rgba($color);
$rgba = hex2rgba($color, $op);

?>
#page {background:<?php echo $rgba; ?>;	}



<?php if($op == '0.1') { ?>
#page { padding:10px 20px;}
<?php } else { ?>
#page { padding:20px 20px;}
<?php } ?>

h1, h1 a {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline_color'), '#454545' ); ?>;}
h2, h2 a {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline2_color'), '#454545' ); ?>;}
h3, h3 a {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline3_color'), '#454545' ); ?>;}


.boxcontent h3 a {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline3_color'), '#454545' ); ?>;}

.logotitle {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'logotitle_color'), '#eeeeee' ); ?>;}
.logotitle a {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'logotitle_color'), '#eeeeee' ); ?>;}
.logosubtitle { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'logosubtitle_color'), '#eeeeee' ); ?>; }
.sidebartitle { background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_sidebar_title'), '#00A8BF' ); ?>; }
.related-title {color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline3_color'), '#454545' ); ?>; border-bottom:1px solid <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'headline3_color'), '#454545' ); ?>;}


#main-menu { border-top:1px solid <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_border_color'), '#454545' ); ?>; border-bottom:1px solid <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_border_color'), '#454545' ); ?>;  }
.nav a {  color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_color'), '#454545' ); ?>;}
.nav li:hover > a {background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>; color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_current_menu_color'), '#ffffff' ); ?>;}

#tabContainer ul#tabitems li a.active 
{background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>;
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>', endColorstr='<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>',GradientType=1 );
border:1px solid <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>; border-radius:3px;}

.nav li.current-menu-item a, .nav li.current-menu-parent a, .nav li.current_page_parent a { background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>; color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_current_menu_color'), '#ffffff' ); ?>;}
.nav li.current-menu-item ul li a, .nav li.current-menu-parent ul li a, .nav li.current_page_parent ul li a, .nav li ul li.current-menu-item a, .nav li ul li.current-menu-item a, .nav li ul li.current_page_parent a { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_color'), '#454545' ); ?>;}

.nav li  ul { border:1px solid <?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_border_color'), '#454545' ); ?>; border-top:none;  }
.nav li  ul { background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_submenu_bg_color'), '#ffffff' ); ?>;   }
.nav li ul li a { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_submenu_color'), '#454545' ); ?>;   }

.nav li ul li a:hover {  color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors2', 'bo_menu_bg_color'), '#454545' ); ?>; }

.topmenu  ul li a { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors6', 'bo_topmenu_color'), '#ebebeb' ); ?>; }
.topmenu  ul li a:hover { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors6', 'bo_topmenu_hover_color'), '#ffffff' ); ?>; }


a, a.more-button, a.more, .post-nav a:hover, input.psbutton, .cycle-pager .pager-bullets span.cycle-pager-active, #content .sidebarbox ul li a:hover, .contactform button:hover,
#content .sidebarbox li.current-menu-item a, #content .sidebarbox li.current-cat a, .blog-list-entry h3 a:hover, .prop-all-data td.showmore, input#searchinput, .footermenu ul li a:hover, .tagcloudbox a:hover, .widget_tag_cloud a:hover, .prop-info ul li a:hover { color:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'bo_link_color'), '#00A8BF' ); ?>;}
.post-nav .current { background:<?php echo AdminPageFramework::getOption( 'bo_options', array( 'colors', 'bo_link_color'), '#00A8BF' ); ?>;}

i {color:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_icon_color'), '#999999' ); ?>; }
i:hover {color:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_icon_hover_color'), '#00A8BF' ); ?>;}

.smicons span {background:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_sm_color'), '#999999' ); ?>; } 
.smicons span:hover {background:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors3', 'bo_sm_hover_color'), '#00A8BF' ); ?>; } 
.smicons i { color:#fff;}


.page-entry .boxcontent a.boxbutton, #pager a.cycle-pager-active, .pager-bullets .cycle-pager-active, #infoboxen a.boxbutton, #infoboxen2 a.boxbutton, .service-list-box a.more, .homebox a.more, .prop-price a.details, .propbox a.boxbutton, .prop-info ul li.list-requestbutton, .propbox .prop-price a.details { background:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors4', 'bo_button_bg_color'), '#00A8BF' ); ?>;}

.page-entry .boxcontent a.boxbutton:hover, #infoboxen a.boxbutton:hover, #infoboxen .boxcontent:hover a.boxbutton, #infoboxen2 a.boxbutton:hover, #infoboxen2 .boxcontent:hover a.boxbutton, .service-list-box a.more:hover, .homebox a.more:hover, .propbox:hover .prop-price a.details, .propbox a.boxbutton:hover, .boxcontent:hover a.boxbutton, .prop-info ul li.list-requestbutton:hover, .propbox:hover .prop-price a.details { background:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors4', 'bo_button_bg_hcolor'), '#454545' ); ?>;}


.page-entry .boxcontent a.boxbutton, .service-list-box a.more, .homebox a.more, .prop-price a.details, .propbox a.boxbutton, .prop-info ul li.list-requestbutton input, .propbox .prop-price a.details,
.service-list-box a.more:hover, .homebox a.more:hover, .propbox:hover .prop-price a.details, a.boxbutton:hover, .boxcontent:hover a.boxbutton, .prop-info ul li.list-requestbutton input:hover, .propbox:hover .prop-price a.details { color:<?php echo  AdminPageFramework::getOption( 'bo_options', array( 'colors4', 'bo_button_color'), '#ffffff' ); ?>;}



@media screen and (max-width: 641px) {

#main-menu {  border:none !important;  }
.nav li a, .nav li ul li a { color:#eee; }
.nav li ul { border:none !important;}
.nav li.current-menu-item a, .nav li.current-menu-parent a, .nav li.current_page_parent a { color:#fff;}
.nav li.current-menu-item ul li a, .nav li.current-menu-parent ul li a, .nav li.current_page_parent ul li a { color:#eee; }
.nav li ul li.current-menu-item a, .nav li ul li.current-menu-item a, .nav li ul li.current_page_parent a { color:#fff;  }
.nav li ul li a:hover {  color:#fff; padding-left:3px;}
}




<?php // =========================== custom code ============ // ?>


<?php if(get_option('bo_code')) { ?>
<?php echo get_option('bo_code') ?>
<?php } ?>
