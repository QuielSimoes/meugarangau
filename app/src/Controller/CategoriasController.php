<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Categorias Controller
 *
 * @property \App\Model\Table\CategoriasTable $Categorias
 */
class CategoriasController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Categoria');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        //$this->set('categorias', $this->paginate($this->Categorias));
        $find = $this->Categorias->find('all', ['fields' => ['id', 'categoria_id', 'nome']])->toArray();
        $collection = new Collection($find);
        $categorias = $collection->nest('id', 'categoria_id')->toArray();
        $this->set('categorias', $categorias);
        $this->set('_serialize', ['categorias']);
    }

    /**
     * View method
     *
     * @param string|null $id Categoria id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $categoria = $this->Categorias->get($id, [
            'contain' => ['Categorias']
        ]);
        $this->set('categoria', $categoria);
        $this->set('_serialize', ['categoria']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $categoria = $this->Categorias->newEntity();
        } else {
            $categoria = $this->Categorias->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);
            if ($this->Categorias->save($categoria)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_CATEGORIA : EDICAO_CATEGORIA);
                $msg = empty($id) ?
                        'Categoria cadastrada' : 'Categoria alterada';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A Categoria não pode ser salva. Por favor, tente novamente.'));
            }
        }
        $selectedValue = isset($this->request->query['slc_cat']) ?
                $this->request->query['slc_cat'] : null;
        $this->request->data['categoria_id'] = $selectedValue;

        $this->set(compact('categoria', 'id'));
        $this->set('categorias', $this->Categorias->find('treeList')->toArray());
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $categoria = $this->Categorias->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);
            if ($this->Categorias->save($categoria)) {
                $this->Flash->success(__('The categoria has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The categoria could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('categoria', 'id'));
        $this->set('categorias', $this->Categorias->find('treeList')->toArray());
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
        $categoria = $this->Categorias->get($id);
        if ($this->Categorias->delete($categoria)) {
            $this->_log($categoria->nome, EXCLUSAO_CATEGORIA);
            $this->Flash->success(__('Categoria deletada'));
        } else {
            $this->Flash->error(__('A Categoria não pode ser deletada. Por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
