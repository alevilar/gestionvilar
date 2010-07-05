<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 01:33:52 -0500 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Clase generica para todos los controladores.
 *
 * @package     gestionvilar
 * @subpackage	gestionvilar.app
 */
class AppController extends Controller {
    var $helpers = array('Html', 'Form', 'Jqform', 'Js' => array('Jquery'), 'Session');
    //var $components = array( 'Auth' , 'RequestHandler');
    var $components = array('RequestHandler','Session','Auth');

    function beforeFilter() {
        $this->Auth->loginError ='Usuario o Password Incorrectos';
        $this->Auth->authError = 'No tiene permisos para acceder aquí';

        $this->Auth->logoutRedirect='/users/login';

        //$this->Auth->allow('login','logout');
        //$this->Auth->allow('*');
        //$this->Auth->allowedActions('*');
        //$this->Auth->allow('home','login','logout');

        $this->Auth->authorize = 'controller';

        /*
              * Esto hace que cuando se auna peticion ajax, vaya  a buscar la vista den
              * tro de la carpeta "ajax" de cada controlador
        */
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug', 1);
            $this->layout = 'ajax';
        }
    }

    function isAuthorized(){
        if ($this->Auth->user('username') != 'dolores' &
            $this->Auth->user('username') != 'alevilar' &
            $this->Auth->user('username') != 'matias'){
                if ($this->action == 'delete'){
                    return false;
                }
        }
        return true;
    }
    
}
?>