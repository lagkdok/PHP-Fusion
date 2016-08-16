<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------*
| Filename: PageView.php
| Author: Frederick MC Chan (Chan)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/

namespace PHPFusion\Page;

class PageView extends PageController {

    /**
     * Return page composer object
     * @param bool|FALSE $set_info
     * @return null|static
     */
    protected static $page_instance = NULL;

    public static function getInstance($set_info = FALSE) {
        if (empty(self::$page_instance)) {
            self::$page_instance = new Static;
            if ($set_info) {
                self::set_PageInfo(); // Model
            }
        }

        return self::$page_instance;
    }

    /**
     * Displays HTML output of Page
     */
    public static function display_Page() {
        display_page(self::$info);
    }

    public static function display_Composer() {
        ob_start();
        foreach (self::$composerData as $row_id => $columns) :
            if (!empty($columns)) :
                $row_prop = flatten_array($columns);
                $row_htmlId = ($row_prop['page_grid_html_id'] ? $row_prop['page_grid_html_id'] : "row-".$row_id);
                $row_htmlClass = ($row_prop['page_grid_class'] ? " ".$row_prop['page_grid_class'] : "");
                ?>
                <div id="<?php echo $row_htmlId ?>" class="row<?php echo $row_htmlClass ?>">
                    <?php
                    foreach ($columns as $column_id => $colData) :
                        if ($colData['page_content_id']) :
                            ?>
                            <div class="<?php echo self::calculateSpan($colData['page_grid_column_count'], count($columns)) ?>">
                                <?php echo self::display_Widget($colData) ?>
                            </div>
                        <?php endif;
                    endforeach;
                    ?>
                </div>
            <?php endif;
        endforeach;
        $html = ob_get_contents();
        ob_end_clean();

        return (string)$html;
    }

}