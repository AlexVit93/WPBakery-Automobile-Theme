<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <div class="widget">
            <p><?php esc_html_e('Add widgets here.', 'new-wp-theme'); ?></p>
        </div>
    <?php endif; ?>
</aside>