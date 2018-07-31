<?php

/**
 * @file
 * Contains Drupal\writeus\WriteusInterface.
 */

namespace Drupal\writeus;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a helpful_ticket entity.
 * @ingroup writeus
 */
interface WriteusInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}