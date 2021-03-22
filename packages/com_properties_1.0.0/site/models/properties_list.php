<?php
/**
 * @version     1.0.0
 * @package     com_properties_1.0.0_j3x
 * @copyright   Copyright (C) 2021. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Karthik <karthikmsc@outlook.com> - https://www.linkedin.com/in/naveenkarthik/
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Properties list model
 */
class PropertiesModelProperties_list extends JModelList
{
    /**
     * Constructor
     *
     * @param    array          An optional associative array of configuration settings
     *
     * @see      JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
				'created_by', 'a.created_by',
				'state', 'a.state',
				'ordering', 'a.ordering',
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state
     *
     * Note. Calling getState in this method will result in recursion
     *
     * @param   string  $ordering   An optional ordering field
     * @param   string  $direction  An optional direction (asc|desc)
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function populateState($ordering = null, $direction = null)
    {
        $app = JFactory::getApplication();
        $input = $app->input;

        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Load the list state
        $this->setState('list.start', $input->get('limitstart', 0, 'uint'));
        $this->setState('list.limit', $input->get('limit', $app->get('list_limit', 20), 'uint'));

        // List state information
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data
     *
     * @return    JDatabaseQuery
     * @since    1.6
     */
    protected function getListQuery()
    {
        $query = $this->_db->getQuery(true);

        $query->select('a.id, a.state, a.ordering');

        $query->from('`#__properties_properties_list` AS a');

        $query->select('b.name as created_by');
		$query->leftJoin($this->_db->qn('#__users') . ' AS b ON b.id = a.created_by');

        $query->where('a.state = 1');

        // Search for this word
        $searchWord = $this->getState('filter.search');

        // Search in these columns
        $searchColumns = array(
            'b.name',
        );

        if (!empty($searchWord))
        {
            if (stripos($searchWord, 'id:') === 0)
            {
                // Build the ID search
                $idPart = (int) substr($searchWord, 3);
                $query->where($this->_db->qn('a.id') . ' = ' . $this->_db->q($idPart));
            }
            else
            {
                $query = PropertiesHelpersFrontend::buildSearchQuery($searchWord, $searchColumns, $query);
            }
        }

        // Add the list ordering clause
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');

        if ($orderCol && $orderDirn)
        {
            $query->order($this->_db->escape($orderCol . ' ' . $orderDirn));
        }
        else
        {
            $query->order('a.ordering');
        }

        return $query;
    }

    /** Method to get an array of data items
     *
	 * @return  mixed An array of data on success, false on failure.
	 */
	public function getItems()
    {
        // include_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/form/property.php';
        // $form = new FormPropertyProperties;
		//return $form->appendFieldOptions(parent::getItems())->getAll();
        $properties = PropertiesHelpersApirequest::getProperties();
        $bedrooms = array();
        $neighbourhood = array();
        $price_list = array();
        $properties_new = array();
        foreach($properties as $item){
            $neighbourhood[$item['neighbourhood']] = $item['neighbourhood'];
            //echo $item['neighbourhood'].'<br>';
            $price_list[] = $item['Price']; 
            $bedrooms[] = $item['Bedrooms']; 
            if($item['Publish'] == 1){
                $properties_new[] = $item; 
            }
        }
        sort($price_list);
        sort($bedrooms);
        return array('items' =>  $properties_new, 'neighbourhood' => $neighbourhood, 'bedrooms' => array_unique($bedrooms), 'price_list' => array_unique($price_list));
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
