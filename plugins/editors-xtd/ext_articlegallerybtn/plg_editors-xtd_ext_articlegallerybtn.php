<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * PlgEditorsXtdExt_articlegallerybtn - Editor button plugin (Joomla 4 compatible)
 */
class PlgEditorsXtdExt_articlegallerybtn extends CMSPlugin
{
    /**
     * Provide a button to the editor (editors-xtd plugins use onDisplay)
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
        $this->loadLanguage();

        $doc = Factory::getApplication()->getDocument();

        if (method_exists($doc, 'getWebAssetManager')) {
            $wa = $doc->getWebAssetManager();

            // Try to load Joomla's Bootstrap 5 bundle (contains modal)
            try {
                $wa->useScript('bootstrap.bundle');
            } catch (\Throwable $e) {
                // ignore if not available
            }

            // Register and use plugin script
            $wa->registerAndUseScript(
                'plg.editors-xtd.ext_articlegallerybtn',
                'media/plg_editors-xtd_ext_articlegallerybtn/js/button.js',
                [],
                ['version' => 'auto']
            );
        } else {
            // Fallback
            $doc->addScript('/media/plg_editors-xtd_ext_articlegallerybtn/js/button.js');
        }

        $button = new \stdClass;
        $button->modal = false;
        $button->class = 'btn btn-secondary';
        $button->onclick = 'if (typeof openArticleGallery === "function") { openArticleGallery(); } return false;';
        $button->name = 'ext_articlegallerybtn';
        $button->text = Text::_('PLG_EDITORS_XTD_EXT_ARTICLEGALLERYBTN_BUTTON');

        return $button;
    }
}