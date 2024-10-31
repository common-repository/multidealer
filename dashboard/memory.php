<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$memory['limit'] = (int) ini_get('memory_limit');
if ($memory['limit'] > 9999999)
    $memory['limit'] = ($memory['limit'] / 1024) / 1024;

if (!is_numeric($memory['usage'])) {
    $sbb_memory = esc_html__('Unable to Check!', 'multidealer');
    return;
}
if (!is_numeric($memory['limit'])) {
    $sbb_memory = esc_html__('Unable to Check!', 'multidealer');
    return;
}
if (!is_numeric($memory['usage'])) {
    $sbb_memory = esc_html__('Unable to Check!', 'multidealer');
    return;
}
if ($memory['usage'] < 1) {
    $sbb_memory = esc_html__('Unable to Check!', 'multidealer');
    return;
}
$memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
$msg_type = 'notok';
if (defined("WP_MEMORY_LIMIT")) {
    $memory['wp_limit'] = trim(WP_MEMORY_LIMIT);
    $wplimit = $memory['wp_limit'];
    $wplimit = substr($wplimit, 0, strlen($wplimit) - 1);
    $memory['wp_limit'] = $wplimit;
    if ($wplimit >= 128)
        $msg_type = 'ok';
} else {
    $memory['wp_limit'] = esc_html__('Not defined!', 'multidealer');
}

echo '<div id="multidealer-memory-page">';
echo '<div class="multidealer-block-title">';
echo esc_html__('Memory Info', 'multidealer');
echo '</div>';

echo '<div style="padding: 20px;">';



echo '<div id="memory-tab">';
echo '<br />';
if ($msg_type == 'ok') {
    $mb = 'MB';
} else {
    $mb = '';
}
echo esc_html__('Current memory WordPress Limit: ', 'multidealer') . esc_attr($memory['wp_limit']) . esc_attr($mb) . '&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;';
$perc = $memory['usage'] / $memory['wp_limit'];
if ($perc > .7) {
    echo '<span style="color:red;">';
}
echo esc_html__('Your usage now: ', 'multidealer') . esc_attr($memory['usage']) . 'MB &nbsp;&nbsp;&nbsp;';
if ($perc > .7) {
    echo '</span>';
}
echo esc_html__('|&nbsp;&nbsp;&nbsp;   Total Server Memory: ', 'multidealer') . esc_attr($memory['limit']) . 'MB';
echo '<br /><br /><br />';
echo '</div>';

echo '<div id="multidealer-memory-instructions">';
echo esc_html__('If you want to adjust and control your WordPress Memory Limit and PHP Memory Limit quickly and without editing any files, try our free plugin WPmemory:', 'multidealer');
echo '<br />';
echo '<a href="https://wordpress.org/plugins/wp-memory/" target="_blank">' . esc_html__('Learn More', 'multidealer') . '</a>';
echo '<br /><br /><hr>';
echo esc_html__('Follow these instructions to do it manually:', 'multidealer');
echo '<br /><br />';
echo esc_html__('To increase the WordPress memory limit, add this to your wp-config.php file (located in the root folder of your server):', 'multidealer');
echo '<br /><br /><strong>define(\'WP_MEMORY_LIMIT\', \'128M\');</strong><br /><br />';
echo esc_html__('before this line:', 'multidealer');
echo '<br /><em>/* That\'s all, stop editing! Happy blogging. */</em>';
echo '<br /><br />';
echo esc_html__('If you need more, just replace 128 with the new memory limit.', 'multidealer');
echo '<br />';
echo esc_html__('To increase your total server memory, talk to your hosting company.', 'multidealer');
echo '<br /><br /><hr /><br />';

echo '<strong>' . esc_html__('How to Tell if Your Site Needs More Memory:', 'multidealer') . '</strong>';
echo '<br /><br />';
echo esc_html__('If your site is slow, pages fail to load, or you encounter random white screens of death or 500 internal server errors, you may need more memory. Various factors consume memory, including WordPress itself, the plugins installed, the theme you are using, and the content on your site.', 'multidealer');
echo '<br /><br />';
echo esc_html__('As you add more content and features, your memory limit needs to increase. If you are running a small site with basic functions and no page builder or theme options, you may not need much memory. However, when using premium themes and plugins, you may need to adjust your memory limit to meet modern WordPress standards.', 'multidealer');
/*
echo '<br /><br />';
echo esc_html__('Increasing the WP Memory Limit is a common practice in WordPress. You can find instructions in the official WordPress documentation:', 'multidealer');
echo '<br /><br />';
echo '<a href="https://codex.wordpress.org/Editing_wp-config.php" target="_blank">https://codex.wordpress.org/Editing_wp-config.php</a>';
*/
echo '<br /><br /></div></div></div>';
