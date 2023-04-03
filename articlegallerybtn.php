<?php
/**
 * @version    3.0.0
 * @package    SPEDI Article Gallery Button
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Session\Session;

defined('_JEXEC') or die;

/**
 * Editor Article Gallery Btn
 *
 * @since  1.5
 */
class PlgButtonArticleGalleryBtn extends CMSPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Article Gallery button
	 *
	 * @param string  $name  The name of the button to add
	 *
	 * @return array A two element array of (textToInsert)
	 */
	public function onDisplay($name)
	{
		//$doc  = JFactory::getDocument();

		$link = '../plugins/editors-xtd/articlegallerybtn/display.php?ih_name='.$name;

		//JHTML::_('behavior.modal');
		$button          = new CMSObject();
		$button->modal   = true;
		//$button->class   = 'btn';
		$button->text    = JText::_('Article Gallery');
		$button->name    = 'tag-2';
		//$button->options = "{handler: 'iframe', size: {x: 800, y: 500}}";
		$button->link    = $link;
		$button->options = [
                'height'     => '300px',
                'width'      => '800px',
                'bodyHeight' => '70',
                'modalWidth' => '80',
            	];

		return $button;
	}
}
