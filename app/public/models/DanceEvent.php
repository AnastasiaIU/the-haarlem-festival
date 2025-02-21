<?php
// Model for the "Dance" event

class DanceEvent extends BaseEvent {
    public function getEventDetails(): array {
        return ["details" => "Details for DanceEvent..."];
    }
}
