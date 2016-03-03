<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Lancamentos Controller
 *
 * @property \App\Model\Table\LancamentosTable $Lancamentos
 */
class LancamentosController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Lançamento');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        $query = $this->Lancamentos->find();
        $this->montaCondicao($query);
        $this->paginate = [
            'contain' => ['Categorias', 'FormaPagamentos', 'Contas', 'Fornecedores']
        ];
        $this->set('categorias', $this->Lancamentos->Categorias->find('treeList')->toArray());

        $this->loadModel('FormaPagamentos');
        $this->set('formaPagamentos', $this->FormaPagamentos->find('list')->toArray());

        $this->loadModel('Contas');
        $this->set('contas', $this->Contas->find('list')->toArray());

        $this->loadModel('Fornecedores');
        $this->set('fornecedores', $this->Fornecedores->find('list')->toArray());

        $this->set('lancamentos', $this->paginate($query));
        $this->set('_serialize', ['lancamentos']);
    }

    private function montaCondicao(&$query) {
        if (!empty($this->request->data['categoria_id'])) {
            $query->andWhere(function ($exp) {
                return $exp->in('Lancamentos.categoria_id', $this->request->data['categoria_id']);
            });
        }
        if (!empty($this->request->data['forma_pagamento_id'])) {
            $query->andWhere(function ($exp) {
                return $exp->in('Lancamentos.forma_pagamento_id', $this->request->data['forma_pagamento_id']);
            });
        }
        if (!empty($this->request->data['conta_id'])) {
            $query->andWhere(function ($exp) {
                return $exp->in('Lancamentos.conta_id', $this->request->data['conta_id']);
            });
        }
        if (!empty($this->request->data['fornecedor_id'])) {
            $query->andWhere(function ($exp) {
                return $exp->in('Lancamentos.fornecedor_id', $this->request->data['fornecedor_id']);
            });
        }

        if (!empty($this->request->data['data1']) && !empty($this->request->data['data2'])) {
            $query->andWhere(function ($exp, $q) {
                return $q->newExpr()->between('Lancamentos.data', $this->request->data['data1'], $this->request->data['data2']);
            });
        }
    }

    /**
     * View method
     *
     * @param string|null $id Lancamento id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $lancamento = $this->Lancamentos->get($id, [
            'contain' => ['Lancamentos', 'FormaPagamentos', 'Contas', 'Fornecedores']
        ]);
        $this->set('lancamento', $lancamento);
        $this->set('_serialize', ['lancamento']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($tpLancamento) {
        $id = empty($this->request->data['id']) ? null : $this->request->data['id'];
        if (empty($id)) {
            $lancamento = $this->Lancamentos->newEntity();
        } else {
            $lancamento = $this->Lancamentos->get($id, [
                'contain' => []
            ]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $acao = null;
            if ($tpLancamento === 'd') {
                $acao = REGISTRO_DESPESA;
                if (empty($id)) {
                    $msg = "Despesa cadastrada";
                } else {
                    $msg = "Despesa alterada";
                }
            } elseif ($tpLancamento === 'r') {
                $acao = REGISTRO_RECEITA;
                if (empty($id)) {
                    $msg = "Receita cadastrada";
                } else {
                    $msg = "Receita alterada";
                }
            }

            $contaId = $this->request->data['conta_id'];
            $valor = $tpLancamento === 'd' ? $this->request->data['valor'] * -1 : $this->request->data['valor'];
            $saldoConta = $this->obterSaldoConta($contaId);
            $this->request->data['saldo_anterior'] = $saldoConta;
            $this->request->data['valor'] = str_replace(array(".", ","), array("", "."), $valor);
            list($dia, $mes, $ano) = explode('/', $this->request->data['data']);
            $this->request->data['data'] = new Time($ano . '-' . $mes . '-' . $dia);
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $this->request->data);
            if ($this->Lancamentos->save($lancamento)) {
                $this->atualizaSaldoConta($contaId, $valor);
                $this->Flash->success(__($msg));
                $descricao = substr($this->request->data['descricao'], 0, 100);
                $this->_log($descricao, $acao);
                return $this->redirect(['action' => "add/$tpLancamento"]);
            } else {
                $this->Flash->error(__('O Lançamento não pôde ser salvo. Por favor, tente novamente.'));
            }
        }
        $this->set('categorias', $this->Lancamentos->Categorias->find('treeList')->toArray());
        $formaPagamentos = $this->Lancamentos->FormaPagamentos->find('list');
        $contas = $this->Lancamentos->Contas->find('list');
        $fornecedores = $this->Lancamentos->Fornecedores->find('list');

        $this->set(compact('id', 'tpLancamento', 'lancamento', 'formaPagamentos', 'contas', 'fornecedores'));
        $this->set('_serialize', ['lancamento']);
    }

    private function obterSaldoConta($contaId) {
        $dados = $this->Lancamentos->Contas->find('all', ['conditions' => ['id' => $contaId]])->toArray();
        return $dados[0]['saldo'];
    }

    private function atualizaSaldoConta($contaId, $valor) {
        $conta = $this->Lancamentos->Contas->get($contaId, [
            'contain' => []
        ]);
        $dataToUpdate = array(
            'saldo' => ($this->obterSaldoConta($contaId) + $valor)
        );
        $conta = $this->Lancamentos->Contas->patchEntity($conta, $dataToUpdate);
        $this->Lancamentos->Contas->save($conta);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($tpLancamento, $id = null) {
        $lancamento = $this->Lancamentos->get($id, [
            'contain' => []
        ]);
        $lancamento['valor'] = number_format($lancamento['valor'], 2, ',', '.');
        $this->set('categorias', $this->Lancamentos->Categorias->find('treeList')->toArray());
        $formaPagamentos = $this->Lancamentos->FormaPagamentos->find('list');
        $contas = $this->Lancamentos->Contas->find('list');
        $fornecedores = $this->Lancamentos->Fornecedores->find('list');

        $this->set(compact('id', 'tpLancamento', 'lancamento', 'formaPagamentos', 'contas', 'fornecedores'));
        $this->set('_serialize', ['lancamento']);
        
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
        $lancamento = $this->Lancamentos->get($id);
        if ($this->Lancamentos->delete($lancamento)) {
            $this->atualizaSaldoConta($lancamento->conta_id, $lancamento->valor);
            $this->_log($lancamento->descricao, EXCLUSAO_LANCAMENTO);
            $this->Flash->success(__('Lançamento deletado'));
        } else {
            $this->Flash->error(__('A Lançamento não pôde ser deletado. Por favor, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
