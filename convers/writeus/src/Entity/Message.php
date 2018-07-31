<?php
/**
 * @file
 * Contains \Drupal\writeus\Entity\Message.
 */

namespace Drupal\writeus\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the ContentEntity entity.
 *
 * @ingroup writeus
 *
 *
 * @ContentEntityType(
 *   id = "writeus_message",
 *   label = @Translation("Writeus Message entity"),
 *   handlers = {
 *   "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *   "list_builder" = "Drupal\writeus\Entity\Controller\MessageListBuilder",
 *   "form" = {
 *   "add" = "Drupal\writeus\Form\MessageForm",
 *   "delete" = "Drupal\writeus\Form\MessageDeleteForm",
 *   },
 *   "access" = "Drupal\writeus\MessageAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "convers_writeus_message",
 *   admin_permission = "administer helpful_ticket entity",
 *   entity_keys = {
 *   "id" = "id",
 *   "uuid" = "uuid",
 *   "created" = "created",
 *   "email" = "email",
 *   "subject" = "subject",
 *   "message" = "message",
 *   },
 *   links = {
 *   "canonical" = "/writeus_message/{writeus_message}",
 *   "delete-form" = "/writeus_message/{writeus_message}/delete",
 *   "collection" = "/writeus_message/list"
 *   },
 *   field_ui_base_route = "entity.writeus.message_settings",
 * )
 */
class Message extends ContentEntityBase {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
  parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
    ->setLabel(t('ID'))
    ->setDescription(t('The ID of the Ticket entity.'))
    ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
    ->setLabel(t('UUID'))
    ->setDescription(t('The UUID of the Ticket entity.'))
    ->setReadOnly(TRUE);

    // Type of the Ticket entity.
    $fields['email'] = BaseFieldDefinition::create('email')
    ->setLabel(t('Email'))
    ->setDescription(t('Type of the Ticket entity.'))
    ->setSettings([
      'default_value' => '',
      'max_length' => 255,
      'text_processing' => 0,
    ])
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => -6,
    ])
    ->setDisplayOptions('form', [
      'type' => 'email_default',
      'weight' => -6,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

    // Name field for the contact.
    // We set display options for the view as well as the form.
    // Users with correct privileges can change the view and edit configuration.
    $fields['subject'] = BaseFieldDefinition::create('string')
    ->setLabel(t('subject'))
    ->setDescription(t('Short version of the ticket.'))
    ->setSettings([
      'default_value' => '',
      'max_length' => 255,
      'text_processing' => 0,
    ])
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => -6,
    ])
    ->setDisplayOptions('form', [
      'type' => 'string_textfield',
      'weight' => -6,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

    $fields['message'] = BaseFieldDefinition::create('string_long')
    ->setLabel(t('Message'))
    ->setDescription(t('Detailed page of the Ticket.'))
    ->setSettings([
      'default_value' => '',
      'max_length' => 1024,
      'type' => 'string_textarea',
    ])
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => -4,
    ])
    ->setDisplayOptions('form', [
      'type' => 'string_textarea',
      'weight' => -2,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);


    $fields['created'] = BaseFieldDefinition::create('created')
    ->setLabel(t('Created'))
    ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }
}