<?php

/**
 * @file
 * Contains \Drupal\writeus\Form\MessageForm.
 */

namespace Drupal\writeus\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Entity\ContentEntityForm;

/**
 * Class MessageForm.
 *
 * @package Drupal\writeus\Form
 */
class MessageForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->save();
  }

  public function open_modal(&$form, FormStateInterface $form_state) {

    $title = 'User Message';

    $response = new AjaxResponse();
    $this->save($form, $form_state);

    $content = '<div class="test-popup-content">Your message are was be sended</div>';
    $options = [
      'dialogClass' => 'popup-dialog-class',
      'width'       => '300',
      'height'      => '300',
    ];
    $response->addCommand(new OpenModalDialogCommand($title, $content, $options));
    return $response;
  }
}
