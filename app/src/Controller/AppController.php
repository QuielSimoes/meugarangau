<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use App\Model\Entity\Log;
use App\Model\Entity\Meta;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {
        Time::setToStringFormat('dd/MM/YYYY');
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $login = $this->request->session()->read("Auth.User.username");
        $foto = $this->request->session()->read("Auth.User.foto");
        $this->set('fotoUsuario', $foto);
        $this->set('login', $login);

        $this->loadModel('Logs');
        $logs = $this->Logs->find('all', [
                    'fields' => ['Logs.id', 'Logs.descricao', 'Acao.nome', 'Acao.icone'],
                    'order' => ['Logs.id' => 'desc'],
                    'join' => [
                        [
                            'table' => 'acoes',
                            'alias' => 'Acao',
                            'type' => 'INNER',
                            'conditions' => ['Acao.id = Logs.acao_id']
                        ]
                    ],
                    'limit' => 4
                ])->toArray();
        $this->set('logs', $logs);

        $this->loadModel('Metas');
        $progresso_metas = $this->Metas->find('all', [
                    'fields' => ['nome' => 'Metas.nome', 'percentual' => '(SUM(Lancamentos.valor) * 100 / Metas.vl_meta)', 'Metas.tp_controle'],
                    'order' => ['Metas.nome' => 'asc'],
                    'join' => [
                        [
                            'table' => 'lancamentos',
                            'alias' => 'Lancamentos',
                            'type' => 'INNER',
                            'conditions' => ['Lancamentos.categoria_id = Metas.categoria_id']
                        ]
                    ],
                    'conditions' => [
                        'Lancamentos.dt_cadastro BETWEEN Metas.dt_inicial and Metas.dt_final'
                    ],
                    'group' => ['Lancamentos.categoria_id']
                ])->toArray();
        $this->set('progresso_metas', $progresso_metas);

        // Contas a pagar e contas a receber
        $this->loadModel('Lancamentos');
        $dtCadastro = new \DateTime('now');
        $lancamentos = $this->Lancamentos->find('all', [
            'fields' => ['Lancamentos.descricao', 'Lancamentos.valor'],
            'order' => ['Lancamentos.data' => 'asc'],
            'conditions' => [
                'Lancamentos.data >=' => new \DateTime('now'),
                'Lancamentos.data <=' => $dtCadastro->modify('+30 days'),
                'Lancamentos.consolidado' => 'N'
            ],
        ])->toArray();        
        $this->set('lancamentos', $lancamentos);
    }

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['login', 'logout']);
    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    public function _log($msg, $acao_id) {
        $this->loadModel('Logs');
        $log = new Log([
            'user_id' => $this->request->session()->read("Auth.User.id"),
            'descricao' => $msg,
            'acao_id' => $acao_id
        ]);
        $this->Logs->save($log);
    }

}
