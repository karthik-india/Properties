<?php
/**
 * @version     1.0.0
 * @package     com_properties_1.0.0_j3x
 * @copyright   Copyright (C) 2021. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Karthik <karthikmsc@outlook.com> - https://www.linkedin.com/in/naveenkarthik/
 */

// No direct access
defined('_JEXEC') or die;

// Register class prefix
JLoader::registerPrefix('Properties', JPATH_COMPONENT);

// Load the controller
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Properties');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
