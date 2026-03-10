<?php

declare(strict_types=1);

namespace Drupal\visitor_counter\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays total visitor count.
 *
 * @Block(
 *   id = "visitor_counter_block",
 *   admin_label = @Translation("Visitor counter")
 * )
 */
final class VisitorCounterBlock extends BlockBase implements ContainerFactoryPluginInterface {

  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    private readonly StateInterface $state,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new self(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('state'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $count = (int) $this->state->get('visitor_counter.total', 0);

    return [
      '#markup' => $this->t('Total visitors: @count', ['@count' => $count]),
      '#cache' => [
        'max-age' => 0,
      ],
    ];
  }

}
