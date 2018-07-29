<?php get_header(); ?>

<?php get_template_part('partials/content', 'home'); ?>

<div class="container">
    <?php echo do_shortcode("[formularz_kontaktowy]"); ?>
</div>

<?php get_footer();