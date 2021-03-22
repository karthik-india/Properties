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

jimport('joomla.application.component.view');

/**
 * Properties detail view
 */
class PropertiesViewProperty extends JViewLegacy
{
    protected $state;
    protected $item;
    protected $params;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
		$app	= JFactory::getApplication();
        $user	= JFactory::getUser();

        $this->state 				= $this->get('State');
        $this->currency		= $this->get('Currency');
        $this->item 				= $this->get('Item');
        $this->pagination           = $this->get('pagination');
        $this->params 				= $app->getParams('com_properties');

        // Throw exeption if errors
        if (count($errors = $this->get('Errors')))
        {
            throw new Exception(implode("\n", $errors));
        }
        
        if($this->_layout == 'edit')
        {
            $authorised = $user->authorise('core.create', 'com_properties');

            if ($authorised !== true) {
                throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
            }
        }

        // Load the template header here to simplify the template
        $this->loadTemplateHeader();

        $this->_prepareDocument();

        parent::display($tpl);
    }

    /**
     * Prepares the document
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function _prepareDocument()
    {
        $app   = JFactory::getApplication();
        $menus = $app->getMenu();
        $title = null;

        // Because the application sets a default page title,
        // we need to get it from the menu item itself
        $menu = $menus->getActive();

        if ($menu)
        {
            $this->params->def('page_heading', $this->params->get('page_title', $menu->title));
        }
        else
        {
            $this->params->def('page_heading', JText::_('COM_PROPERTIES_DEFAULT_PAGE_TITLE'));
        }

        $title = $this->params->get('page_title', '');

        if (empty($title))
        {
            $title = $app->get('sitename');
        }
        elseif ($app->get('sitename_pagetitles', 0) == 1)
        {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        }
        elseif ($app->get('sitename_pagetitles', 0) == 2)
        {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }

        $this->document->setTitle($title);

        if ($this->params->get('menu-meta_description'))
        {
            $this->document->setDescription($this->params->get('menu-meta_description'));
        }

        if ($this->params->get('menu-meta_keywords'))
        {
            $this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
        }

        if ($this->params->get('robots'))
        {
            $this->document->setMetadata('robots', $this->params->get('robots'));
        }
    }

    /**
     * Load the template header data here to simplify the template
     */
    protected function loadTemplateHeader()
    {
        JHtml::_('jquery.framework');

        $document = JFactory::getDocument();
        $document->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?ver=5.7');
        $document->addStyleSheet('components/com_properties/assets/css/slick.css');
        $document->addStyleSheet('components/com_properties/assets/css/slick-lightbox.css');
        $document->addStyleSheet('components/com_properties/assets/css/properties.css');        
        $document->addScript('components/com_properties/assets/js/slick.min.js');
        $document->addScript('components/com_properties/assets/js/slick-lightbox.min.js');
        $document->addScript('components/com_properties/assets/js/detail.js');
    }
}
