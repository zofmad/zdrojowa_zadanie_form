<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
        <script>
            var
                    site_url = "<?php echo site_url('/'); ?>",
                    ajax_url = "<?php echo site_url('ajax'); ?>";
        </script>
    </head>
    <body <?php body_class(); ?> >
       
