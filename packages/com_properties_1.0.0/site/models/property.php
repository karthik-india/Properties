<?php
/**
 * @version     1.0.0
 * @package     com_properties_1.0.0_j3x
 * @copyright   Copyright (C) 2021. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Karthik <karthikmsc@outlook.com> - https://www.linkedin.com/in/naveenkarthik/
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Properties detail model
 */
class PropertiesModelProperty extends JModelLegacy
{
	/**
	 * The item to hold data
	 *
	 * @return object
	 */
    var $_item = null;

	/**
	 * Get the data
	 *
	 * @return  object
	 *
	 * @since   1.6
	 */
	public function getItem()
	{
		$app = JFactory::getApplication();
		$input = $app->input;
		$property_id = $input->get('id', '', 'string');
		if($property_id == ''){
			return false;
		}
		$properties = PropertiesHelpersApirequest::getProperties();
		$property_data = array();
		foreach($properties as $item){
			if($item['_id'] == $property_id){
				$item['Negotiator_phone'] = PropertiesHelpersFrontend::formatPhoneNum($item['Negotiator']['Phone']);
				$property_data = $item;				
			}			
			if(count($property_data)){
				break;
			}
		}
		return $property_data;
	}
	/** Method to get currency code
     *
	 * @return  Properties currency code
	 */
    public function getCurrency()
    {
        $app = JFactory::getApplication();
		$params = $app->getParams('com_properties');
        $currency = $params->get('currency','EUR');
        $response = '';
        switch($currency){
            case 'USD': $response = '&#36;';
                        break;
            case 'EUR': $response = '&euro;';
                        break;
        }
        return  $response;
    }
}
