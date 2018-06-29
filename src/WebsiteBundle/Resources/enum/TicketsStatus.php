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
    const OUVERT = 'ouvert';
    const EN_TRAITEMENT = 'en_traitelent';
    const FERME = 'ferme';
}