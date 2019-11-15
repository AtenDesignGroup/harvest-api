<?php

namespace Drupal\harvest_api\Plugin\migrate\process;

use Drupal\entity_import\Plugin\migrate\process\EntityImportProcessTrait;
use Drupal\entity_import\Plugin\migrate\process\EntityImportProcessInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\migrate\ProcessPluginBase;

/**
 * Define entity import migration lookup.
 *
 * @MigrateProcessPlugin(
 *   id = "harvest_date_to_timestamp",
 *   label = @Translation("Harvest Date to Timestamp"),
 * )
 */
class HarvestDateToTimestamp extends ProcessPluginBase implements EntityImportProcessInterface {

  use EntityImportProcessTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfigurations() {
    return ['method' => 'strToTime'];
  }

  /**
   * Callback method.
   */
  public function strToTime($value) {
    return strtotime($value);
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => '#markup',
      '#markup' => $this->t('There are no configuration options for this plugin.'),
    ];
    return $form;
  }

}
