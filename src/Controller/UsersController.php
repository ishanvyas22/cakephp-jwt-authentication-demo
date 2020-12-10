<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
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
        // $this->loadModel('Users');
        // $users = $this->Users->find();
        // debug($users->toArray());
        $result = $this->Authentication->getResult();
        debug($result->getStatus());
        debug($result->getErrors());
        debug(get_class_methods($result));exit;
        if ($result->isValid()) {
            $user = $result->getData();
            $payload = [
                'sub' => $user,
                'exp' => time() + 60,
            ];

            $json = [
                'token' => JWT::encode($payload, Security::getSalt(), 'RS256'),
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
