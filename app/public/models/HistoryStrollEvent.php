<?php
    // Model for the "HistoryStrollEvent" event
    
    class HistoryStrollEvent extends BaseEvent {
        public function getEventDetails(): array {
            return ["details" => "Details for DanceEvent..."];
        }
    }
    