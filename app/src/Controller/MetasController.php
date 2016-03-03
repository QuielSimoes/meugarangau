<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
        
/**
 * Metas Controller
 *
 * @property \App\Model\Table\MetasTable $Metas
 */
class MetasController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Meta');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Categorias']
        ];
        $this->set('metas', $this->paginate($this->Metas));
        $this->set('_serialize', ['metas']);
    }

    /**
     * View method
     *
     * @param string|null $id Meta id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $meta = $this->Metas->get($id, [
            'contain' => ['Categorias']
        ]);
        $this->set('meta', $meta);
        $this->set('_serialize', ['meta']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $meta = $this->Metas->newEntity();
        } else {
            $meta = $this->Metas->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $datas = explode(' - ', $this->request->data['periodo']);
            
            list($dia1, $mes1, $ano1) = explode('/', $datas[0]);
            $this->request->data['dt_inicial'] = new Time($ano1 . '-' . $mes1 . '-' . $dia1);
            
            list($dia2, $mes2, $ano2) = explode('/', $datas[1]);
            $this->request->data['dt_final'] = new Time($ano2 . '-' . $mes2 . '-' . $dia2);
            
            $valor = $this->request->data['vl_meta'];
            $this->request->data['vl_meta'] = str_replace(array(".", ","), array("", "."), $valor);

            $meta = $this->Metas->patchEntity($meta, $this->request->data);
            if ($this->Metas->save($meta)) {
                $this->_log($this->request->data['nome'], empty($id) ? CADASTRO_META : EDICAO_META);
                $msg = empty($id) ?
                        'Meta cadastrada' : 'Meta alterada';
                $this->Flash->success(__($msg));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A Meta não pode ser salva. Por favor, tente novamente.'));
            }
        }

        $categorias = $this->Metas->Categorias->find('treeList', ['limit' => 200]);
        $this->set(compact('meta', 'id', 'categorias'));
        $this->set('_serialize', ['meta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $meta = $this->Metas->get($id, [
            'contain' => []
        ]);
        $meta['periodo'] = $meta['dt_inicial']->format('d/m/Y') . ' - ' . $meta['dt_final']->format('d/m/Y');
        $meta['vl_meta'] = number_format($meta['vl_meta'], 2, ',', '.');        
        $categorias = $this->Metas->Categorias->find('treeList', ['limit' => 200]);
        $this->set(compact('meta', 'id', 'categorias'));
        $this->set('_serialize', ['conta']);
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Meta id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $meta = $this->Metas->get($id);
        if ($this->Metas->delete($meta)) {
            $this->Flash->success(__('A meta ' . $meta->nome . ' foi excluída.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir a meta ' . $meta->nome));
        }
        return $this->redirect(['action' => 'index']);
    }

}
