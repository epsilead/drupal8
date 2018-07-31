<?php

/**
 * @file
 * Contains Drupal\helpful\HelpfulInterface.
 */

namespace Drupal\helpful;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a helpful_ticket entity.
 * @ingroup helpful
 */
interface HelpfulInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}