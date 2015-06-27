<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 */
class EmployeesController extends AppController
{
    public $paginate = [
        'sortWhitelist' => [
            'name', 'employment_date','surname','email'
        ]
    ];
    /*
     * Metodas sugeneruotas su Cake Bake
     */
    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Add method
     *
     * Sugeneruota automatiškai su Cake Bake.
     *
     * @param integer $id Company id
     * @return void Sukuria nauja darbuotoją
     */
    public function add($company)
    {
        /* Sugeneruota Cake Bake */
        $employee = $this->Employees->newEntity();
        $employee->company_id = $company;

        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
            } else {
                /* Mano */
                $this->Flash->error(__('The employee could not be saved. Errors occurred:'),[
                    'params' => [
                        'error' => $employee->errors()
                    ]
                ]);
                /* -- */
            }
        /* -- */
            /* Mano */
            return $this->redirect(['controller' => 'Companies', 'action' => 'view', $company]);
        }
        // Gaunam sąrašą kompanijų
        $companies = $this->Employees->Companies->find('list');
        $this->set('companies', $companies);
        /* -- */
        /* Cake Bake */
        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']);
        $this->render('add');
        /* -- */
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        /* Cake Bake */
        $employee = $this->Employees->get($id, [
            'contain' => ['Companies'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->data, [
                'associates' => ['Companies']
            ]);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
            } else {
                /* Mano */
                $this->Flash->error(__('The employee could not be saved. Errors occurred:'),[
                    'params' => [
                        'error' => $employee->errors()
                    ]
                ]);
                /* -- */
            }

            /* Mano */
            return $this->redirect(['controller' => 'Companies', 'action' => 'view', $employee->company_id]);
        }
        $companies = $this->Employees->Companies->find('list');
        $this->set('companies', $companies);
            /* -- */
        $this->set(compact('employee'));
        $this->set('_serialize', ['employee']);
        /* -Cakebake- */
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get','post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            /* Mano */
            ($this->request->is('get'))?$this->Flash->success(__('The employee has been deleted.')):false;
            ($this->request->is('post'))?$this->set('response', [true, __('The employee has been deleted.')]):false;
        } else {
            ($this->request->is('get'))?$this->set('response', [false, __('The employee could not be deleted. Please, try again.')]):false;
            ($this->request->is('post'))?$this->Flash->error(__('The employee could not be deleted. Please, try again.')):false;

        }
        if ( !$this->request->is('post') ) {
            return $this->redirect(['controller' => 'Companies', 'action' => 'view', $employee->company_id]);
        }
            /* -- */
    }
}
