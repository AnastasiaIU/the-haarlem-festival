<?php
// Parent (abstract) class for all event types

abstract class BaseEvent extends BaseModel {
    protected $title;
    protected $description;
    protected $image;
    protected $location;

    abstract public function getEventDetails();
}
