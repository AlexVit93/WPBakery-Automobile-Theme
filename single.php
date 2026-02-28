<?php get_header(); ?>

    <div class="content">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <?php the_date(); ?> | <?php the_author(); ?>
                    </div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <?php comments_template(); ?>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>

<?php get_footer(); ?>