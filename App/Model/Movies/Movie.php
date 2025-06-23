<?php
/**
 * Author: Jay Jones
 * Date: 6/8/2025
 * File: movies.class.php
 * Description:
 */

namespace Capstone\Model\Movies;

class Movie
{
    //private members
    private $id, $title, $price, $image_url, $description;

    //construct it
    public function __construct($title, $price, $image_url, $description = "") {
        $this->title = $title;
        $this->price = $price;
        $this->image_url = $image_url;
        $this->description = $description;
    }

    //getters and setter
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return $this->price;
    }
    public function getImage() {
        return $this->image_url;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        $this->id = $id;
    }
}