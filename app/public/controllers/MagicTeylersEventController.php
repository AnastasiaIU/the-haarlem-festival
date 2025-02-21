<?php

require_once __DIR__ . '/../models/MagicTeylersEvent.php';

class MagicTeylersEventController
{
    public function showIndex()
    {
        try {
            $model = new MagicTeylersEvent();
            $eventData = $model->getEventDetails();

            if (empty($eventData)) {
                throw new Exception("Event data not found");
            }

            $pageTitle = $eventData['hero_title'] ?? 'Magic@Teylers';
            
            ob_start();
            require __DIR__ . '/../views/pages/events/magic-teylers/index.php';
            $content = ob_get_clean();
            
            require __DIR__ . '/../views/layouts/event-layout.php';
        } catch (Exception $e) {
            error_log("Error in MagicTeylersEventController: " . $e->getMessage());
            http_response_code(500);
            require __DIR__ . '/../views/error.php';
        }
    }
}
