<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Contas Controller
 *
 * @property \App\Model\Table\ContasTable $Contas
 */
class ContasController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Conta');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('contas', $this->paginate($this->Contas));
        $this->set('_serialize', ['contas']);
    }

    /**
     * View method
     *
     * @param string|null $id Conta id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $conta = $this->Contas->get($id, [
            'contain' => ['Lancamentos']
        ]);
        $this->set('conta', $conta);
        $this->set('_serialize', ['conta']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $conta = $this->Contas->newEntity();
        } else {
            $conta = $this->Contas->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conta = $this->Contas->patchEntity($conta, $this->request->data);
            if ($this->Contas->save($conta)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_CONTA : EDICAO_CONTA);
                $msg = empty($id) ?
                        'Conta cadastrada' : 'Conta alterada';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A Conta não pode ser salva. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('conta', 'id'));
        $this->set('_serialize', ['conta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $conta = $this->Contas->get($id, [
            'contain' => []
        ]);

        $this->set(compact('conta', 'id'));
        $this->set('_serialize', ['conta']);
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $conta = $this->Contas->get($id);
        if ($this->Contas->delete($conta)) {
            $this->_log($conta->nome, EXCLUSAO_CONTA);
            $this->Flash->success(__('Conta deletada'));
        } else {
            $this->Flash->error(__('A Conta não pode ser deletada. Por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
