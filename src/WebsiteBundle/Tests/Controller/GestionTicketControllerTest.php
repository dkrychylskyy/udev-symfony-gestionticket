<?php

namespace WebsiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GestionTicketControllerTest extends WebTestCase
{
    public function testCreateticket()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'new-ticket');
    }

    public function testGettoustickets()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'all-tickets');
    }

    public function testGetopentickets()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'ouvert-tickets');
    }

    public function testGetentraitementtickets()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'en-traitement-tickets');
    }

    public function testGetfermestickets()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'fermes-tickets');
    }

}
