<?php

namespace Drupal\tim_misc\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "my_block_example_block",
 *   admin_label = @Translation("My block"),
 * )
 */
class LoginBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    // Build block for anonymous user.
    $html = '
    <div class="clearfix hidden-xs">
      <div class="top-menu else">
        <ul>
	      <li><a href="/user">Profile</a></li>
	      <li><a href="/user/logout">Log out</a></li>
	      <li><a href="/contact">Contact Us</a></li>
	      <li><a class="use-ajax btn btn-rounded dark small" data-dialog-options="{&quot;width&quot;:700}" data-dialog-type="modal" href="/donation-page">Donate</a></li>
        </ul>
      </div>
    </div>';
    if (\Drupal::currentUser()->isAuthenticated()) {
      $link = \Drupal::service('path.current')->getPath();
      $userLink = "/user/login?destination=" . $link;

      $html = '
      <div class="clearfix hidden-xs">
        <div class="top-menu else">
          <ul>
	        <li><a href="'. $userLink. '">Login</a></li>
	        <li><a href="/contact">Contact Us</a></li>
	        <li><a class="use-ajax btn btn-rounded dark small" data-dialog-options="{&quot;width&quot;:800}" data-dialog-type="modal" href="/donation-page">Donate</a></li>
          </ul>
        </div>
      </div>';

    }
    return [
      '#markup' => $html,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
  }
}