<?php

abstract class BaseEventController {
    protected abstract function getEventModel();
    protected abstract function getMainContentPath();
    protected abstract function getSvgPath();
    
    protected function showEllipse(): bool {
        return true; 
    }
    
    //the function is called where $this is the instance of the controller for the event page
    public function renderEventPage() {
        try {
            $model = $this->getEventModel();
            $eventDetails = $model->getEventDetails();

            if (empty($eventDetails)) {
                throw new Exception("No event data found.");
            }

            $heroData = [
                'bg_image'      => $eventDetails['heroBgImage'] ?? '/assets/images/default-hero.jpg',
                'title'         => $eventDetails['heroTitle'] ?? $this->getDefaultTitle(),
                'paragraph'     => $eventDetails['heroParagraph'] ?? $this->getDefaultParagraph(),
                'svg_path'      => $this->getSvgPath(),
                'show_ellipse'  => $this->showEllipse(),
                'extra_heading' => $eventDetails['extraHeading'] ?? null,
                'extra_text'    => $eventDetails['extraText'] ?? null,
                'button1_link'  => $eventDetails['button1Link'] ?? null,
                'button1_text'  => $eventDetails['button1Text'] ?? null,
                'button2_link'  => $eventDetails['button2Link'] ?? null,
                'button2_text'  => $eventDetails['button2Text'] ?? null
            ];

// now we get mainContent once here instead of redundat on every event page view
            $eventData = $eventDetails;
            $mainContent = $this->getMainContentPath();

 //uses the template once in here and $mainContent is be the path to the page with the partials for each event
            require __DIR__ . '/../views/templates/event-page.php';


        } catch (Exception $e) {
            error_log("Error in " . get_class($this) . ": " . $e->getMessage());
            http_response_code(500);
            require __DIR__ . '/../views/error.php';
        }
    }

    protected function getDefaultTitle() {
        return 'Event Title';
    }

    protected function getDefaultParagraph() {
        return 'Event description...';
    }
}



