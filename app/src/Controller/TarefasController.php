<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tarefas Controller
 *
 * @property \App\Model\Table\TarefasTable $Tarefas
 */
class TarefasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($renderizarLayout = false)
    {
        if($renderizarLayout) {
            $this->viewBuilder()->layout(false);
        }
        $this->set('tarefas', $this->paginate($this->Tarefas));
        $this->set('_serialize', ['tarefas']);
    }

    /**
     * View method
     *
     * @param string|null $id Tarefa id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tarefa = $this->Tarefas->get($id, [
            'contain' => []
        ]);
        $this->set('tarefa', $tarefa);
        $this->set('_serialize', ['tarefa']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($renderizarLayout = false) {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $tarefa = $this->Tarefas->newEntity();
        } else {
            $tarefa = $this->Tarefas->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarefa = $this->Tarefas->patchEntity($tarefa, $this->request->data);
            if ($this->Tarefas->save($tarefa)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_TAREFA : EDICAO_TAREFA);
                $msg = empty($id) ?
                        'Tarefa cadastrada' : 'Tarefa alterada';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index', 1]);
            } else {
                $this->Flash->error(__('A Tarefa não pode ser salva. Por favor, tente novamente.'));
            }
        }
        
        if($renderizarLayout) {
            $this->viewBuilder()->layout(false);
        }

        $this->set(compact('tarefa', 'id'));
        $this->set('_serialize', ['tarefa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tarefa id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $renderizarLayout = false)
    {
        $tarefa = $this->Tarefas->get($id, [
            'contain' => []
        ]);        
        if($renderizarLayout) {
            $this->viewBuilder()->layout(false);
        }
        $this->set(compact('tarefa', 'id'));
        $this->set('_serialize', ['tarefa']);
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Tarefa id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tarefa = $this->Tarefas->get($id);
        if ($this->Tarefas->delete($tarefa)) {
            $this->Flash->success(__('Tarefa' . $tarefa->nome . ' deletada com sucesso'));
            $this->_log($tarefa->nome, EXCLUSAO_TAREFA);
        } else {
            $this->Flash->error(__('Não foi possível deletar a tarefa ' . $tarefa->nome . ', por favor tente novamente.'));
        }
        return $this->redirect(['action' => 'index', 1]);
    }
}
