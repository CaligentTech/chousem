<?php

function get_setting($pdo, $key)
{
    $stmt = $pdo->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    return $stmt->fetchColumn() ?: '';
}

function get_all_settings($pdo)
{
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
    $settings = [];
    while ($row = $stmt->fetch()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    return $settings;
}

function get_content($pdo, $page, $section, $key)
{
    $stmt = $pdo->prepare(
        "SELECT content_value FROM page_content WHERE page = ? AND section = ? AND content_key = ?"
    );
    $stmt->execute([$page, $section, $key]);
    return $stmt->fetchColumn() ?: '';
}

function get_page_content($pdo, $page)
{
    $stmt = $pdo->prepare(
        "SELECT section, content_key, content_value FROM page_content WHERE page = ?"
    );
    $stmt->execute([$page]);
    $content = [];
    while ($row = $stmt->fetch()) {
        $content[$row['section']][$row['content_key']] = $row['content_value'];
    }
    return $content;
}

function get_categories($pdo, $menu_type)
{
    $stmt = $pdo->prepare(
        "SELECT * FROM menu_categories WHERE menu_type = ? AND is_active = 1 ORDER BY sort_order"
    );
    $stmt->execute([$menu_type]);
    return $stmt->fetchAll();
}

function get_menu_items($pdo, $category_id)
{
    $stmt = $pdo->prepare(
        "SELECT * FROM menu_items WHERE category_id = ? AND is_active = 1 ORDER BY sort_order"
    );
    $stmt->execute([$category_id]);
    return $stmt->fetchAll();
}

function get_gallery($pdo, $section)
{
    $stmt = $pdo->prepare(
        "SELECT * FROM gallery_images WHERE section = ? AND is_active = 1 ORDER BY sort_order"
    );
    $stmt->execute([$section]);
    return $stmt->fetchAll();
}

function get_reviews($pdo)
{
    return $pdo->query(
        "SELECT * FROM reviews WHERE is_active = 1 ORDER BY sort_order"
    )->fetchAll();
}

function get_events($pdo)
{
    return $pdo->query(
        "SELECT * FROM events WHERE is_active = 1 ORDER BY sort_order"
    )->fetchAll();
}

function get_offers($pdo, $type)
{
    $stmt = $pdo->prepare(
        "SELECT * FROM bar_offers WHERE offer_type = ? AND is_active = 1 ORDER BY sort_order"
    );
    $stmt->execute([$type]);
    return $stmt->fetchAll();
}

function e($str)
{
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
