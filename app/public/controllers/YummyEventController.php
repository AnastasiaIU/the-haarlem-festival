<?php
require_once __DIR__ . '/../models/YummyEvent.php';
require_once __DIR__ . '/BaseEventController.php';

class YummyEventController extends BaseEventController
{
    protected function getEventModel() {
        return new YummyEvent();
    }

    protected function getMainContentPath() {
        return __DIR__ . '/../views/partials/events/yummy/yummy.php';
    }

    protected function getSvgPath() {
        return '/assets/images/Rectangle4Yummy.svg';
    }

    protected function getDefaultTitle() {
        return 'Yummy Delights';
    }

    protected function getDefaultParagraph() {
        return 'Taste the best cuisines...';
    }
}
