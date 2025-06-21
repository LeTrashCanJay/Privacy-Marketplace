<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: index_view.class.php
 * Description:
 */


class IndexView
{
    public static function displayHeader($page_title)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <title><?php echo $page_title ?></title>
            <link rel="stylesheet" href="/public/css/styles.css">
            <script>
                var base_url = "<?=BASE_URL?>";
            </script>
        </head>
        <body>
        <div id="top"></div>
        <div id='wrapper'>
        <div id="banner">
            <a href="<?= BASE_URL ?>/index.php" style="text-decoration: none" title="Digital Privacy Marketplace">
                <div id="left">
                    <div style='color: #000; font-size: 14pt; font-weight: bold'>An interactive application designed
                        with MVC pattern
                    </div>
                </div>
            </a>
        </div>
        <?php
    }

    public static function displayFooter()
    {
        ?>
        <br><br><br>
        <div id="push"></div>
        </div>
         <div id="footer"><br>&copy <?=date('Y')?>Privacy Marketplace Project</div>
        </body>
        </html>
        <?php
    }
}
