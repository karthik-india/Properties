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
class PropertiesHelpersFrontend
{
    /**
     * Build the query for search from the search columns
     *
     * @param	string		$searchWord		Search for this text

     * @param	string		$searchColumns	The columns in the DB to search for
     *
     * @return	string		$query			Append the search to this query
     */
    public static function buildSearchQuery($searchWord, $searchColumns, $query)
    {
        $db = JFactory::getDbo();

        $where = array();

        foreach ($searchColumns as $i => $searchColumn)
        {
            $where[] = $db->qn($searchColumn) . ' LIKE ' . $db->q('%' . $db->escape($searchWord, true) . '%');
        }

        if (!empty($where))
        {
	        $query->where('(' . implode(' OR ', $where) . ')');
        }

        return $query;
    }
    public static function formatPhoneNum($phone){
        $phone = preg_replace("/[^0-9]*/",'',$phone);
        //if(strlen($phone) != 10) return(false);
        $phone_new  = '+'.substr($phone,0,3);
        $phone_new .= ' '.substr($phone,3,2);
        $phone_new .= ' '.substr($phone,6,2);
        $phone_new .= ' '.substr($phone,8,2);
        return($phone_new);
      }
}
