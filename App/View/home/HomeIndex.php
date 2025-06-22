<?php

namespace Capstone\View\home;

use Capstone\View\IndexView;

/**
 * Author: Jay Jones
 * Date: 6/14/2025
 * File: HomeIndex.php
 * Description:
 */
class HomeIndex extends IndexView
{
    public function display()
    {
        parent::displayHeader("Privacy Marketplace Home");
        ?>
        <div id="main-header">Welcome to the Digital Privacy Marketplace</div>
        <p>This application aims to show the intricacies of data privacy, display what you may or may not be giving away
            when you absentmindedly click "Accept all Cookies" or scroll past EULAs and Privacy Policies.</p>
        <br>

        <div id="thumbnails" style="text-align: center; border: none">
            <p>Click the images to explore each storefront.</p>

            <a href="<?= BASE_URL ?>/movie/index">
                <img src="<?= BASE_URL ?>/public/images/thumbnails/Movie.jpeg" title="Movie Library"/>
            </a>
            <a href="<?= BASE_URL ?>/ebook/index">
                <img src="<?= BASE_URL ?>/public/images/thumbnails/Ebook.jpeg" title="Book Library"/>
            </a>
            <a href="<?= BASE_URL ?>/games/index">
                <img src="<?= BASE_URL ?>/public/images/thumbnails/Games.jpeg" title="Game Library"/>
            </a>
            <a href="<?= BASE_URL ?>/apps/index">
                <img src="<?= BASE_URL ?>/public/images/thumbnails/Webapp.jpeg" title="Music Library (Under Construction)"/>
            </a>
        </div>
        <br>

        <p style="text-align: center; font-weight: bold">Note</p>
        <p>This does not depict a real marketplace on the internet. I do not have any access to anyone's data or private
            information. The main goal of this website is awareness and to display that in a way that is intuitive and
            simple.</p>

        <?php
        parent::displayFooter();
    }
}