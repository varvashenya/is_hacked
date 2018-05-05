<?php

namespace Drupal\is_hacked\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure the Is Hacked module.
 *
 * @internal
 */
class isHackedSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'is_hacked_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['is_hacked.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['vcs'] = [
      '#type' => 'textfield',
      '#title' => $this->t('VCS status command'),
      '#description' => $this->t('Default to: <pre>git status --short</pre>.'),
      '#default_value' => $this->config('is_hacked.settings')->get('vcs'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('is_hacked.settings')
      ->set('vcs', $form_state->getValue('vcs'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
