<?php
/**
 * @file
 * Contains \Drupal\helpful\Form\TicketForm.
 */

namespace Drupal\helpful\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the helpful_ticket entity edit forms.
 *
 * @ingroup content_entity_example
 */
class TicketForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\helpful\Entity\Message */
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Redirect to term list after save.
    $form_state->setRedirect('entity.helpful_ticket.collection');
    $entity = $this->getEntity();
    $entity->save();
    // Hardcode recache method
    drupal_flush_all_caches();
  }

}
