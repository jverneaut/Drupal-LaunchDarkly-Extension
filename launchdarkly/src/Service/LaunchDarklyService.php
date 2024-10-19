<?php

declare(strict_types=1);

namespace Drupal\launchdarkly\Service;

use LaunchDarkly\LDClient;
use LaunchDarkly\LDContext;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * @todo Add class description.
 */
final class LaunchDarklyService {
  protected $client;
  protected $context;
  protected $currentUser;

  public function __construct(AccountProxyInterface $currentUser) {
    $sdk_key = \Drupal::config('launchdarkly.settings')->get('launchdarkly_sdk_key') ?? '';

    if (empty($sdk_key)) {
      \Drupal::logger('launchdarkly')->error('LaunchDarkly SDK key is not set.');
    }

    $this->currentUser = $currentUser;
    $this->client = new LDClient($sdk_key);
    $this->context = $this->createContext();
  }

  public function createContext() {
    $user = $this->currentUser;

    $context_builder = LDContext::builder('user-' . $user->id())
      ->kind('user')
      ->name($user->getDisplayName())
      ->set('email', $user->getEmail() ?: '')
      ->set('role', implode(',', $user->getRoles()))
      ->anonymous($user->isAnonymous());

    $context = $context_builder->build();

    $this->client->identify($context);

    return $context;
  }

  public function hasFeatureFlag($flagKey, $default = false) {
    $context = $this->context;

    return $this->client->variation($flagKey, $context, $default);
  }
}
