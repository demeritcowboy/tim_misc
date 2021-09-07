<?php
namespace Drupal\tim_misc\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the TimMisc module.
 */
class TimMiscController extends ControllerBase {

  /**
   * Returns the text for the access-to-free-content popup
   *
   * @return array
   *   A simple renderable array.
   */
  public function freeContent() {
    $dest = \Drupal::request()->get('originaldest');
    //\Drupal::logger('dave')->info("Yoodles $dest");
    $loginUrl = "/user/login";
    if (!empty($dest)) {
      $loginUrl .= '?destination=' . $dest;
    }
    $html = '<div class="popup-intro"><strong>It looks like you are currently not logged in. All our podcasts are available for free.</strong></div>

<div class="clearfix">
<div class="col-sm-6 cdn-donation">
<div class="donation-text">Do you already have an account with us? Click here to log in!<br />
&nbsp;</div>

<div class="donation-link"><a class="btn btn-lg btn-hero-orange" href="' . $loginUrl . '">Log In</a></div>
</div>

<div class="col-sm-6 cdn-donation">
<div class="donation-text">Are you new to Torah in Motion?&nbsp;Please join our community.<br />
&nbsp;</div>

<div class="donation-link"><a class="btn btn-lg btn-hero-blue" href="/user/register">Join Us</a></div>
</div>
</div>
';
    return [
      '#markup' => $html,
      '#cache' => ['contexts' => ['url.path']],
    ];
  }

}
