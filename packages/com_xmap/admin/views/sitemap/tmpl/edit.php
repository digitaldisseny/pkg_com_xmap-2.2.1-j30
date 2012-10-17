<?php
/**
 * @version             $Id$
 * @copyright		Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license             GNU General Public License version 2 or later; see LICENSE.txt
 * @author              Guillermo Vargas (guille@vargas.co.cr)
 */
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
        if (task == 'sitemap.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
        	Joomla.submitform(task, document.getElementById('item-form'));
        } else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_xmap&view=sitemap&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
	<div class="row-fluid">
		<!-- Begin Content -->
		<div class="span10 form-horizontal">
			<!-- Tabs buttons -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('XMAP_SITEMAP_DETAILS_FIELDSET'); ?></a></li>
				<!-- Menus -->
				<li><a href="#menus-details" data-toggle="tab"><?php echo JText::_('XMAP_FIELDSET_MENUS'); ?></a></li>
				<!-- Other Params -->
				<?php $fieldSets = $this->form->getFieldsets('attribs'); ?>
				<?php foreach ($fieldSets as $name => $fieldSet) : ?>
					<li><a href="#attrib-<?php echo $name;?>" data-toggle="tab"><?php echo JText::_($fieldSet->label);?></a></li>
				<?php endforeach; ?>
			</ul>
			<!-- Tabs Content -->
			<div class="tab-content">
				<!-- General tab -->
				<div class="tab-pane active" id="general">
					<fieldset class="adminform">
						<div class="control-group form-inline">
							<?php echo $this->form->getLabel('title'); ?> <?php echo $this->form->getInput('title'); ?> <?php echo $this->form->getLabel('alias'); ?> <?php echo $this->form->getInput('alias'); ?>
						</div>
						<?php echo $this->form->getInput('introtext'); ?>
					</fieldset>
				</div>
				<!-- Menus tab -->
				<div class="tab-pane" id="menus-details">
					<?php echo $this->form->getInput('selections'); ?>
				</div>
				<!-- Extra attributes tabs -->
				<?php  $fieldSets = $this->form->getFieldsets('attribs'); ?>
				<?php foreach ($fieldSets as $name => $fieldSet) : ?>
					<div class="tab-pane" id="attrib-<?php echo $name;?>">
						<?php if (isset($fieldSet->description) && trim($fieldSet->description)) : ?>
							<p class="tip"><?php echo $this->escape(JText::_($fieldSet->description));?></p>
						<?php endif; ?>
						<?php foreach ($this->form->getFieldset($name) as $field) : ?>
							<div class="control-group">
								<?php echo $field->label; ?>
								<div class="controls">
									<?php echo $field->input; ?>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				<?php endforeach; ?>
			</div>
			<input type="hidden" name="task" value="" />
			<?php echo $this->form->getInput('is_default'); ?>
    		<?php echo JHtml::_('form.token'); ?>
		</div>
		<!-- End Content -->
		<!-- Begin Sidebar -->
		<div class="span2">
			<h4><?php echo JText::_('JDETAILS');?></h4>
			<hr />
			<fieldset class="form-vertical">

				<div class="control-group">
					<div class="controls">
						<?php echo $this->form->getValue('title'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $this->form->getLabel('state'); ?>
					<div class="controls">
						<?php echo $this->form->getInput('state'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $this->form->getLabel('access'); ?>
					<div class="controls">
						<?php echo $this->form->getInput('access'); ?>
					</div>
				</div>
			</fieldset>
		</div>
		<!-- End Sidebar -->
	</div>
</form>
