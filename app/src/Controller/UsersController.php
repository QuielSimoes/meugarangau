<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        if (empty($this->request->data['id'])) {
            $user = $this->Users->newEntity();
            $msg = "Perfil criado com sucesso";
        } else {
            $user = $this->Users->get($this->request->data['id'], [
                'contain' => []
            ]);
            $msg = "Perfil alterado com sucesso";
            $this->_log('Alteração de perfil');
        }
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $save = $this->Users->save($user);
            if ($save) {
                $id = $save->id;
                $this->atualizarFotoPerfil($id);
                $this->Flash->success($msg);
            } else {
                $this->Flash->error(__('Erro na persistência dos dados, por favor, tente novamente'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        return $this->redirect(['action' => 'perfil']);
    }

    private function atualizarFotoPerfil($idUser) {
        if (!empty($this->request->data['foto_id']['name'])) {
            $pathInfo = pathinfo($this->request->data['foto_id']['name']);
            $ext_type = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
            if (in_array($pathInfo['extension'], $ext_type)) {
                if ($this->request->data['foto_id']['error'] === 1) {
                    $this->Flash->default('Não foi possível alterar a foto: Tamanho máximo excedido (2MB)');
                } else {
                    $nomeFoto = $pathInfo['basename'];
                    $destino = "img/$nomeFoto";
                    move_uploaded_file($this->request->data['foto_id']['tmp_name'], $destino);

                    $update = array('foto' => $nomeFoto);
                    $user = $this->Users->get($idUser, [
                        'contain' => []
                    ]);
                    $user = $this->Users->patchEntity($user, $update);
                    $this->Users->save($user);
                }
            } else {
                $this->Flash->default('Não foi possível alterar a foto: Arquivo inválido');
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Login e senha inválidos, tente novamente'));
        }
        $this->viewBuilder()->layout('login');
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function perfil() {
        $session = $this->request->session()->read();        
        $id = $this->request->session()->read("Auth.User.id");
        $dadosUsuario = $this->Users->find('all', ['conditions' => ['id' => $id]])->toArray();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        
        $this->set('_serialize', ['user']);
        $this->set(compact('id', 'dadosUsuario', 'user'));
    }

}
