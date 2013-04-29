<?php

namespace Graphox\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/new');
    }

    public function testOptions()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/options');
    }

    public function testMembers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/members');
    }

    public function testAddmember()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/members/add');
    }

    public function testRemovemember()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/members/remove/{member}');
    }

    public function testUpdatemember()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/members/update/{member}');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/{id}/delete');
    }

}
