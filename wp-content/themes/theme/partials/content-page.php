
<article class="article_content page">

    <div>
        <div class="img_container">      
            <?php echo get_the_post_thumbnail(get_the_ID(), 'FULL', array('class' => 'pageMainImage', 'alt' => '')) ?>
        </div>
        <?php the_content(); ?>
       
    </div>
</article>
