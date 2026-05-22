<?php
/*
Template Name: Edit Game
*/
if (!defined('ABSPATH')) exit;

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$game_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$game_id || get_post_type($game_id) !== 'game') {
    wp_die('Game không hợp lệ');
}

$current_user = wp_get_current_user();
$is_owner = (int) get_post_field('post_author', $game_id) === get_current_user_id();
$is_admin = current_user_can('administrator');

if (!$is_owner && !$is_admin) {
    wp_die('Bạn không có quyền sửa game này');
}

$title = get_the_title($game_id);
$content = get_post_field('post_content', $game_id);
$short_desc = get_post_meta($game_id, '_gamestore_short_description', true);
$current_category_ids = wp_get_object_terms($game_id, 'game_category', ['fields' => 'ids']);

$categories = get_terms([
    'taxonomy'   => 'game_category',
    'hide_empty' => false,
]);

$current_rom = get_post_meta($game_id, '_gamestore_rom_path', true);

get_header();
?>

<div class="container">
    <div class="page-section">
        <form method="post" enctype="multipart/form-data" class="gamestore-form">
            <?php wp_nonce_field('gamestore_edit_game', 'gamestore_edit_nonce'); ?>

            <input type="hidden" name="game_id" value="<?php echo esc_attr($game_id); ?>">

            <h1>Sửa game</h1>

            <?php if (isset($_GET['update_success']) && $_GET['update_success'] === '1'): ?>
                <div class="form-message" style="background: rgba(60,180,120,0.12); border: 1px solid rgba(60,180,120,0.4); color: #9be7b5;">
                    Cập nhật game thành công.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['update_error']) && $_GET['update_error'] === 'invalid_rom'): ?>
                <div class="form-message form-error">Chỉ cho phép upload ROM có đuôi .gba, .gbc, .gb</div>
            <?php endif; ?>

            <?php if (isset($_GET['update_error']) && $_GET['update_error'] === 'rom_upload_failed'): ?>
                <div class="form-message form-error">Upload ROM thất bại.</div>
            <?php endif; ?>

            <?php if (isset($_GET['update_error']) && $_GET['update_error'] === 'invalid_cover'): ?>
                <div class="form-message form-error">Upload ảnh bìa thất bại.</div>
            <?php endif; ?>

            <div class="form-row">
                <label for="game_title">Tên game</label>
                <input type="text" name="game_title" id="game_title" value="<?php echo esc_attr($title); ?>" required>
            </div>

            <div class="form-row">
                <label for="game_short_description">Mô tả ngắn</label>
                <textarea name="game_short_description" id="game_short_description" rows="3"><?php echo esc_textarea($short_desc); ?></textarea>
            </div>

            <div class="form-row">
                <label for="game_description">Mô tả chi tiết</label>
                <textarea name="game_description" id="game_description" rows="8" required><?php echo esc_textarea($content); ?></textarea>
            </div>

            <div class="form-row">
                <label for="game_category">Thể loại</label>
                <select name="game_category" id="game_category">
                    <option value="">-- Chọn thể loại --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo esc_attr($category->term_id); ?>"
                            <?php selected(in_array($category->term_id, $current_category_ids)); ?>>
                            <?php echo esc_html($category->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <label>ROM hiện tại</label>
                <div class="form-hint" style="margin-top: 0; font-size: 14px;">
                    <?php echo !empty($current_rom) ? esc_html($current_rom) : 'Chưa có'; ?>
                </div>
            </div>

            <div class="form-row">
                <label for="game_rom_file">Thay ROM mới</label>
                <input type="file" name="game_rom_file" id="game_rom_file" accept=".gba,.gbc,.gb">
                <div class="form-hint">Các định dạng ROM khả dụng: .gba, .gbc, .gb</div>
            </div>

            <?php if (has_post_thumbnail($game_id)): ?>
                <div class="form-row">
                    <label>Ảnh bìa hiện tại</label>
                    <div class="current-cover-preview">
                        <?php echo get_the_post_thumbnail($game_id, 'medium'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-row">
                <label for="game_cover">Thay ảnh bìa mới</label>
                <input type="file" name="game_cover" id="game_cover" accept="image/*">
            </div>

            <div class="form-row">
                <button type="submit" name="gamestore_update_game" value="1">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>