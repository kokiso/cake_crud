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
        $this->loadModel('Vendas');
        $this->loadModel('Produtos');
        $this->loadModel('Vendedores');
        $this->loadModel('Clientes');

        $vendas = $this->Vendas->find()
            ->select(['Vendas.id', 'Produtos.nome', 'Clientes.nome', 'Vendedores.nome, Vendas.quantidade,Vendas.data_venda'])
            ->leftJoin(
                ['Produtos' => 'produtos'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Produtos.id = Vendas.id_produto'
                        ])
                    );
                }
            )
            ->leftJoin(
                ['Vendedores' => 'vendedores'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Vendedores.id = Vendas.id_vendedor'
                        ])
                    );
                }
            )
            ->leftJoin(
                ['Clientes' => 'clientes'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Clientes.id = Vendas.id_cliente'
                        ])
                    );
                }
            );

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
                'order' => ['Vendas.id' => 'DESC'],
                'fields' => ['Vendas.id', 'Produtos.nome', 'Clientes.nome', 'Vendedores.nome, Vendas.quantidade,Vendas.data_venda'],
                'joins' => [
                    [
                        'table' => 'Produtos',
                        'alias' => 'Produtos',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Produtos.id = Vendas.id_produto'
                        ]
                    ],
                    [
                        
                        'table' => 'Clientes',
                        'alias' => 'Clientes',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Clientes.id = Vendas.id_cliente'
                        ]
                    ],
                    [
                        
                        'table' => 'Vendedores',
                        'alias' => 'Vendedores',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Vendedores.id = Vendas.id_vendedor'
                        ]
                    ]
                ],
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
        $this->loadModel('Vendas');
        $this->loadModel('Produtos');
        $this->loadModel('Vendedores');
        $this->loadModel('Clientes');

        $vendas = $this->Vendas->find()
            ->select(['Vendas.id', 'Produtos.nome', 'Clientes.nome', 'Vendedores.nome, Vendas.quantidade,Vendas.data_venda'])
            ->leftJoin(
                ['Produtos' => 'produtos'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Produtos.id = Vendas.id_produto'
                        ])
                    );
                }
            )
            ->leftJoin(
                ['Vendedores' => 'vendedores'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Vendedores.id = Vendas.id_vendedor'
                        ])
                    );
                }
            )
            ->leftJoin(
                ['Clientes' => 'clientes'],
                function ($exp, $query) {
                    return $exp->add(
                        $exp->and_([
                            'Clientes.id = Vendas.id_cliente'
                        ])
                    );
                }
            )->where(['Vendas.id' => $id])
            ->all();

        $this->set('venda', $vendas);
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
        $vendas = $this->Vendas->newEntity();
        $clientes = $this->Clientes->newEntity();
        $vendedores = $this->Vendedores->newEntity();
        if ($this->request->is('post')) {
            $vendas = $this->Vendas->patchEntity($vendas, $this->request->getData('Vendas'));
            $clientes = $this->Clientes->patchEntity($clientes, $this->request->getData('Clientes'));
            $vendedores = $this->Vendedores->patchEntity($vendedores, $this->request->getData('Vendedores'));
            if ($this->Vendas->save($vendas) || $this->Clientes->save($clientes) || $this->Vendedores->save($vendedores)) {
                $this->Flash->success(__('The venda has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The venda could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vendas','clientes', 'vendedores'));

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
        $venda = $this->Vendas->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('Produtos');
        $this->loadModel('Vendedores');
        $this->loadModel('Clientes');
        $venda = $this->Vendas->newEntity();
        $clientes = $this->Clientes->newEntity();
        $vendedores = $this->Vendedores->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $venda = $this->Vendas->patchEntity($vendas, $this->request->getData('Vendas'));
            $clientes = $this->Clientes->patchEntity($clientes, $this->request->getData('Clientes'));
            $vendedores = $this->Vendedores->patchEntity($vendedores, $this->request->getData('Vendedores'));
            if ($this->Vendas->save($venda) || $this->Clientes->save($clientes) || $this->Vendedores->save($vendedores)) {
                $this->Flash->success(__('The venda has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The venda could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('venda','clientes', 'vendedores'));

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
}
