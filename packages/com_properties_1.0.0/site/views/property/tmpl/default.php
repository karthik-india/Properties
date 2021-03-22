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
<div class="property-details">
<?php // echo "<pre>";print_r($this->item);echo "</pre>";?>
<div class="contenct-left">
	<div class="image-slide" id="slick-lightbox">
	<?php if(isset($this->item['Images'][0]['url'])){
		$slide_html = '';
		$slide_nav_html = '';
		foreach($this->item['Images'] as $image){
			$slide_html .='<div class="item"><a href="'.$image['url'].'" target="_blank"><img src="'.$image['url'].'" alt="'.$image['hash'].'" /><div class="fillview"><i class="fa fa-expand"></i></div></a></div>';
			//$slide_nav_html .='<div class="item"><img src="'.$image['formats']['thumbnail']['url'].'" alt="'.$image['hash'].'" /></div>';
			$slide_nav_html .='<div class="item" style="background-image:url('.$image['formats']['thumbnail']['url'].');"></div>';
		 } }?>
	<?php echo $slide_html; ?>
	</div>
	<div class="slider-nav">
		<?php echo $slide_nav_html; ?>
	</div>
</div>
<div class="contenct-right">
	<div class="top"><i class="fa fa-share-alt"></i><i class="fa fa-heart"></i></div>
	<div class="p-title"><h1><?php echo $this->item['Title']; ?></h1></div>
	<div class="p-price-info"><span class="price"><?php echo $this->currency ?><?php echo number_format($this->item['Price']);?></span><span class="bedrooms"><?php echo $this->item['Bedrooms'];?> bed</span> <span class="floorarea"><?php echo $this->item['Floor_Area'];?> sqm</span></div>
	<div class="p-bedrooms"><?php echo $this->item['Bedrooms'];?> Bedroom apartment for sale</div>
	<div class="contact-text"><a href="#" class=""><i class="fa fa-home"></i> Please contact us</a></div>
	<div class="contact-btn"><a href="#" class="btn-style-1">Contact Agent</a></div>
	<div class="features">
		<h3>Facts & Features</h3>
		<table>
			<tr><td><strong>Price per sqm:</strong></td><td><?php echo $this->item['Price_Per_Sqm']; ?></td></tr>
			<?php if(isset($this->item['Brochure'][0]['url'])){?>
			<tr><td><strong>Brochure:</strong></td><td><a download href="<?php echo $this->item['Brochure'][0]['url']; ?>" target="_blank">Download Brochure</a></td></tr>
			<?php }?>
			<?php if(isset($this->item['Floor_Plans'][0]['url'])){?>
			<tr><td><strong>Brochure:</strong></td><td class="lightbox"><a download href="<?php echo $this->item['Floor_Plans'][0]['url']; ?>" target="_blank">View Floorplan</a></td></tr>
			<?php }?>
		</table>
	</div>
	<div class="p-description">
		<?php echo $this->item['Description'];?>
	</div>
	<?php if($this->item['Negotiator']){?>
		<div class="negotiator">
			<div classs="image">
				<img src="<?php echo $this->item['Negotiator']['Image']['formats']['thumbnail']['url']?>" alt="<?php echo $this->item['Negotiator']['Name'];?>">
			</div>
			<div class="n-info">
				<div class="name"><?php echo $this->item['Negotiator']['Name'];?></div>
				<div class="designation"><?php echo $this->item['Negotiator']['Designation'];?></div>
				<div class="phone"><a href="tel:<?php echo $this->item['Negotiator']['Phone'];?>"><?php echo $this->item['Negotiator_phone'];?></a><a href="mailto:<?php echo $this->item['Negotiator']['Email'];?>">Email</a></div>
			</div>
		</div>
	<?php }?>
	<div id="p-map" class="p-map" data-lat="<?php echo $this->item['Latitude'];?>" data-long="<?php echo $this->item['Longitude'];?>">
	
</div>
</div>
</div>
