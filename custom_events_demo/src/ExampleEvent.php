<?php

namespace Drupal\custom_events_demo;

use Symfony\Component\EventDispatcher\Event;

class ExampleEvent extends Event{
    const SUBMIT = 'event.submit';
    protected $referenceID;

    public function __construct($referenceID){
        $this->referenceID = $referenceID;
    }

    public function getReferenceID(){
        return $this->referenceID;
    }

    public function myEventDesription(){
        return 'This is an Example Event';
    }
}