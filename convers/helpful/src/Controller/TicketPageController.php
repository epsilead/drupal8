<?php
/**
 * @file
 * Contains \Drupal\helpful\Controller\TicketPageController.
 */

namespace Drupal\helpful\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\helpful\Entity\Ticket;

class TicketPageController extends ControllerBase {
  public function content($helpful_ticket = NULL) {
    $ticket = Ticket::load($helpful_ticket);
    if(NULL !== $ticket) {
      $data['page'] = $ticket->page->value;
      $data['id'] = $ticket->id();
      if ($data) {
        return [
          '#theme' => 'page_ticket',
          '#data' => $data,
        ];
      }
    }
    throw new NotFoundHttpException();
  }
}