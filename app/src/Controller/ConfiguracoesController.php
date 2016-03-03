<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Configuracoes Controller
 *
 * @property \App\Model\Table\ConfiguracoesTable $Configuracoes
 */
class ConfiguracoesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['GoogleAgendas']
        ];
        $this->set('configuracoes', $this->paginate($this->Configuracoes));
        $this->set('_serialize', ['configuracoes']);
    }

    /**
     * View method
     *
     * @param string|null $id Configuraco id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuraco = $this->Configuracoes->get($id, [
            'contain' => ['GoogleAgendas']
        ]);
        $this->set('configuraco', $configuraco);
        $this->set('_serialize', ['configuraco']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuraco = $this->Configuracoes->newEntity();
        if ($this->request->is('post')) {
            $configuraco = $this->Configuracoes->patchEntity($configuraco, $this->request->data);
            if ($this->Configuracoes->save($configuraco)) {
                $this->Flash->success(__('The configuraco has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuraco could not be saved. Please, try again.'));
            }
        }
        $googleAgendas = $this->Configuracoes->GoogleAgendas->find('list', ['limit' => 200]);
        $this->set(compact('configuraco', 'googleAgendas'));
        $this->set('_serialize', ['configuraco']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuraco id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuraco = $this->Configuracoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuraco = $this->Configuracoes->patchEntity($configuraco, $this->request->data);
            if ($this->Configuracoes->save($configuraco)) {
                $this->Flash->success(__('The configuraco has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuraco could not be saved. Please, try again.'));
            }
        }
        $googleAgendas = $this->Configuracoes->GoogleAgendas->find('list', ['limit' => 200]);
        $this->set(compact('configuraco', 'googleAgendas'));
        $this->set('_serialize', ['configuraco']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuraco id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuraco = $this->Configuracoes->get($id);
        if ($this->Configuracoes->delete($configuraco)) {
            $this->Flash->success(__('The configuraco has been deleted.'));
        } else {
            $this->Flash->error(__('The configuraco could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
