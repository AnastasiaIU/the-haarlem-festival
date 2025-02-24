<?php
require_once __DIR__ . '/../models/DanceEvent.php';
require_once __DIR__ . '/BaseEventController.php';

class DanceEventController extends BaseEventController
{
    protected function getEventModel() {
        return new DanceEvent();
    }

    protected function getMainContentPath() {
        return __DIR__ . '/../views/partials/events/dance/dance.php';
    }

    protected function getSvgPath() {
        return '/assets/images/Rectangle4Dance.svg';
    }

    protected function getDefaultTitle() {
        return 'Dance Event';
    }

    protected function getDefaultParagraph() {
        return 'Experience the rhythm...';
    }
}
