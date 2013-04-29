<?php

namespace Graphox\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TimelineControllerTest extends WebTestCase
{
    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/timeline/{id}');
    }

    public function testViewevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/timeline/event/{id}');
    }

    public function testViewown()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/timeline');
    }

    public function testManagetimelines()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/timeline/manage');
    }

}
