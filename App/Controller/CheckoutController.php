<?php
namespace Capstone\Controller;

use Capstone\Model\Cookies\CookieModel;
use Capstone\View\checkout\CheckoutView;

class CheckoutController
{
    public function index() {
        $this->complete();
    }
    public function complete()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Get user ID from session
        $user_id = $_SESSION['user_id'] ?? null;

        // Default message if user not logged in or no preferences found
        $cookieMessage = "We do not have your cookie preferences.";

        if ($user_id) {
            $cookieModel = CookieModel::getModel();
            $prefs = $cookieModel->getPreferences($user_id);

            if ($prefs) {
                $cookieMessage = $this->generateCookieMessage($prefs);
            }
        }

        $view = new CheckoutView($cookieMessage);
        $view->display();
    }

    private function generateCookieMessage(array $prefs): string
    {
        $messages = [];

        // Always-enabled section
        $messages[] = "Strictly Necessary Cookies:\n"
            . "You have allowed strictly necessary cookies. These cookies allow the site to function properly.\n"
            . "Unfortunately, that means we can't let you opt out of this. The site would not work if we did!";

        // Performance cookies
        if (!empty($prefs['performance'])) {
            $messages[] = "Performance Cookies:\n"
                . "Enabled, helping us improve your experience.\n"
                . "We use these to track errors and page loading speeds.\n"
                . "We cannot use this data to identify you. Only we have access to it!";
        } else {
            $messages[] = "Performance Cookies:\nDisabled.";
        }

        // Analytics cookies
        if (!empty($prefs['analytics'])) {
            $messages[] = "Analytics Cookies:\n"
                . "Enabled, allowing us to analyze site usage.\n"
                . "We track how long you've used our site and how often you visit.\n"
                . "We cannot use this data to identify you. Only we have access to it!";
        } else {
            $messages[] = "Analytics Cookies:\nDisabled.";
        }

        // Advertising cookies
        if (!empty($prefs['advertising'])) {
            $messages[] = "Advertising Cookies:\n"
                . "Enabled, helping us personalize ads.\n"
                . "These collect your internet and browser information.\n"
                . "Most websites would sell this data to advertisers — but we don’t.\n"
                . "Be careful when opting into this category!";
        } else {
            $messages[] = "Advertising Cookies:\nDisabled.";
        }

        return implode("\n\n", $messages); // Neatly spaced for <textarea>
    }
}

