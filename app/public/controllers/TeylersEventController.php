<?php
require_once __DIR__ . '/../models/MagicTeylersEvent.php';
require_once __DIR__ . '/BaseEventController.php';

class TeylersEventController extends BaseEventController
{
    protected function getEventModel() {
        return new MagicTeylersEvent();
    }

    protected function getMainContentPath() {
        return __DIR__ . '/../views/pages/events/teylers.php';
    }

    protected function getSvgPath() {
        return '/assets/images/Rectangle4MagicTeylers.svg';
    }

    protected function getDefaultTitle() {
        return 'Magic@Teylers';
    }

    protected function getDefaultParagraph() {
        return 'Visit the fascinating Teylers Museum...';
    }
}
