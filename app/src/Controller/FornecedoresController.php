<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Fornecedores Controller
 *
 * @property \App\Model\Table\FornecedoresTable $Fornecedores
 */
class FornecedoresController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Fornecedor');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('fornecedores', $this->paginate($this->Fornecedores));
        $this->set('_serialize', ['fornecedores']);
    }

    /**
     * View method
     *
     * @param string|null $id Fornecedore id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $fornecedore = $this->Fornecedores->get($id, [
            'contain' => []
        ]);
        $this->set('fornecedore', $fornecedore);
        $this->set('_serialize', ['fornecedore']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $fornecedor = $this->Fornecedores->newEntity();
        } else {
            $fornecedor = $this->Fornecedores->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fornecedor = $this->Fornecedores->patchEntity($fornecedor, $this->request->data);
            if ($this->Fornecedores->save($fornecedor)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_FORNECEDOR : EDICAO_FORNECEDOR);
                $msg = empty($id) ?
                        'Fornecedor cadastrado' : 'Fornecedor alterado';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O Fornecedor não pode ser salvo. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('fornecedor', 'id'));
        $this->set('_serialize', ['fornecedor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $fornecedor = $this->Fornecedores->get($id, [
            'contain' => []
        ]);

        $this->set(compact('fornecedor', 'id'));
        $this->set('_serialize', ['fornecedor']);
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
        $fornecedor = $this->Fornecedores->get($id);
        if ($this->Fornecedores->delete($fornecedor)) {
            $this->_log($fornecedor->nome, EXCLUSAO_FORNECEDOR);
            $this->Flash->success(__('Fornecedor deletado'));
        } else {
            $this->Flash->error(__('O Fornecedor não pode ser deletado. Por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
