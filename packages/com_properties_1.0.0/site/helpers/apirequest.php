<?php
/**
 * @version     1.0.0
 * @package     com_properties_1.0.0_j3x
 * @copyright   Copyright (C) 2021. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Karthik <karthikmsc@outlook.com> - https://www.linkedin.com/in/naveenkarthik/
 */

defined('_JEXEC') or die;

/**
 * Properties helper
 */
class PropertiesHelpersApirequest
{
    /**
     * Get the Properties list from API server
     *
     * @param	string		$api_url		Search for this text
     */
    public static function getProperties($api_url='')
    {
        $app = JFactory::getApplication();
		$params = $app->getParams('com_properties');
        if(empty($api_url)){
            $api_url = $params->get('apiendpoint','');
        } 
        if(empty($api_url)){
            $api_url = 'https://carolineolds-strapi-dev.q.starberry.com/properties?_limit=50';
        }           
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }
}
