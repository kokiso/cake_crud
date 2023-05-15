<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vendas Controller
 *
 * @property \App\Model\Table\VendasTable $Vendas
 *
 * @method \App\Model\Entity\Venda[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VendasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public $paginate = [
        'limit' => 25,
        'order' => [
            'created' => 'desc'
        ]
    ];

    public function index()
    {
    
        $vendas = $this->Vendas->find()
            ->select(['vendas.id', 'produtos.nome', 'clientes.nome', 'vendedores.nome', 'vendas.quantidade', 'vendas.data_venda'])
            ->from('vendas')
            ->leftJoin('produtos', ['produtos.id = vendas.id_produto'])
            ->leftJoin('clientes', ['clientes.id = vendas.id_cliente'])
            ->leftJoin('vendedores', ['vendedores.id = vendas.id_vendedor'])
            ->order(['vendas.id' => 'ASC']);

        $this->paginate = [
            'limit' => 10,
            'order' => ['vendas.id' => 'ASC'],
            'fields' => ['vendas.id','vendedores.nome','clientes.nome','produtos.nome',  'vendas.quantidade', 'vendas.data_venda']
        ];

        $this->set('vendas', $this->paginate($vendas));

    }

    /**
     * View method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   

        $venda = $this->Vendas->find()
            ->select(['vendas.id', 'produtos.nome', 'clientes.nome', 'vendedores.nome', 'vendas.quantidade', 'vendas.data_venda'])
            ->from('vendas')
            ->leftJoin('produtos', ['produtos.id = vendas.id_produto'])
            ->leftJoin('clientes', ['clientes.id = vendas.id_cliente'])
            ->leftJoin('vendedores', ['vendedores.id = vendas.id_vendedor'])
            ->where('vendas.id',[$id])
            ->first();

        $this->set('venda', $venda);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {    
        $this->loadModel('Produtos');
        $this->loadModel('Vendedores');
        $this->loadModel('Clientes');
        $venda = $this->Vendas->newEntity();
        if ($this->request->is('post')) {
            $venda = $this->Vendas->patchEntity($venda, $this->request->getData());
            if ($this->Vendas->save($venda)) {
                $this->Flash->success(__('The venda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The venda could not be saved. Please, try again.'));
        }
        $this->set(compact('venda'));

        $VendedoresData = $this->Vendedores->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('vendedoresData', $VendedoresData);

        $ClientesData = $this->Clientes->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('clientesData', $ClientesData);

        $ProdutosData = $this->Produtos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('produtosData', $ProdutosData);
    }

    /**
     * Edit method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {   
        $this->loadModel('Produtos');
        $this->loadModel('Vendedores');
        $this->loadModel('Clientes');
        $venda = $this->Vendas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venda = $this->Vendas->patchEntity($venda, $this->request->getData());
            if ($this->Vendas->save($venda)) {
                $this->Flash->success(__('The venda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The venda could not be saved. Please, try again.'));
        }
        $this->set(compact('venda'));

        $VendedoresData = $this->Vendedores->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('vendedoresData', $VendedoresData);

        $ClientesData = $this->Clientes->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('clientesData', $ClientesData);

        $ProdutosData = $this->Produtos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nome'
        ]);
        $this->set('produtosData', $ProdutosData);
    }

    /**
     * Delete method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $venda = $this->Vendas->get($id);
        if ($this->Vendas->delete($venda)) {
            $this->Flash->success(__('The venda has been deleted.'));
        } else {
            $this->Flash->error(__('The venda could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function report(){

         $vendas = $this->Vendas->find()
            ->select(['vendas.id', 'produtos.nome', 'clientes.nome', 'vendedores.nome', 'vendas.quantidade', 'vendas.data_venda'])
            ->from('vendas')
            ->leftJoin('produtos', ['produtos.id = vendas.id_produto'])
            ->leftJoin('clientes', ['clientes.id = vendas.id_cliente'])
            ->leftJoin('vendedores', ['vendedores.id = vendas.id_vendedor'])
            ->order(['vendas.id' => 'ASC']);

        $minDate = $this->request->getQuery('min_date');
        $maxDate = $this->request->getQuery('max_date');
        if (!empty($minDate) && !empty($maxDate)) {
            $vendas->where([
                'Vendas.data_venda BETWEEN :minDate AND :maxDate',
                'minDate' => $minDate . ' 00:00:00',
                'maxDate' => $maxDate . ' 23:59:59',
            ]);
        }
        $this->paginate = [
            'limit' => 10,
            'order' => ['vendas.id' => 'ASC'],
            'fields' => ['vendas.id','vendedores.nome','clientes.nome','produtos.nome',  'vendas.quantidade', 'vendas.data_venda']
        ];

        $this->set('vendas', $this->paginate($vendas));
       
    }
}
