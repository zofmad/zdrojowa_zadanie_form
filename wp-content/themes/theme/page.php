<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

get_header();
get_template_part('partials/content', 'header');
?>
<div class="container">

    <div class="row">
        <div class="col-xs-12 page_content <?php echo 'page_'.get_the_ID();?>">
            
             <?php
    while (have_posts()) : the_post();
        get_template_part('partials/content', 'page');
    endwhile;
    ?>


        </div>
    </div>
</div>

<?php
get_footer();