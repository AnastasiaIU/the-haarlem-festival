<?php

abstract class BaseEventController {
    protected abstract function getEventModel();
    protected abstract function getMainContentPath();
    protected abstract function getSvgPath();
    
    public function renderEventPage() {
        try {
            $model = $this->getEventModel();
            $eventDetails = $model->getEventDetails();

            if (empty($eventDetails)) {
                throw new Exception("No event data found.");
            }

            $heroData = [
                'bg_image'  => $eventDetails['heroBgImage'] ?? '/assets/images/default-hero.jpg',
                'title'     => $eventDetails['heroTitle'] ?? $this->getDefaultTitle(),
                'paragraph' => $eventDetails['heroParagraph'] ?? $this->getDefaultParagraph(),
                'svg_path'  => $this->getSvgPath()
            ];

            $mainContent = $this->getMainContentPath();
            include __DIR__ . '/../views/templates/event-page.php';

        } catch (Exception $e) {
            error_log("Error in " . get_class($this) . ": " . $e->getMessage());
            throw $e;
        }
    }

    protected function getDefaultTitle() {
        return 'Event Title';
    }

    protected function getDefaultParagraph() {
        return 'Event description...';
    }
}



