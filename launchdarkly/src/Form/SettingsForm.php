<?php

declare(strict_types=1);

namespace Drupal\launchdarkly\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Launchdarkly settings for this site.
 */
final class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'launchdarkly_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['launchdarkly.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['launchdarkly_sdk_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('LaunchDarkly SDK Key'),
      '#default_value' => $this->config('launchdarkly.settings')->get('launchdarkly_sdk_key'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('launchdarkly.settings')
      ->set('launchdarkly_sdk_key', $form_state->getValue('launchdarkly_sdk_key'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
