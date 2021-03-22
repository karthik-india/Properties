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

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Properties list controller
 */
class PropertiesControllerProperties_list extends PropertiesController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'properties_list', $prefix = 'PropertiesModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
