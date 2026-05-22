<?php
/*
Template Name: Submit Game
*/
if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$current_user = wp_get_current_user();
if (
    !in_array('game_developer', (array) $current_user->roles) &&
    !in_array('administrator', (array) $current_user->roles)
) {
    wp_die('Bạn không có quyền truy cập trang này.');
}

get_header();

$categories = get_terms([
    'taxonomy'   => 'game_category',
    'hide_empty' => false,
]);
?>

<div class="container">
    <div class="page-section">
        <form method="post" enctype="multipart/form-data" class="gamestore-form">
            <?php wp_nonce_field('gamestore_submit_game_action', 'gamestore_submit_nonce'); ?>

            <h1>Gửi game mới</h1>

            <?php if (isset($_GET['submit_error']) && $_GET['submit_error'] === 'empty_required'): ?>
                <div class="form-message form-error">Vui lòng nhập đầy đủ tiêu đề và mô tả chi tiết.</div>
            <?php endif; ?>

            <?php if (isset($_GET['submit_error']) && $_GET['submit_error'] === 'insert_failed'): ?>
                <div class="form-message form-error">Gửi game thất bại. Vui lòng thử lại.</div>
            <?php endif; ?>

            <?php if (isset($_GET['submit_error']) && $_GET['submit_error'] === 'invalid_rom'): ?>
                <div class="form-message form-error">Chỉ cho phép upload file ROM có đuôi .gba, .gbc, .gb</div>
            <?php endif; ?>

            <?php if (isset($_GET['submit_error']) && $_GET['submit_error'] === 'rom_upload_failed'): ?>
                <div class="form-message form-error">Upload file ROM thất bại. Vui lòng thử lại.</div>
            <?php endif; ?>

            <div class="form-row">
                <label for="game_title">Tên game</label>
                <input type="text" name="game_title" id="game_title" required>
            </div>

            <div class="form-row">
                <label for="game_short_description">Mô tả ngắn</label>
                <textarea name="game_short_description" id="game_short_description" rows="3"></textarea>
            </div>

            <div class="form-row">
                <label for="game_description">Mô tả chi tiết</label>
                <textarea name="game_description" id="game_description" rows="8" required></textarea>
            </div>

            <div class="form-row">
                <label for="game_category">Thể loại</label>
                <select name="game_category" id="game_category">
                    <option value="">-- Chọn thể loại --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo esc_attr($category->term_id); ?>">
                            <?php echo esc_html($category->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <label for="game_rom_file">Upload ROM</label>
                <input type="file" name="game_rom_file" id="game_rom_file" accept=".gba,.gbc,.gb" required>
                <div class="form-hint">Các định dạng ROM khả dụng: .gba, .gbc, .gb</div>
            </div>

            <div class="form-row">
                <label for="game_cover">Ảnh bìa</label>
                <input type="file" name="game_cover" id="game_cover" accept="image/*">
            </div>

            <div class="form-row">
                <button type="submit" name="gamestore_submit_game" value="1">Gửi game</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>