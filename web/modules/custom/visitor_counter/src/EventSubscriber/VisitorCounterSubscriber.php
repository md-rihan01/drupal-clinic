<?php

declare(strict_types=1);

namespace Drupal\visitor_counter\EventSubscriber;

use Drupal\Core\State\StateInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Increments a visitor count once per browser session.
 */
final class VisitorCounterSubscriber implements EventSubscriberInterface {

  public function __construct(
    private readonly StateInterface $state,
  ) {}

  /**
   * Counts only master requests and skips admin pages.
   */
  public function onKernelRequest(RequestEvent $event): void {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();

    if (str_starts_with($request->getPathInfo(), '/admin')) {
      return;
    }

    $session = $request->getSession();
    if ($session && !$session->has('visitor_counter_counted')) {
      $total = (int) $this->state->get('visitor_counter.total', 0);
      $this->state->set('visitor_counter.total', $total + 1);
      $session->set('visitor_counter_counted', TRUE);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    return [
      KernelEvents::REQUEST => ['onKernelRequest'],
    ];
  }

}
