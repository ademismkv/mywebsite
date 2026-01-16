<?php get_header(); ?>

<main id="terminal">
    <div class="menu-nav">
        <div class="command-line">
            <span class="prompt">guest@ademismkv:~$ </span>
            <span class="command-line-text">ls -F /blog/</span>
        </div>
        <div class="post-content" style="display: none;">
            <p><a href="<?php echo esc_url(home_url('/')); ?>">[ back to main menu ]</a></p>
            <div class="blog-list" style="margin-top: 15px;">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="menu-item">
                        <span style="color: #888;">[<?php the_time('Y-m-d'); ?>]</span> 
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?>.txt</a>
                    </div>
                <?php endwhile; else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="command-line active-prompt" style="display: none;">
        <span class="prompt">guest@ademismkv:~$ </span>
        <span id="user-input" contenteditable="true" spellcheck="false"></span>
        <span class="cursor"></span>
    </div>
</main>

<?php get_footer(); ?>
