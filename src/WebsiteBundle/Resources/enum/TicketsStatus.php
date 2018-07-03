<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 28/06/2018
 * Time: 15:36
 */

namespace WebsiteBundle\Resources\enum;


abstract class TicketsStatus
{
    const STATUS_OUVERT = 'Ouvert';
    const STATUS_EN_TRAITEMENT = 'En traitement';
    const STATUS_FERME = 'Ferme';

    protected static $statusName = [
        self::STATUS_OUVERT => "Ouvert",
        self::STATUS_EN_TRAITEMENT => "En traitement",
        self::STATUS_FERME => "Ferme"
    ];

    public static function getStatusName($statusShortName) {
        if(!isset(static::$statusName[$statusShortName])){
            return "Je ne connait pas de status ".$statusShortName;
        }

        return static::$statusName[$statusShortName];
    }

    public static function getAvaliableStatus(){
        return [
            self::STATUS_OUVERT,
            self::STATUS_EN_TRAITEMENT,
            self::STATUS_FERME
        ];
    }
}