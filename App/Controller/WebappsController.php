<?php
/**
 * Author: Jay Jones
 * Date: 6/22/2025
 * File: WebappsController.php
 * Description:
 */

namespace Capstone\Controller;

use Capstone\Model\Webapps\WebappModel;
use Capstone\View\webapps\index\WebappIndex;
use Capstone\View\webapps\detail\WebappDetail;
use Capstone\View\webapps\error\WebappError;

class WebappsController
{
    private $webapp_model;

    public function __construct()
    {
        $this->webapp_model = WebappModel::getWebappModel();
    }

    //index action
    public function index() {
        $webapps = $this->webapp_model->list_apps();
        if(!$webapps) {
            //toss an error
            error_log("WebappModel::list_apps() returned false. Possible DB error.");
            $message = "We've had an issue with displaying our apps. Please try again later.";
            $this->error($message);
            return;
        }

        $view = new WebappIndex($webapps);
        $view->display();

    }

    public function detail($id) {
        //retrieve specific movie
        $webapp = $this->webapp_model->view_apps($id);

        if (!$webapp) {
            $message = "There was an issue displaying the webapp id='".$id."'.";
            $this->error($message);
            return;
        }

        $view = new WebappDetail();
        $view->show($webapp);

    }

    //handle ya errors
    public function error($message) {
        $error = new WebappError();
        $error->display($message);
    }
}