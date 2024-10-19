# LaunchDarkly Drupal Module

This Drupal module integrates [LaunchDarkly](https://launchdarkly.com/) feature flags into Drupal projects. It allows you to evaluate feature flags directly in PHP and Twig, enabling powerful feature flag management and experimentation within your Drupal site. This module exposes:

- A service (`launchdarkly.service`) for evaluating feature flags in PHP.
- A Twig function (`has_feature_flag()`) for checking feature flags in your Twig templates.

## Features

- **Evaluate Feature Flags in PHP**: Use the `launchdarkly.service` service to evaluate feature flags in your PHP code.
- **Evaluate Feature Flags in Twig**: Use the `has_feature_flag()` Twig function to evaluate feature flags in your Twig code.
- **User Context Support**: Evaluates feature flags based on the current Drupal user, including their ID, email, roles, and anonymous status.

## Requirements

- Drupal 10
- A LaunchDarkly account and an SDK key

## Installation

1. Install the module in your Drupal project
1. Enable the module
1. Clear the cache

## Configuration

1. After enabling the module, navigate to `/admin/config/system/launchdarkly` to configure the LaunchDarkly SDK key.
1. Provide your SDK Key from LaunchDarkly.
1. Save the configuration.

## Usage

### In PHP

You can use the `launchdarkly.service` service to check feature flags within your PHP code.

#### Example

```php
$launchDarklyService = \Drupal::service('launchdarkly.service');
$flagStatus = $launchDarklyService->hasFeatureFlag('my-feature-flag', false);

if ($flagStatus) {
  // Feature flag is on
} else {
  // Feature flag is off
}
```

- `evaluateFlag($flagKey, $default)`:
- - `$flagKey`: The key of the feature flag in LaunchDarkly.
- - `$default`: The default value to return if the flag cannot be evaluated.

### In Twig

In your Twig templates, you can use the `has_feature_flag()` function to conditionally display content based on feature flags.

#### Example

```twig
{% if has_feature_flag('my-feature-flag') %}
  <p>This feature is enabled!</p>
{% else %}
  <p>This feature is disabled.</p>
{% endif %}
```

- `has_feature_flag($flagKey, $default)`:
- - `$flagKey`: The key of the feature flag in LaunchDarkly.
- - `$default`: The default value to return if the flag cannot be evaluated.

## User Context
The module automatically creates a **LaunchDarkly context** based on the current Drupal user. It includes:

- User email
- User display name
- User roles
- Anonymous status

## License

This project is licensed under the MIT License - see the LICENSE file for details.
