<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * FormaPagamentos Controller
 *
 * @property \App\Model\Table\FormaPagamentosTable $FormaPagamentos
 */
class FormaPagamentosController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Forma de Pagamento');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('formaPagamentos', $this->paginate($this->FormaPagamentos));
        $this->set('_serialize', ['formaPagamentos']);
    }

    /**
     * View method
     *
     * @param string|null $id Forma Pagamento id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $formaPagamento = $this->FormaPagamentos->get($id, [
            'contain' => ['Lancamentos']
        ]);
        $this->set('formaPagamento', $formaPagamento);
        $this->set('_serialize', ['formaPagamento']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $formaPagamento = $this->FormaPagamentos->newEntity();
        } else {
            $formaPagamento = $this->FormaPagamentos->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formaPagamento = $this->FormaPagamentos->patchEntity($formaPagamento, $this->request->data);
            if ($this->FormaPagamentos->save($formaPagamento)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_FORMA_PAGAMENTO : EDICAO_FORMA_PAGAMENTO);
                $msg = empty($id) ?
                        'Forma de Pagamento cadastrada' : 'Forma de Pagamento alterada';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A Forma de Pagamento não pode ser salva. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('formaPagamento', 'id'));
        $this->set('_serialize', ['formaPagamento']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $formaPagamento = $this->FormaPagamentos->get($id, [
            'contain' => []
        ]);

        $this->set(compact('formaPagamento', 'id'));
        $this->set('_serialize', ['formaPagamento']);
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
        $formaPagamento = $this->FormaPagamentos->get($id);
        if ($this->FormaPagamentos->delete($formaPagamento)) {
            $this->_log($formaPagamento->nome, EXCLUSAO_FORMA_PAGAMENTO);
            $this->Flash->success(__('Forma de Pagamento deletada'));
        } else {
            $this->Flash->error(__('A Forma de Pagamento não pode ser deletada. Por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
