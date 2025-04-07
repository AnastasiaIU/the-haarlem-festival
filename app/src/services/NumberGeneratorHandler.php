<?php

class NumberGeneratorHandler
{
    public function generateNumber()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomPart = '';
        for ($i = 0; $i < 3; $i++) {
            $randomPart .= $characters[rand(0, strlen($characters) - 1)];
        }
        $timestampPart = substr(time(), -3);
        return $randomPart . $timestampPart;
    }
}