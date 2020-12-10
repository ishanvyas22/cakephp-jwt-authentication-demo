<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Users Controller
 */
class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $privateKey = Security::getSalt();
            $user = $result->getData();
            $payload = [
                'iss' => 'myapp',
                'sub' => $user->id,
                'exp' => time() + 60,
            ];

            $json = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function logout()
    {
        $json = [];

        $this->Authentication->logout();

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }
}
