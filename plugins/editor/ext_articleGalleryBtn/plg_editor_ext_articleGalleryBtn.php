<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class PlgEditorExt_articleGalleryBtn extends CMSPlugin
{
    /**
     * Provide a button to the editor.
     *
     * @param   string  $name
     * @param   string  $asset
     * @param   string  $author
     * @param   mixed   $editor
     *
     * @return  object
     */
    public function onDisplay($name, $asset, $author, $editor = null)
    {
        // Load language strings
        $this->loadLanguage();

        $doc = Factory::getApplication()->getDocument();

        if (method_exists($doc, 'getWebAssetManager')) {
            $wa = $doc->getWebAssetManager();

            // Try to load Joomla's Bootstrap bundle (contains modal)
            try {
                $wa->useScript('bootstrap.bundle');
            } catch (\Throwable $e) {
                // If bootstrap.bundle is not registered we proceed anyway and load our script
            }

            // Register and use plugin script
            $wa->registerAndUseScript(
                'plg.ext_articleGalleryBtn',
                'media/plg_editor_ext_articleGalleryBtn/js/button.js',
                [],
                ['version' => 'auto']
            );
        } else {
            // Fallback for older environments
            $doc->addScript('/media/plg_editor_ext_articleGalleryBtn/js/button.js');
        }

        $button = new \stdClass;
        $button->modal = false;
        $button->class = 'btn btn-secondary';
        $button->onclick = 'if (typeof openArticleGallery === "function") { openArticleGallery(); } return false;';
        $button->name = 'extArticleGalleryBtn';
        $button->text = Text::_('PLG_EDITOR_EXT_ARTICLEGALLERYBTN_BUTTON');

        return $button;
    }
}