<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if (SUBDOMAIN == 'api') {

	Router::connect('/v:version/:action/*', array('controller'=>'api'), array('version'=>'[0-9]+'));
	Router::parseExtensions();
	
} else {

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'home', 'action' => 'index'));

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/search/*', array('controller' => 'pages', 'action' => 'search'));
	Router::connect('/page/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect('/songs', array('controller' => 'songs', 'action' => 'index'));
	Router::connect('/songs/:page', array('controller' => 'songs', 'action' => 'index'));
	Router::connect('/albums', array('controller' => 'albums', 'action' => 'index'));
	Router::connect('/albums/:page', array('controller' => 'albums', 'action' => 'index'));
	Router::connect('/artists/:start', array('controller' => 'artists', 'action' => 'index'), array('pass' => array('start')));
	Router::connect('/artists/:start/:page', array('controller' => 'artists', 'action' => 'index'), array('pass' => array('start')));

/**
 * Fancy rules for making songs nice
 */
	// 	Router::connect('/:controller/:id/:slug', array('action' => 'view'), array('pass' => array('id', 'slug'), 'id' => '[0-9]+'));
	Router::connect('/:artist/:album/:song', array('controller'=>'songs', 'action' => 'view'), array('pass' => array('artist', 'album', 'song')));
	Router::connect('/:artist/:album', array('controller'=>'albums', 'action' => 'view'), array('pass' => array('artist', 'album')));
	Router::connect('/:artist', array('controller'=>'artists', 'action' => 'view'), array('pass' => array('artist')));

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	
/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
// 	require CAKE . 'Config' . DS . 'routes.php';
}
