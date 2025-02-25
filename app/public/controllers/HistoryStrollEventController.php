<?php

require_once __DIR__ . '/../models/HistoryStrollEvent.php';
require_once __DIR__ . '/BaseEventController.php';

class HistoryStrollEventController extends BaseEventController
{
    protected function getEventModel() {
        return new HistoryStrollEvent();
    }

    protected function getMainContentPath() {
        return __DIR__ . '/../views/pages/events/stroll.php';
    }

    protected function getSvgPath() {
        return '/assets/images/Rectangle4Strolls.svg';
    }

    protected function getDefaultTitle() {
        return 'History Stroll';
    }

    protected function getDefaultParagraph() {
        return 'Explore Haarlem\'s history...';
    }
}
