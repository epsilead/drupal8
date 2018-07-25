<?php
/**
 * @file
 * Contains \Drupal\helpful\Form\TicketSettingsForm.
 */

namespace Drupal\helpful\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TicketSettingsForm.
 *
 * @package Drupal\helpful\Form
 *
 * @ingroup helpful
 */
class TicketSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'helpful_ticket_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['helpful_ticket_settings']['#markup'] = 'Settings form for Helpful Tickets. Manage field settings here.';
    return $form;
  }

}
