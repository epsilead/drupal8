<?php
/**
 * @file
 * Contains \Drupal\common\Controller\Admin\ModulesPageController.
 */

namespace Drupal\common\Controller\Admin;

use Drupal\system\Controller\SystemController;

class ModulesPageController extends SystemController {
  public function content() {
    return $this->systemAdminMenuBlockPage();
  }
}