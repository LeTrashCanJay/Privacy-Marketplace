<?php
/**
 * Author: Jay Jones
 * Date: 6/14/2025
 * File: home_index.class.php
 * Description:
 */

class HomeIndex extends IndexView {
    public function display() {
        parent::displayHeader("Privacy Marketplace Home");
        ?>
        <div id="main-header">Welcome to the Digital Privacy Marketplace</div>
        <p>This application aims to show the intricacies of data privacy, display what you may or may not be giving away when you absentmindedly click "Accept all Cookies" or scroll past EULAs and Privacy Policies.</p>
        <br>

        <div id="thumbnails" style="text-align: center; border: none">
            <p>placeholder</p>

            <a href="<?= BASE_URL ?>/movie/index">
                <img src="<?= BASE_URL ?>/www/img/movies.jpg" title="Movie Library"/>
            </a>
            <a href="<?= BASE_URL ?>/book/index">
                <img src="<?= BASE_URL ?>/www/img/books.jpg" title="Book Library"/>
            </a>
            <a href="#">
                <img src="<?= BASE_URL ?>/www/img/games.jpg" title="Game Library" />
            </a>
            <a href="#">
                <img src="<?= BASE_URL ?>/www/img/music.jpg" title="Music Library (Under Construction)" />
            </a>
        </div>
        <br>

        <p style="text-align: center; font-weight: bold">Note</p>
        <p>This does not depict a real marketplace on the internet. I do not have any access to anyone's data or private information. The main goal of this website is awareness and to display that in a way that is intuitive and simple.</p>

        <?php
        parent::displayFooter();
    }
}