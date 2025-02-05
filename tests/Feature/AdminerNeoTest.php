<?php
namespace SabbottLabs\AdminerNeo\Tests\Feature;

use Tests\TestCase;

class AdminerNeoTest extends TestCase
{
    public function test_adminerneo_requires_authentication()
    {
        $response = $this->get('/adminerneo');
        $response->assertStatus(302);
    }
}