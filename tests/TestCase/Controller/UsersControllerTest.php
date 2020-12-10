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

    /**
     * @inheritDoc
     */
    protected $fixtures = ['app.Users'];

    public function testGeneratesJWTToken(): void
    {
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);

        $this->post('/api/users/login.json', [
            'username' => 'john',
            'password' => 'secret',
        ]);
        $responseInArray = json_decode($this->_getBodyAsString(), true);

        $this->assertResponseOk();
        $this->assertHeader('Content-Type', 'application/json');
        $this->assertNotEmpty($responseInArray['token']);
    }

    private function loginUser(): string
    {
        $this->post('/api/users/login.json', [
            'username' => 'john',
            'password' => 'secret',
        ]);

        $responseArray = json_decode($this->_getBodyAsString(), true);

        return $responseArray['token'];
    }

    public function testReturnsAuthenticatesUsersDetails(): void
    {
        $token = $this->loginUser();
        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);

        $this->get('/api/users.json');
        $responseArray = json_decode($this->_getBodyAsString(), true);

        $this->assertResponseOk();
        $this->assertHeader('Content-Type', 'application/json');
        $this->assertSame($responseArray['user']['name'], 'John Doe');
        $this->assertSame($responseArray['user']['username'], 'john');
    }
}
