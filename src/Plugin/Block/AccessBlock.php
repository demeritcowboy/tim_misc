<?php

namespace Drupal\tim_misc\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "tim_misc",
 *   admin_label = @Translation("Access Block"),
 * )
 */
class AccessBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $dest = \Drupal::request()->get('originaldest');
    $loginUrl = "/user/login";
    if (!empty($dest)) {
      $loginUrl .= $dest;
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