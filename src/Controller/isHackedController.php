<?php

namespace Drupal\is_hacked\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for is_hacked routes.
 */
class isHackedController extends ControllerBase {

  /**
   * Returns the Is Hacked module report.
   *
   * @return array
   *   The render array as expected by drupal_render().
   *
   * @todo: Add information if everything is ok.
   */
  public function statusPage() {
    $status = [
      '#type' => 'table',
      '#caption' => $this->t('Output of "@command"', ['@command' => is_hacked_get_vcs_command()]),
      '#header' => [
        $this->t('Status'),
        $this->t('File'),
      ],
      '#rows' => [],
    ];

    foreach (is_hacked_get_report() as $item) {
      $item = Html::escape(trim($item));
      $status['#rows'][] = explode(' ', $item, 2);
    }

    return $status;
  }

}
