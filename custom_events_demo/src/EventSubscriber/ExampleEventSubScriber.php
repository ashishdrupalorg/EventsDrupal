<?php

/**
 * @file
 * Contains \Drupal\custom_events_demo\ExampleEventSubScriber.
 */

namespace Drupal\custom_events_demo\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\custom_events_demo\ExampleEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class ExampleEventSubScriber.
 *
 * @package Drupal\example_events
 */
class ExampleEventSubScriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ConfigEvents::SAVE][] = array('onSavingConfig', 800);
    $events[ExampleEvent::SUBMIT][] = array('doSomeAction', 800);
    return $events;

  }

  /**
   * Subscriber Callback for the event.
   * @param ExampleEvent $event
   */
  public function doSomeAction(ExampleEvent $event) {
    \Drupal::messenger()->addMessage(t("The Example Event has been subscribed, which has bee dispatched on submit of the form with " . $event->getReferenceID() . " as Reference"), 'status');
  }

  /**
   * Subscriber Callback for the event.
   * @param ConfigCrudEvent $event
   */
  public function onSavingConfig(ConfigCrudEvent $event) {
    \Drupal::messenger()->addMessage(t("You have saved a configuration of " . $event->getConfig()->getName()), 'status');
  }
}