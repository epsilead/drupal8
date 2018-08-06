<?php

/**
 * @file
 * Contains \Drupal\helpful\Entity\Controller\TicketListBuilder.
 */

namespace Drupal\helpful\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Routing\UrlGeneratorInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Utility\Unicode;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a list controller for helpful_ticket entity.
 *
 * @ingroup helpful
 */
class TicketListBuilder extends EntityListBuilder {

  /**
   * The url generator.
   *
   * @var \Drupal\Core\Routing\UrlGeneratorInterface
   */
  protected $urlGenerator;


  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity.manager')->getStorage($entity_type->id()),
      $container->get('url_generator')
    );
  }

  /**
   * Constructs a new TicketListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type term.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   * @param \Drupal\Core\Routing\UrlGeneratorInterface $url_generator
   *   The url generator.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, UrlGeneratorInterface $url_generator) {
    parent::__construct($entity_type, $storage);
    $this->urlGenerator = $url_generator;
  }


  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('Content Entity implements a Tickets model. These are fieldable entities. You can manage the fields on the <a href="@adminlink">Ticket admin page</a>.', array(
        '@adminlink' => $this->urlGenerator->generateFromRoute('entity.helpful.ticket_settings'),
      )),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the helpful_ticket list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['type'] = $this->t('Type');
    $header['title'] = $this->t('Title');
    $header['block'] = $this->t('Block');
    $header['page'] = $this->t('Page');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\helpful\Entity\Message */

    $entityUrl = Url::fromRoute('entity.helpful_ticket.canonical', array(
      'helpful_ticket' => $entity->id(),
    ));

    $pageText = Unicode::truncate(t($entity->page->value), 50) . '...';

    $pageLink = Link::fromTextAndUrl($pageText, $entityUrl)->toRenderable();

    $row['type'] = $entity->type->value;
    $row['title'] = $entity->title->value;
    $row['block'] = $entity->block->value;
    $row['page'] = render($pageLink);
    return $row + parent::buildRow($entity);
  }
}