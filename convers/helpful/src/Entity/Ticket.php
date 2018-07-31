<?php
/**
 * @file
 * Contains \Drupal\helpful\Entity\Ticket.
 */

namespace Drupal\helpful\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the ContentEntity entity.
 *
 * @ingroup helpful
 *
 *
 * @ContentEntityType(
 *   id = "helpful_ticket",
 *   label = @Translation("Helpful Ticket entity"),
 *   handlers = {
 *   "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *   "list_builder" = "Drupal\helpful\Entity\Controller\TicketListBuilder",
 *   "form" = {
 *     "add" = "Drupal\helpful\Form\TicketForm",
 *     "edit" = "Drupal\helpful\Form\TicketForm",
 *     "delete" = "Drupal\helpful\Form\TicketDeleteForm",
 *   },
 *   "access" = "Drupal\helpful\TicketAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "convers_helpful_ticket",
 *   admin_permission = "administer helpful_ticket entity",
 *   entity_keys = {
 *   "id" = "id",
 *   "uuid" = "uuid",
 *   "user_id" = "user_id",
 *   "type" = "type",
 *   "title" = "title",
 *   "block" = "block",
 *   "page" = "page",
 *   },
 *   links = {
 *   "canonical" = "/helpful_ticket/{helpful_ticket}",
 *   "edit-form" = "/helpful_ticket/{helpful_ticket}/edit",
 *   "delete-form" = "/helpful_ticket/{helpful_ticket}/delete",
 *   "collection" = "/helpful_ticket/list"
 *   },
 *   field_ui_base_route = "entity.helpful.ticket_settings",
 * )
 */
class Ticket extends ContentEntityBase {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
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

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
    ->setLabel(t('UUID'))
    ->setDescription(t('The UUID of the Ticket entity.'))
    ->setReadOnly(TRUE);

    // Type of the Ticket entity.
    $fields['type'] = BaseFieldDefinition::create('list_string')
    ->setLabel(t('Type'))
    ->setDescription(t('Type of the Ticket entity.'))
    ->setSettings([
      'allowed_values' => ['ticket' => 'Ticket' , 'advice' => 'Advice', 'importantly' => 'Importantly'],
    ])
    ->setDefaultValue([['value' =>'ticket']])
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'options_select',
      'weight' => -2,
    ])
    ->setRequired(TRUE)
    ->setDisplayOptions('form', [
      'type' => 'options_select',
      'weight' => -6,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

    // Ticket title.
    $fields['title'] = BaseFieldDefinition::create('string')
    ->setLabel(t('Title'))
    ->setDescription(t('Title of the ticket.'))
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

    $fields['block'] = BaseFieldDefinition::create('string')
    ->setLabel(t('Block'))
    ->setDescription(t('Block text of the ticket.'))
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

    $fields['page'] = BaseFieldDefinition::create('string_long')
    ->setLabel(t('Page'))
    ->setDescription(t('Detailed page of the Ticket.'))
    ->setSettings([
      'default_value' => '',
      'max_length' => 1024,
      'type' => 'text_format',
      'format' => 'full_html',
      'display_summary' => TRUE,
    ])
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'string',
      'weight' => -6,
    ])
    ->setDisplayOptions('form', [
      'type' => 'text_format',
      'format' => 'full_html',
      'weight' => -2,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

  // The form presents a auto complete field for the user name.
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
    ->setLabel(t('User Name'))
    ->setDescription(t('The Name of the associated user.'))
    ->setSetting('target_type', 'user')
    ->setSetting('handler', 'default')
    ->setDisplayOptions('view', [
      'label' => 'above',
      'type' => 'author',
      'weight' => -3,
    ])
    ->setDisplayOptions('form', [
      'type' => 'entity_reference_autocomplete',
      'settings' => [
        'match_operator' => 'CONTAINS',
        'size' => 60,
        'placeholder' => '',
      ],
      'weight' => -3,
    ])
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

  return $fields;
  }

}