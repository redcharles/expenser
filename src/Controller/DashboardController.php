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
    public function manageCategories(){
        $expensesTable = $this->loadModel('Categories');
        
        $this->set("categories", $this->Categories->find('all'));
        if($this->request->is('post')){
            $method = $this->request->getData('method');
            $name = $this->request->getData('category_name');
            switch($method) {
                case 'addCat':
                    $this->Categories->addCat($name) ? $this->Flash->success("The category \"$name\" was created.") : $this->Flash->success("The category \"$name\" was not created.");
                    break;
                case 'deleteCat':
                    $this->Categories->deleteCat($this->request->getData('id')) ? $this->Flash->success("This category has been deleted") : $this->Flash->success("This category has not been deleted.");
                    break;
            }
                        
        }
    }
        
    public function reports(){
        
    }
}
