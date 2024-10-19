<?php

declare(strict_types=1);

namespace Drupal\launchdarkly\Twig\Extension;

use Drupal\launchdarkly\Service\LaunchDarklyService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension.
 */
final class LaunchDarklyTwigExtension extends AbstractExtension {

  /**
   * Constructs the extension object.
   */
  public function __construct(
    private readonly LaunchDarklyService $launchDarklyService,
  ) {}

  /**
   * {@inheritdoc}
   */
  public function getFunctions(): array {
    return [
      new TwigFunction('has_feature_flag', [$this->launchDarklyService, 'hasFeatureFlag']),
    ];
  }
}
