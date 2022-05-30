<?php

/**
 * @file
 * Contains \Drupal\custom_events_demo\Form\DemoEventDispatchForm.
 */

 namespace Drupal\custom_events_demo\Form;
 
 use Drupal\Core\Form\FormBase;
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\custom_events_demo\ExampleEvent;

 /**
  * Class DemoEventDispatchForm
  * @package Drupal\custom_events_demo\Form
  */
 
 class DemoEventDispatchForm extends FormBase{
    /**
     * {@inheritdoc}
    */
    public function getFormId(){
        return "demo_event_dispatch_form";
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Reference'),
            '#description' => $this->t('Type something here that will be set to the event object, while subscribing it.'),
            '#maxlength' => 64,
            '#size' => 64,
          );
          $form['dispatch'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Dispatch'),
          );
          return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){
        $dispatcher = \Drupal::service('event_dispatcher');
        $event =   new ExampleEvent($form_state->getValue('name'));
        $dispatcher->dispatch(ExampleEvent::SUBMIT, $event);
    }

 }