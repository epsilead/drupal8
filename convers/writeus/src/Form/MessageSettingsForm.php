<?php
/**
 * @file
 * Contains \Drupal\writeus\Form\MessageSettingsForm.
 */

namespace Drupal\writeus\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MessageSettingsForm.
 *
 * @package Drupal\writeus\Form
 *
 * @ingroup writeus
 */
class MessageSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'writeus_message_settings';
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
    $form['writeus_message_settings']['#markup'] = 'Settings form for Writeus Message. Manage field settings here.';
    return $form;
  }

}
