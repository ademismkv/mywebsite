<?php get_header(); ?>

<main id="terminal">
    <div class="terminal-header">
        <p>Error: 404 - Page Not Found</p>
    </div>

    <div class="content">
        <div class="command-line">
            <span class="prompt">guest@portfolio:~$ </span>
            <span class="command-line-text">echo $PAGE_STATUS</span>
        </div>
        <div class="post-content" style="display: none;">
        <p>bash: page not found. Try searching for something else or return to <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a>.</p>
        </div>
    </div>

    <div class="command-line"><span class="cursor"></span></div>
</main>

<?php get_footer(); ?>
