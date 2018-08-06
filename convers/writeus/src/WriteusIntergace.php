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
 * Provides an interface defining a writeus_message entity.
 * @ingroup writeus
 */
interface WriteusInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}