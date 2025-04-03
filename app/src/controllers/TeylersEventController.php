<?php

require_once(__DIR__ . '/../models/TeylersEventModel.php');

class TeylersEventController {
    private $teylersEventModel;

    public function __construct() {
        $this->teylersEventModel = new TeylersEventModel();
    }

    public function getTeylersEventByDate(DateTime $date): ?array {
        return $this->teylersEventModel->fetchTeylersEventByDate($date);
    }
}