<?php get_header(); ?>

<main id="terminal">
    <div class="terminal-banner">
        <pre>
 _   _  _____  _      _      ____  
| | | || ____|| |    | |    / __ \ 
| |_| ||  _|  | |    | |   | |  | |
|  _  || |___ | |___ | |___| |__| |
|_| |_||_____||_____||_____|\____/ 
        </pre>
    </div>

    <div class="terminal-header">
        <?php
        $latest_post = get_posts(array('numberposts' => 1));
        if (!empty($latest_post)) {
            $post = $latest_post[0];
            echo '<p>Last post: <a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a> (' . get_the_date('', $post->ID) . ')</p>';
        }
        ?>
    </div>

    <div class="menu">
        <div class="command-line">
            <span class="prompt">guest@ademismkv:~$ </span>
            <span class="command-line-text">ls -F /menu/</span>
        </div>
        <div class="post-content" style="display: none;">
            <div class="menu-item"><span>[1]</span> <a href="<?php echo esc_url(home_url('/about')); ?>">about_me/</a></div>
            <div class="menu-item"><span>[2]</span> <a href="<?php echo esc_url(home_url('/portfolio-cs')); ?>">portfolio_CS/</a></div>
            <div class="menu-item"><span>[3]</span> <a href="<?php echo esc_url(home_url('/portfolio-ns-engineering')); ?>">portfolio_NS&Engineering/</a></div>
              <div class="menu-item"><span>[4]</span> <a href="<?php echo esc_url(home_url('/blog')); ?>">personal_blog/</a></div>
              <div class="menu-item"><span>[5]</span> <a href="<?php echo esc_url(home_url('/resume-10')); ?>">resume/</a></div>
          </div>
    </div>

    <div class="welcome-msg" style="margin-top: 20px;">
        <div class="command-line">
            <span class="prompt">guest@ademismkv:~$ </span>
            <span class="command-line-text">cat intro.txt</span>
        </div>
        <div class="post-content" style="display: none;">
            <p>Hi! My name is Ademi, I am undergrad at Yonsei University, interested in post punk/indie music, and poetry. You can find more about me in the links above</p>
            <p style="color: #888; font-size: 0.9em; margin-top: 10px;">// you can send me a message directly from here by typing below</p>
        </div>
    </div>

    <div class="command-line active-prompt" style="display: none;">
        <span class="prompt">guest@ademismkv:~$ </span>
        <span id="user-input" contenteditable="true" spellcheck="false"></span>
        <span class="cursor"></span>
    </div>
</main>

<?php get_footer(); ?>
