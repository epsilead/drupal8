<?php

namespace Drupal\writeus\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Writeus message' Block
 *
 * @Block(
 *   id = "writeus_message_block",
 *   admin_label = @Translation("Writeus message"),
 * )
 */
class MessageBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('<p><a class="use-ajax" data-dialog-type="modal" href="/writeus_message/add" >Write to Us</a></p>'),
    );
  }
}
