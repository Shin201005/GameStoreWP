<?php
/*
Template Name: My Games
*/
if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

get_header();

$current_user_id = get_current_user_id();

$my_games = new WP_Query([
    'post_type'      => 'game',
    'post_status'    => ['pending', 'publish', 'draft'],
    'author'         => $current_user_id,
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<div class="container">
    <div class="page-section">
        <h1>Game của tôi</h1>

        <?php if (isset($_GET['submit_success']) && $_GET['submit_success'] === '1'): ?>
            <p>Gửi game thành công. Game đang chờ duyệt.</p>
        <?php endif; ?>

        <?php if ($my_games->have_posts()): ?>
            <div class="game-grid">
                <?php while ($my_games->have_posts()): $my_games->the_post(); ?>
                    <?php
                    $status = get_post_meta(get_the_ID(), '_gamestore_status', true);
                    if (empty($status)) {
                        if (get_post_status() === 'pending') {
                            $status = 'Pending';
                        } elseif (get_post_status() === 'publish') {
                            $status = 'Approved';
                        } else {
                            $status = 'Draft';
                        }
                    }
                    ?>
                 <a href="<?php the_permalink(); ?>" class="game-card">

                    <?php if (has_post_thumbnail()): ?>
                        <div class="game-card-thumb">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="game-card-title"><?php the_title(); ?></h3>

                    <p class="game-card-desc">
                        <?php echo esc_html(get_post_meta(get_the_ID(), '_gamestore_short_description', true)); ?>
                    </p>

                    <p class="game-card-status">
                        <strong>Trạng thái:</strong>
                        <?php echo esc_html($status); ?>
                    </p>

    <?php
    $reject_reason = get_post_meta(get_the_ID(), '_gamestore_reject_reason', true);
    if (!empty($reject_reason)):
    ?>
        <p class="game-card-reject">
            <strong>Lý do từ chối:</strong> <?php echo esc_html($reject_reason); ?>
        </p>
    <?php endif; ?>

</a>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p>Bạn chưa gửi game nào.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>