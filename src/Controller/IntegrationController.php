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
use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\DataService\DataService;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class IntegrationController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout']);
        $this->viewBuilder()->setLayout('dashboard');
    }
    
    public function index($code = null, $realmId = null){
        if($code !== null && $realmId !== null){
            $dataService = DataService::Configure(array(
                'auth_mode' => 'oauth2',
                'ClientID' => "ABKgvXISInIylLQ2QWV0TxIvPoygV4Uahl8LEdJ4prVVtyujYq",
                'ClientSecret' => "QsvJSOBwOnYuNOg5zxNLkR5lf9OUYskb82dJDfPY",
                'RedirectURI' => "https://developer.intuit.com/v2/OAuth2Playground/RedirectUrl",
                'scope' => "com.intuit.quickbooks.accounting",
                'baseUrl' => "Development"
            ));
            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
    
            $accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($code, $realmId);
            $accessTokenValue = $accessToken->getAccessToken();
            $refreshTokenValue = $accessToken->getRefreshToken();
            
            $this->loadModel('Users');
            $uid = $this->Auth->user('id');
            $user = $this->Users->get($uid);
            
            $user->access_token = $accessTokenValue;
            $user->refresh_token = $refreshTokenValue;
            if($this->Users->save($user)){
                return $this->redirect(
                    ['controller' => 'Integration', 'action' => 'quickbooks']
                );
            }

            $this->set("accessToken", $accessTokenValue);
            $this->set("refreshToken", $refreshTokenValue);
        } else {
                /**
                 * Here we authorize our user, if not yet authorized.
                 * 1) Get Auth Code
                 * 2) Get OAuth 2.0 tokens using Auth Code
                 * 3) Make API Calls
                 * 4) Profit
                 */

                $dataService = DataService::Configure(array(
                    'auth_mode' => 'oauth2',
                    'ClientID' => "ABKgvXISInIylLQ2QWV0TxIvPoygV4Uahl8LEdJ4prVVtyujYq",
                    'ClientSecret' => "QsvJSOBwOnYuNOg5zxNLkR5lf9OUYskb82dJDfPY",
                    'RedirectURI' => "https://developer.intuit.com/v2/OAuth2Playground/RedirectUrl",
                    'scope' => "com.intuit.quickbooks.accounting",
                    'baseUrl' => "Development"
                ));
                $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
                
                $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
                
                $this->set("link", $authorizationCodeUrl);        
        }
        
        
    }

    public function quickbooks(){
        $this->loadModel('Users');
        $uid = $this->Auth->user('id');
        $user = $this->Users->get($uid);
        $accessToken = $user->access_token;
        $refreshToken = $user->refresh_token;
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => "ABKgvXISInIylLQ2QWV0TxIvPoygV4Uahl8LEdJ4prVVtyujYq",
            'ClientSecret' => "QsvJSOBwOnYuNOg5zxNLkR5lf9OUYskb82dJDfPY",
            'accessTokenKey' => $accessToken,
            'refreshTokenKey' => $refreshToken,
            'QBORealmID' => '4620816365008916200',
            'baseUrl' => "Development"
        ));
        // $data = $dataService->getCompanyInfo();
        $data = $dataService->Query("SELECT * FROM Invoice");
        $this->set('user', $data);
    }

}
