<?php

namespace Capstone\View;
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Clear session flag after one use
        if (!empty($_COOKIE["cookie_preferences_set"]) && !empty($_SESSION['cookie_preferences_set'])) {
            unset($_SESSION['cookie_preferences_set']);
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <title><?php echo $page_title ?></title>
            <base href="/capstone/">
            <link rel="stylesheet" href="public/css/styles.css">
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
                    <img src="<?= BASE_URL ?>/public/images/Privacy.png" style="width: 110px; border: none" alt="logo"/>
                    <span style='color: #000; font-size: 36pt; font-weight: bold; vertical-align: top'> Privacy Market</span>
                    <div style='color: #000; font-size: 14pt; font-weight: bold'>Learn what you give away with each
                        cookie.
                    </div>
                </div>
            </a>
        </div>

        <!-- Cookie Consent Pop-up -->
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_COOKIE["cookie_preferences_set"]) && empty($_SESSION['cookie_preferences_set'])):  ?>
            <div id="cookie-popup" style="position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 20px; border-top: 2px solid #ccc; text-align: center; z-index: 9999;">
                <form method="post" action="<?= BASE_URL ?>/cookie/save">
                    <label>
                        <input type="checkbox" name="strictly_necessary" checked disabled> Essential (always enabled)
                    </label> &nbsp;

                    <label>
                        <input type="checkbox" name="performance"> Performance
                    </label> &nbsp;

                    <label>
                        <input type="checkbox" name="analytics"> Analytics
                    </label> &nbsp;

                    <label>
                        <input type="checkbox" name="advertising"> Advertising
                    </label><br><br>

                    <button type="submit" class="btn btn-primary">Save Preferences</button>
                </form>
            </div>
        <?php endif; ?>

        <?php
    } //display header end

    public static function displayFooter()
    {
        ?>
        <br><br><br>
        <div id="push"></div>
        </div>
        <div id="footer"><br>&copy <?= date('Y') ?> Privacy Marketplace Project</div>
        </body>
        </html>
        <?php
    }
}
