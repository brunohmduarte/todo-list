<?php

namespace Source\App\Helpers;

use DateTime;

class Date 
{
    /**
     * Converte uma data no formato 00/00/0000 => 0000-00-00 ou 0000-00-00 => 00/00/0000
     * 
     * @param string $date - A data a ser convertida.
     * @return string
     */
    public static function convertDate(string $date) : string
    {
        return implode(strpos($date, "/") ? "-" : "/", array_reverse(explode(strpos($date, "/") ? "/" : "-", $date)));
    }

    /**
     * Converte uma data timestamp no formato 00/00/0000 00:00:00  =>  0000-00-00 00:00:00 
     *                                     ou 0000-00-00 00:00:00  =>  00/00/0000 00:00:00
     * 
     * @param string $date - A data a ser convertida.
     * @return string
     */
    public static function convertTimestamp(string $timestamp) : string
    {
        $date = explode(" ", $timestamp);
        $date[0] = Date::convertDate($date[0]);
        $date[1] = Date::formatTime($date[1]);
        return implode(" ", $date);
    }

    /**
     * Formata a hora em um padrão hh:mm
     * 
     * @param string $time - A hora a ser formatada.
     * @return string
     */
    public function formatTime(string $time)
    {
        return date("H:i", strtotime($time));
    }
}