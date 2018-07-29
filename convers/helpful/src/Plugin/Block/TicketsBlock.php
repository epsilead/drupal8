<?php

namespace Drupal\helpful\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\TransactionNameNonUniqueException;
use Drupal\helpful\Entity\Ticket;

/**
 * Provides a 'helpful Ticket' Block
 *
 * @Block(
 *   id = "helpful_ticket_block",
 *   admin_label = @Translation("Frontend block with randomly ticket"),
 * )
 */
class TicketsBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function build() {
    //$entityCollection = \Drupal::entityManager()->getStorage('helpful_ticket')->loadMultiple();

    $entityCollection = Ticket::loadMultiple();
    $entityId = array_rand($entityCollection);

    $ticket = Ticket::load($entityId);

    $blockData = [
      'id' => $ticket->id(),
      'title' => $ticket->title->value,
      'block' => $ticket->block->value,
    ];

    return ['helpful_ticket_block' => [
      '#theme' => 'helpful_ticket_block',
      '#cache' => [
        'disable' => TRUE,
        'max-age' => 0,
      ],
      '#data'  => $blockData,
      ],
    ];
  }
}
