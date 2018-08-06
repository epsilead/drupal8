<?php

namespace Drupal\helpful\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\helpful\Entity\Ticket;

/**
 * Provides a 'helpful Ticket' Block
 *
 * @Block(
 *   id = "helpful_ticket_block",
 *   admin_label = @Translation("Helpful ticket"),
 * )
 */
class TicketsBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function build() {
    $entityCollection = Ticket::loadMultiple();

    if (is_array($entityCollection) && count($entityCollection) != 0 ) {
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
          '#data' => $blockData,
        ],
      ];
      } else {
        return [
          '#type' => 'markup',
          '#markup' => $this->t('<p>Tickets not found</p>'),
        ];
      }
  }
}
