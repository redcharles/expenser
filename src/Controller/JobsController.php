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

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class JobsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout']);
        $this->viewBuilder()->setLayout('dashboard');
        $this->loadModel('Jobs');
        $this->loadModel('Timesheets');
        $this->loadModel('Expenses');
        $this->loadModel('Employees');
        $this->loadModel('Users');
        $this->loadMOdel('Categories');
    }

    public function index()
    {
        if($this->request->is('post')){
            $data = $this->request->getData();
            
            $method = $data['method'];
            switch($method){
                case "deleteJob":
                    $job = $this->Jobs->get($data['id']);
                    $this->Jobs->delete($job) ? $this->Flash->success("This job has been removed.") : $this->Flash->success("Unable to delete job."); 
                    break;
            }
        }
        
        $jobs = $this->Jobs->find('all');
        $this->set('jobs', $jobs);
    }

    public function new(){
        $this->set('states', statesList);
        if($this->request->is('post')){
            $data = $this->request->getData();
            $this->loadModel('Jobs');
            $jobs = $this->Jobs->newEntity();
            $jobs->number = $data['job_number'];
            $jobs->start_date = $data['start_date'];
            $jobs->location = $data['state'];
            $jobs->budget = $data['budget'];
            $jobs->name = $data['job_name'];
            if($this->Jobs->save($jobs)){
                $this->Flash->success("This job has been added.");
            }
        }
    }

    public function view($jobNumber){
        $getTimesheetInfo = $this->Timesheets->find()
                            ->join([
                                'table' => 'employees',
                                'alias' => 'e',
                                'type' => 'INNER',
                                'conditions' => 'e.id = Timesheets.employee_id'
                            ])
                            ->join([
                                'table' => 'users',
                                'alias' => 'u',
                                'type' => 'LEFT',
                                'conditions' => 'u.id = Timesheets.associated_id'
                            ])
                            ->select([
                                'job_number',
                                'employee_id',
                                'associated_id',
                                'for_date',
                                'days_worked',
                                'manager_first' => 'u.first_name',
                                'manager_last' => 'u.last_name',
                                'first_name' => 'e.first_name',
                                'last_name' => 'e.last_name'
                            ])                                  
                            ->where([
                                'Timesheets.job_number' => $jobNumber
                            ]);          
        
        $getExpensesInfo = $this->Expenses->find()
                            ->join([
                                'table' => 'users',
                                'alias' => 'u',
                                'type' => 'LEFT',
                                'conditions' => 'u.id = Expenses.user_id'
                            ])
                            ->select([
                                'item_name',
                                'item_cost',
                                'quantity',
                                'item_date',
                                'recorded_by_first' => 'u.first_name',
                                'recorded_by_last' => 'u.last_name'
                            ])
                            ->where(['job_number' => $jobNumber]);
        
        $this->set('jobNumber', $jobNumber);
        $this->set('jobTimesheet', $getTimesheetInfo);
        $this->set('jobExpenses', $getExpensesInfo);
    }
}
