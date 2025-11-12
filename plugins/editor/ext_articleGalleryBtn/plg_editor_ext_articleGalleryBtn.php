<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * Plugin editor - ext_articleGalleryBtn (Joomla 4 compatible)
 */
class PlgEditorExt_articleGalleryBtn extends CMSPlugin
{
    /**
     * Application object (iniettato da CMSPlugin)
     *
     * @var \Joomla\CMS\Application\CMSApplication
     */
    protected $app;

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
        // Carica le stringhe di lingua
        $this->loadLanguage();

        $doc = Factory::getApplication()->getDocument();

        // Joomla 4: usa WebAssetManager per registrare/caricare asset
        if (method_exists($doc, 'getWebAssetManager')) {
            $wa = $doc->getWebAssetManager();
            // Registra e usa lo script (path relativo alla root del sito, media/...)
            $wa->registerAndUseScript(
                'plg.ext_articleGalleryBtn',
                'media/plg_editor_ext_articleGalleryBtn/js/button.js',
                [],
                ['version' => 'auto']
            );
            // Esempio per style:
            // $wa->registerAndUseStyle('plg.ext_articleGalleryBtn.styles', 'media/plg_editor_ext_articleGalleryBtn/css/style.css');
        } else {
            // Fallback (non comune in Joomla 4)
            $doc->addScript(JURI::root(true) . '/media/plg_editor_ext_articleGalleryBtn/js/button.js');
        }

        // Costruisci l'oggetto bottone atteso dall'editor
        $button = new \stdClass;
        $button->modal = false;
        $button->class = 'btn btn-secondary';
        $button->onclick = 'if (typeof openArticleGallery === "function") { openArticleGallery(); } return false;';
        $button->name = 'extArticleGalleryBtn';
        $button->text = Text::_('PLG_EDITOR_EXT_ARTICLEGALLERYBTN_BUTTON');

        return $button;
    }
}