<?php

namespace Graphox\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/login');
    }

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/register');
    }

    public function testActivate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/activate');
    }

}
