<?php get_header(); ?>

<main id="terminal">
    <div class="menu-nav">
        <div class="command-line">
            <span class="prompt">guest@ademismkv:~$ </span>
            <span class="command-line-text">cd /home/</span>
        </div>
        <div class="post-content" style="display: none;">
            <p><a href="<?php echo esc_url(home_url('/')); ?>">[ back to main menu ]</a></p>
        </div>
    </div>

    <div class="content" style="margin-top: 30px;">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="command-line">
                    <span class="prompt">guest@portfolio:~$ </span>
                    <span class="command-line-text">cat <?php the_title(); ?>.txt</span>
                </div>
                <div class="post-content" style="display: none;">
                    <?php the_content(); ?>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>

    <div class="command-line active-prompt" style="display: none;">
        <span class="prompt">guest@ademismkv:~$ </span>
        <span id="user-input" contenteditable="true" spellcheck="false"></span>
        <span class="cursor"></span>
    </div>
</main>

<?php get_footer(); ?>
