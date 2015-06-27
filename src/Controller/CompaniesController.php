<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Schema\Collection;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Employee;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
    /*
     * Stulpelių sąrašas, kuriuos galima rikiuoti
     */
    public $paginate = [
        'sortWhitelist' => [
            'Companies.name', 'employee_count','Employees.name','Employees.surname','Employees.employment_date',
            'Employees.email'
        ]
    ];
    /*
     *  Metodas sugeneruotas su cakebake
     */
    public function initialize(){
        parent::initialize();
        // Įkraunam komponentą, kad mųsū kontrolleris galėtu priimti AJAX užklausas
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index metodas
     *
     * @return void Atvaizduoja kompanijų sąrašą ir suskaičiuoja kiek kiekviena kompanija turi darbuotojų
     */
    public function index()
    {
        // Užkraunam komapijų objektą
        $companies = $this->Companies->find();
        // Parenkam kompanijos ID ir suskaičiuojam kiek kompanijoje yra darbuotojų
        $companies->select(['Companies.id','Companies.name','employee_count' => $companies->func()->count('Employees.id')]);
        // Sujungiam darbuotojų ir kompanijų lenteles left join tipo sujungimu, kad užklausa išvestu visas kompanijas,
        // net jeigu ir kompanija neturi darbuotoju.
        $companies->leftJoin([
                'employees'
            ], [
                'employees.company_id = companies.id'
            ]
        );
        // Sugrupuojam rezultatą pagal kompanijos pavadinimą
        $companies->group('Companies.name');
        // Rodom visus rezultatus
        $companies->all();

        // Siunčiam duomenis į MVC View.
        $this->set('companies', $this->paginate($companies));
        // Serializuojam duomenis, AJAX tipo uzklausoms.
        $this->set('_serialize', ['companies']);

    }

    /**
     * View metodas
     *
     * @param string|null $id Company id.
     * @return void Parodo vienos kompanijos duomenis ir darbuotojus
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => ['Employees']
        ]);
        $employees = TableRegistry::get('Employees');
        $this->set('company', $company);
        $this->set('employees', $this->paginate($employees->find()->where(['company_id' => $company->id])));
        $this->set('_serialize', ['company']);
    }

    /**
     * Metodas sugeneruotas automatiškai naudojant Cake Bake.
     * Mano patobulinta flash žinutė.
     *
     * Add metodas
     *
     * @return void Įrašo naują kompaniją į duomenų bazę. Sėkmingai įrašius nukreipia į pagrindinį puslapį.
     */
    public function add()
    {

        // Sukuriam tuščią kompanijos objektą
        $company = $this->Companies->newEntity();

        // Pasitikrinam kokiu būdu buvo atsiųsta užklausa
        if ($this->request->is('post')) {
            // Užpildom kompanijos objektą su gautais duomeninis iš HTML formos
            $company = $this->Companies->patchEntity($company, $this->request->data);
            // Bandom išsaugoti duomenis į duomenų bazę
            if ($this->Companies->save($company)) {
                // Sukuriam žinutę, kad operacija įvykdita sėkmingai
                $this->Flash->success(__('The company has been saved.'));
            } else {
                // Sukuria išsamią klaidos pranešimo žinutę
                $this->Flash->error(__('The company could not be saved. Errors occurred:'),[
                    'params' => [
                        'error' => $company->errors()
                    ]
                ]);
            }
            // Nukreipiame į pagrindinį puslapį
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
        // Atvaizduojam tiktais add.ctp neįskaitant layout.
        $this->render('add');
    }

    /**
     * Edit metodas
     *
     * Sugeneruotas automatiškai naudojant Cake Bake
     *
     * @param string|null $id Company id.
     * @return void Atnaujina kompanijos duomenis. Sėkmingai atnaujinus perkelia į kompanijos puslapį.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Surandam kompaniją kurią norim atnaujinti
        $company = $this->Companies->get($id, [
            'contain' => ['Employees']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));
            } else {
                $this->Flash->error(__('The company could not be saved. Errors occurred:'),[
                    'params' => [
                        'error' => $company->errors()
                    ]
                ]);
            }
            return $this->redirect(['action' => 'view', $company->id]);
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
        $this->render('add', false);
    }

    /**
     * Delete method
     *
     * Sugeneruotas automatiškai su Cake Bake.
     * Mano pridėtos flash žinutės skirtingom užklausom ir nukreipimas į index puslapi.
     *
     * @param string|null $id Company id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get','post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            // Jeigu užklausa gauta GET metodu sukuriam flash žinutę.
            ($this->request->is('get'))?$this->Flash->success(__('The company has been deleted.')):false;
            // Jeigu užklausa gauta AJAX metodu atvaizduojam žinute JSON formatu
            ($this->request->is('post'))?$this->set('response', [true, __('The company has been deleted.')]):false;
        } else {
            ($this->request->is('get'))?$this->set('response', [false, __('The company could not be deleted. Please, try again.')]):false;
            ($this->request->is('post'))?$this->Flash->error(__('The company could not be deleted. Please, try again.')):false;
        }
        // Jeigu užklausa buvo gauta GET metodu, nukreipiam į pagrindinį puslapį
        if ( !$this->request->is('post') ) {
            return $this->redirect(['action' => 'index']);
        }
    }
}
