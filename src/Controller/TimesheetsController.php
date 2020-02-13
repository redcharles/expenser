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
class TimesheetsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout']);
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function index()
    {
        $this->loadModel('Timesheets');
        $this->loadModel('Employees');
        if($this->request->is('post')){
            $forDate = $this->request->getData('for_date');
            $associated_id = $this->Auth->user('id');
            $timesheet = $this->Timesheets->find()
                                            ->join([
                                                'table' => 'employees',
                                                'alias' => 'e',
                                                'type' => 'INNER',
                                                'conditions' => 'e.id = Timesheets.employee_id'
                                            ])
                                            ->select([
                                                'job_number',
                                                'employee_id',
                                                'associated_id',
                                                'monday',
                                                'tuesday',
                                                'wednesday',
                                                'thursday',
                                                'friday',
                                                'saturday',
                                                'sunday',
                                                'for_date',
                                                'first_name' => 'e.first_name',
                                                'last_name' => 'e.last_name'
                                            ])                                  
                                            ->where([
                                                'Timesheets.for_date' => $forDate, 'Timesheets.associated_id' => $associated_id
                                            ]);
            $this->set('timesheet', $timesheet);
        } else {
            $this->set('timesheet', NULL);
        }
    }


    public function new(){
        $this->loadModel('Timesheets');
        $this->loadModel('Employees');
        $this->loadModel('Jobs');
        if($this->request->is('post')){
            $timesheetsTable = $this->loadModel('Timesheets');
            $timesheets = $timesheetsTable->newEntity();
            $timesheets->job_number = $this->request->getData('job_number');
            $timesheets->employee_id = $this->request->getData('employee_id');
            $timesheets->associated_id = $this->Auth->user('id');
            $timesheets->monday = (int) $this->request->getData('monday');
            $timesheets->tuesday = (int) $this->request->getData('tuesday');
            $timesheets->wednesday = (int) $this->request->getData('wednesday');
            $timesheets->thursday = (int) $this->request->getData('thursday');
            $timesheets->friday = (int) $this->request->getData('friday');
            $timesheets->saturday = (int) $this->request->getData('saturday');
            $timesheets->sunday = (int) $this->request->getData('sunday');
            $timesheets->for_date = $this->request->getData('for_week');
            $timesheets->days_worked =  (int) $timesheets->monday + 
                                        (int) $timesheets->tuesdays + 
                                        (int) $timesheets->wednesday + 
                                        (int) $timesheets->thursday + 
                                        (int) $timesheets->friday + 
                                        (int) $timesheets->saturday + 
                                        (int) $timesheets->sunday;
            
            if($timesheetsTable->save($timesheets)){
                $this->Flash->success('Timesheet Entry has been saved.');
            } else {
                $this->Flash->success('Unable to save timesheet.');
            }
        }
        
        $uid = $this->Auth->user('id');
        $employeeList = $this->Employees->find('all')->where(['associated_user' => $uid]);

        $jobs = $this->Jobs->find('all');

        $this->set('jobs', $jobs);
        $this->set('employees', $employeeList);
    }

}
