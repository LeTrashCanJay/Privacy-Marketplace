<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: EBookController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\Model\EBooks\EBookModel;
use Capstone\View\ebook\index\EBookIndex;
use Capstone\View\ebook\detail\EbookDetail;
use Capstone\View\ebook\error\EBookError;

class EBookController {
    private $ebook_model;

    public function __construct() {
        //instance
        $this->ebook_model = EBookModel::getEBookModel();
    }

    public function index() {
        $ebooks = $this->ebook_model->list_books();
        if(!$ebooks) {
            //toss an error
            error_log("EBookModel::list_books() returned false. Possible DB error.");
            $message = "We've had an issue with displaying the e-books. Please try again later.";
            $this->error($message);
            return;
        }

        $view = new EBookIndex($ebooks);
        $view->display();

    }

    public function detail($id) {
        $ebook = $this->ebook_model->view_books($id);

        if(!$ebook) {
            $message = "There was an issue gathering the book id='".$id."'.";
            $this->error($message);
            return;
        }

        $view = new EBookDetail();
        $view->show($ebook);

    }

    public function error($message) {
        $error = new EBookError();
        $error->display($message);
    }
}