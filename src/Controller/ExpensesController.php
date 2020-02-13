<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ExpensesController extends AppController
{
    public $paginate = [
        'limit' => 10,
        'order' => [
            'Expenses.item_date' => 'asc'
        ]
    ];
    
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout']);
        $this->viewBuilder()->setLayout('dashboard');

    }

    public function index(){
        $expensesTable = $this->loadModel('Expenses');
        
        $expenses = $this->paginate($this->Expenses);

        if($this->request->is('post')){
            $method = $this->request->getData('method');
            switch($method){

                case "deleteRecord":
                    $this->Expenses->deleteRecord($this->request->getData('id')) ? $this->Flash->success("This entry has been removed.")  : $this->Flash->success("The entry was unable to be deleted.");
                    break;
                    
            }
        }
        
        $this->set(compact('expenses'));
    }

    public function add(){
        
        $expensesTable = $this->loadModel('Expenses');
        $previousExpenses = $expensesTable->showExpenses($this->Auth->user('id'));
        $statesList = array('AL'=>"Alabama",  
        'AK'=>"Alaska",  
        'AZ'=>"Arizona",  
        'AR'=>"Arkansas",  
        'CA'=>"California",  
        'CO'=>"Colorado",  
        'CT'=>"Connecticut",  
        'DE'=>"Delaware",  
        'DC'=>"District Of Columbia",  
        'FL'=>"Florida",  
        'GA'=>"Georgia",  
        'HI'=>"Hawaii",  
        'ID'=>"Idaho",  
        'IL'=>"Illinois",  
        'IN'=>"Indiana",  
        'IA'=>"Iowa",  
        'KS'=>"Kansas",  
        'KY'=>"Kentucky",  
        'LA'=>"Louisiana",  
        'ME'=>"Maine",  
        'MD'=>"Maryland",  
        'MA'=>"Massachusetts",  
        'MI'=>"Michigan",  
        'MN'=>"Minnesota",  
        'MS'=>"Mississippi",  
        'MO'=>"Missouri",  
        'MT'=>"Montana",
        'NE'=>"Nebraska",
        'NV'=>"Nevada",
        'NH'=>"New Hampshire",
        'NJ'=>"New Jersey",
        'NM'=>"New Mexico",
        'NY'=>"New York",
        'NC'=>"North Carolina",
        'ND'=>"North Dakota",
        'OH'=>"Ohio",  
        'OK'=>"Oklahoma",  
        'OR'=>"Oregon",  
        'PA'=>"Pennsylvania",  
        'RI'=>"Rhode Island",  
        'SC'=>"South Carolina",  
        'SD'=>"South Dakota",
        'TN'=>"Tennessee",  
        'TX'=>"Texas",  
        'UT'=>"Utah",  
        'VT'=>"Vermont",  
        'VA'=>"Virginia",  
        'WA'=>"Washington",  
        'WV'=>"West Virginia",  
        'WI'=>"Wisconsin",  
        'WY'=>"Wyoming");
        
        $expensesTable = $this->loadModel('Categories');
        $jobsTable = $this->loadModel('Jobs');

        $this->set("jobs", $jobsTable->find('all'));
        $this->set("categories", $this->Categories->find('all'));
        $this->set('states', $statesList);
        $this->set('prevExpenses', $previousExpenses);

        if($this->request->is('post')){
            $returnArr = [];  
            $returnArr['success'] = false;
          
            $returnArr['data'] = $this->request->getData();
            $expensesTable = $this->loadModel('Expenses');
                                              
            $expenses = $expensesTable->newEntity();
            $expenses->user_id = $this->Auth->user('id');
            $expenses->item_name = $this->request->getData('item_name');
            $expenses->item_number = $this->request->getData('item_number');
            $expenses->taxable = $this->request->getData('taxable');
            $expenses->item_cost = $this->request->getData('item_cost');
            $expenses->item_date = $this->request->getData('item_date');
            $expenses->quantity = $this->request->getData('quantity');
            $expenses->purchase_state = $this->request->getData('purchase_state');
            $expenses->cat_name = $this->request->getData('cat_name');
            $expenses->job_number = $this->request->getData('job_number');
            
            $returnArr['data'] = $expenses;

            if ($expensesTable->save($expenses)){
                $returnArr['success'] = true;
            }


            $results = json_encode($returnArr);
            $this->response->type('json');
            $this->response->body($results);
            return $this->response;   
        }
    }

    

}
