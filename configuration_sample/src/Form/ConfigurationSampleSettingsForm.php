<?php

/**
 * @file
 * Contains \Drupal\configuration_sample\Form\ConfigurationSampleSettingsForm.
 */

namespace Drupal\configuration_sample\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigurationSampleSettingsForm.
 *
 * @package Drupal\configuration_sample\Form
 */
class ConfigurationSampleSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'configuration_sample_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['configuration_sample.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('configuration_sample.settings');

    $form['configuration_sample_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sample API Key'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('api_key'),
    ];
    $form['configuration_sample_list_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sample List ID'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('list_id'),
    ];
    $form['configuration_sample_success_msg'] = [
      '#type' => 'textarea',
      '#title' => t('Success Message'),
      '#default_value' => $config->get('success_msg'),
    ];
    $form['configuration_sample_failure_msg'] = [
      '#type' => 'textarea',
      '#title' => t('Failure Message'),
      '#default_value' => $config->get('failure_msg'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Save config.
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory()->getEditable('configuration_sample.settings');
    $config
      ->set('api_key', $form_state->getValue('configuration_sample_api_key'))
      ->set('list_id', $form_state->getValue('configuration_sample_list_id'))
      ->set('success_msg', $form_state->getValue('configuration_sample_success_msg'))
      ->set('failure_msg', $form_state->getValue('configuration_sample_failure_msg'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
