<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: user_line_include.php
| Author: PHP-Fusion Development Team
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

$icon = "<img src='".IMAGES."user_fields/social/line.svg' alt='Line'/>";
// Display user field input
if ($profile_method == "input") {
    $options = [
            'inline'           => TRUE,
            'max_length'       => 16,
            'regex'            => '[a-z](?=[\w.]{3,31}$)\w*\.?\w*',
            'error_text'       => $locale['uf_line_error'],
            'regex_error_text' => $locale['uf_line_error_1'],
            'placeholder'      => $locale['uf_line'],
            'label_icon'       => $icon
        ] + $options;
    $user_fields = form_text('user_line', $locale['uf_line'], $field_value, $options);
    // Display in profile
} else if ($profile_method == "display") {
    $user_fields = ['title' => $icon.$locale['uf_line'], 'value' => $field_value ?: ''];
}