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
class EmployeeController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout']);
        $this->viewBuilder()->setLayout('dashboard');
        $this->loadModel('Employees');
    }

    public function index()
    {
        $uid = $this->Auth->user('id');
        $employeeList = $this->Employees->find('all')->where(['associated_user' => $uid]);
        $this->set('employees', $employeeList);
        
    }

    public function add()
    {
        if($this->request->is('post')){
            $employeesTable = $this->loadModel('Employees');
            $employee = $employeesTable->newEntity();
            $employee->associated_user = $this->Auth->user('id');
            $employee->first_name  = $this->request->getData('first_name');
            $employee->last_name   = $this->request->getData('last_name');
            $employee->salary      = (float) (null !== $this->request->getData('salary') ? $this->request->getData('salary') : "N/A");
            $employee->employee_number = $this->request->getData('employee_id');
            

            if($employeesTable->save($employee)){
                $this->Flash->success("This employee has been saved.");
            } else {
                $this->Flash->success("Unable to save employee.");
            }
        }
    }

}
