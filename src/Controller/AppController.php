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

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
        ]);

        // Allow the display action so our PagesController
        // continues to work. Also enable the read only actions.
        $this->Auth->allow(['display', 'view', 'index']);

        define('statesList', ['AL'=>"Alabama",  
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
        'WY'=>"Wyoming"]);
    }
    
    
}
