<?php get_header(); ?>

<div class="content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <?php 
                if (!get_post_meta(get_the_ID(), 'hide_title', true)) : ?>
                    <h1><?php the_title(); ?></h1>
                <?php endif; ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>