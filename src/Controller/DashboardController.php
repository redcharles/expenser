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
class DashboardController extends AppController
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

    }

    public function expenses(){
        
        $expensesTable = $this->loadModel('Expenses');
        $previousExpenses = $expensesTable->showExpenses($this->Auth->user('id'));
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
            
            if ($expensesTable->save($expenses)){
                $returnArr['success'] = true;
            }


            $results = json_encode($returnArr);
            $this->response->type('json');
            $this->response->body($results);
            return $this->response;   
        }
    }

    public function manageExpenses(){
        if($this->request->is('post')){
            $expensesTable = $this->loadModel('Expenses');
            $this->Expenses->deleteRecord($this->request->getData('id'));
        }
        
        $this->loadModel('Expenses');
        // $previousExpenses = $this->Expenses->showExpenses($this->Auth->user('id'));

        $expenses = $this->paginate($this->Expenses);

        $this->set(compact('expenses'));
    }

    public function reports(){
        
    }
}
