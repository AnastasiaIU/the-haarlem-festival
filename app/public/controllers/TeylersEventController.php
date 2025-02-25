<?php
require_once __DIR__ . '/../models/MagicTeylersEvent.php';
require_once __DIR__ . '/BaseEventController.php';

class TeylersEventController extends BaseEventController
{
    protected function getEventModel() {
        return new MagicTeylersEvent();
    }

    protected function getMainContentPath(): string {
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

    //example how to not use the elipse for the pages that dont need it you override itt wth false.
    protected function showEllipse(): bool {
        return false;
    }

    protected function getEventSlug(): string {
        return 'teylers';
    }
}
