<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected $fixtures = ['app.Users'];

    /**
     * Test index method
     *
     * @return void
     */
    public function testLogin(): void
    {
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);

        $this->post('/api/users/login.json', [
            'username' => 'john',
            'password' => 'secret',
        ]);

        debug($this->_getBodyAsString());

        $this->assertResponseOk();
    }
}
