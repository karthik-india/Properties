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

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
			<?php if ($this->escape($this->params->get('page_heading'))) : ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php else : ?>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			<?php endif; ?>
        </h1>
    </div>
<?php endif; ?>
<div class="properties-list">
    <div class="pl-search-bar">
        <div class="bedrooms-f">
        <?php //echo "<pre>";print_r($this->items['neighbourhood']);echo "</pre>";?>
            <select class="bedrooms-field">
                <option>All Bedrooms</option>
                <?php foreach ($this->items['bedrooms'] as $item){ ?>
                    <option value=".br-<?php echo $item;?>"><?php echo $item;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="neighbourhood-f">       
            <select class="neighbourhood-field">
                <option>Any Neighbourhood</option>
                <?php foreach ($this->items['neighbourhood'] as $k => $item){ ?>
                    <option value="<?php echo $k;?>"><?php echo $item;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="min-price-f">       
            <select class="min-price-field">
                <option>Min Price</option>
                <?php foreach ($this->items['price_list'] as $item){ ?>
                    <option value="<?php echo $item;?>"><?php echo $item;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="max-price-f">       
            <select class="max-price-field">
                <option>Max Price</option>
                <?php foreach ($this->items['price_list'] as $item){ ?>
                    <option value="<?php echo $item;?>"><?php echo $item;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="sortby-f">    
            <select class="sortby-field">
                <option>Sort By</option>
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
        </div>
        <div class='result-count'>
            Result : <?php echo count($this->items['items']);?>
        </div>
    </div>
    <div class="pl-search-result">
        <?php
       
        foreach ($this->items['items'] as $i => $item){
            //echo "<pre>";print_r($item);echo "</pre>";
            //echo "<pre>";print_r( $item['Images']);echo"</pre>";
            
        ?>
            <div class="property-item sameheight <?php echo $item['Publish'] ;?> br-<?php echo $item['Bedrooms'];?>" data-href="<?php echo JRoute::_('index.php?option=com_properties&view=property&id='.$item['_id']);?>">
               
                <?php if(isset($item['Images'][0]['formats']['thumbnail']['url'] )){?>
                    <div class="image" style="background-image:url(<?php echo $item['Images'][0]['formats']['thumbnail']['url'];?>)"></div>
                <?php }else{ ?>
                    <div class="image" style="background-image:url(<?php echo JURI::root();?>components/com_properties/assets/images/default_thumbnail.jpg);"></div>
                <?php } ?>
                <?php /* <div class="image">
                <?php if(isset($item['Images'][0]['formats']['thumbnail']['url'] )){?>
                    <img src="<?php echo $item['Images'][0]['formats']['thumbnail']['url'];?>" alt="<?php echo $item['Images'][0]['formats']['thumbnail']['name']?>"/>
                <?php }else{ ?>
                    <img src="<?php echo JURI::root();?>components/com_properties/assets/images/default_thumbnail.jpg" alt="<?php echo $item['Title']; ?>"/>
                <?php } ?>
                </div> <?php } */?>
                <div class="content ">
                    <h4><?php echo $item['Title']; ?></h4>
                    <div class="bedrooms"><?php echo $item['Bedrooms'];?> Bedroom apartment for sale</div>
                    <div class="price"><?php echo number_format($item['Price']);?><span><?php echo $this->currency ?></span></div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php /*<form action="<?php echo JRoute::_('index.php?option=com_properties&view=properties_list'); ?>" method="post" name="adminForm" id="adminForm">
    <div id="filter-bar" class="btn-toolbar">
        <div class="filter-search btn-group pull-left">
            <label for="filter_search" class="element-invisible"><?php echo JText::_('JSEARCH_FILTER');?></label>
            <input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>..." value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('JSEARCH_FILTER'); ?>" />
        </div>
        <button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><?php echo JText::_('JSEARCH_FILTER'); ?></button>
        <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="item-created_by">
						<?php echo JHtml::_('grid.sort',  'COM_PROPERTIES_HEADING_FRONTEND_LIST_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
					</th>
                </tr>
            </thead>
            <tbody>
                <?php 
               // echo "<pre>";print_r($this->items);echo "</pre>";
                foreach ($this->items as $i => $item) : ?>
                <tr class="<?php echo ($i % 2) ? "odd" : "even"; ?>">
                    <td class="item-created_by">
						<?php echo $item->created_by; ?>
					</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination center">
            <?php echo $this->pagination->getListFooter(); ?>
        </div>
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    </div>
</form>
*/ ?>