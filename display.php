<?php
/**
 * @version    3.0.0
 * @package    SPEDI Article Gallery Button
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

  define( '_JEXEC', 1 );
  define( 'DS', DIRECTORY_SEPARATOR );
  define( 'JPATH_BASE', realpath( '..'.DS.'..'.DS.'..'.DS ) );
  require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
  require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );

  //$mainframe = JFactory::getApplication('administrator');
  jimport( 'joomla.plugin.plugin' );
  $ih_name = addslashes( $_GET['ih_name'] );

  $db = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->select($db->quoteName(array('id', 'title')));
  $query->from($db->quoteName('#__phocagallery_categories'));
  $query->where($db->quoteName('published') . ' = '. $db->quote(1));
  $query->order('ordering ASC');
  $db->setQuery($query);
  $results = $db->loadObjectList();
 ?>

 <html>
  <head>
    <title><?php echo JText::_('Article Gallery - (by SPEDI srl)') ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="dist/style.min.css" />
    <!-- <script src="/comuni_alt/media/jui/js/jquery.min.js" type="text/javascript"></script>
    <script src="/comuni_alt/media/jui/js/jquery-migrate.min.js" type="text/javascript"></script> -->
   <!--<link rel="stylesheet" type="text/css" href="dialog.css" />
   <script type="text/javascript" src="helper.js"></script>
   <script type="text/javascript" src="jscolor.js"></script>-->
   <script type="text/javascript">
    function InsertHtmlDialogokClick() {
      var catid = document.getElementById("catid").value;
      if (catid != '') {
        catid = "catid="+catid;
      }
      var only_image = document.getElementById("only_image").value;
      if (only_image != '') {
        only_image = "|image="+only_image;
      }
      var tmpl = document.getElementById("tmpl").value;
      if (tmpl != '') {
        tmpl = "|tmpl="+tmpl;
      }
      // var fullWidth = document.forms.phGalleryForm.fullWidth.value;
      // if(fullWidth == 1)
      //   wContainer = "|wContainer="+fullWidth;
      // else{
      //   var wContainer = document.getElementById("wContainer").value;
      //   wContainer = "|wContainer="+wContainer;
      // }
      var limit = document.getElementById("limit").value;
      if (limit != '') {
        limit = "|limit="+limit;
      }

      var hSlider = document.getElementById("hSlider").value;
      if (hSlider != '') {
        hSlider = "|hSlider="+hSlider;
      } else{
        hSlider = "";
      }

      var catLink = document.forms.phGalleryForm.catLink.value;
      catLink = "|catLink="+catLink;

      var col = document.forms.phGalleryForm.col.value;
      if(tmpl == 'thumb_slider')
        col = "";
      else
        col = "|col="+col;
      // if(catLink == 1)
      //   catLink = "|catLink="+catLink;
      // else{
      //   //var catLink = document.getElementById("catLink").value;
      //   catLink = "|catLink="+catLink;
      // }

      // var wThumb = document.getElementById("wThumb").value;
      // if (wThumb != '') {
      //   wThumb = "|wThumb="+wThumb;
      // }
      // var hThumb = document.getElementById("hThumb").value;
      // if (hThumb != '') {
      //   hThumb = "|hThumb="+hThumb;
      // }

      var tag = "{articleGallery "+catid+only_image+tmpl+limit+hSlider+col+catLink+"}";

      window.parent.jInsertEditorText(tag, '<?php echo $ih_name ?>');
      window.parent.jModalClose();
     }

     function InsertHtmlDialogcancelClick() {
       window.parent.jModalClose();
     }

     // funzione che testa i cambiamenti di template della galleria
     function onChangeTmpl(){
      var theme = document.getElementById("tmpl").value;
      if(theme != 'thumb_slider'){
        document.getElementById("height-slider").style.display = 'none';
        document.getElementById("hSlider").value = "";
      }
      else
        document.getElementById("height-slider").style.display = 'table-row';

      if(theme == 'thumb_slider'){
        document.getElementById("col-num").style.display = 'none';
        document.getElementById("col").value = "";
      }
      else
        document.getElementById("col-num").style.display = 'table-row';

     }
   </script>

   <style media="screen">
     @import url('https://fonts.googleapis.com/css?family=Titillium+Web:,400,400i,600');
     table{
       font-family: 'Titillium Web', sans-serif;
     }
     td{
       vertical-align: middle !important;
     }
     fieldset{
       border: 0 !important;
     }
    .btn{
      cursor: pointer;
    }

   </style>
   </head>
   <body>
     <form name="phGalleryForm" onSubmit="return false;">
       <fieldset>
         <table class="table">
           <tr>
             <td><label for="catid" class="col-form-label">Seleziona la categoria</label></td>
             <td>
               <select name="catid" id="catid" class="input form-control form-control-sm">
                 <?php foreach ($results as $cat) : ?>
                 <option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                 <?php endforeach; ?>
               </select>
             </td>
           </tr>
           <tr>
             <td><label for="only_image" class="col-form-label">Scegli le sole immagini che desideri mostrare</label></td>
             <td>
               <input type="text" class="form-control form-control-sm" id="only_image" name="only_image" value="">
             </td>
           </tr>
           <tr>
             <td><label for="tmpl" class="col-form-label">Seleziona il template</label></td>
             <td>
               <select name="tmpl" id="tmpl" class="input form-control form-control-sm" onchange="onChangeTmpl()">
                 <option value="thumb_slider">Slider</option>
                 <option value="grid">Griglia</option>
                 <option value="masonry">Griglia fluida</option>
                 <option value="grid_fluid">Griglia fluida 2</option>
                 <option value="table-orizzontal">Tabella orizzontale</option>
                 <option value="table-vertical">Tabella verticale</option>
               </select>
             </td>
           </tr>
           <tr>
             <td colspan="2">
                <div class="alert alert-info" role="alert">
                  <p style="margin-bottom:0; margin-top:0;"><strong>Slider: </strong>produce una slider con miniature scorrevoli.</p>
                  <p style="margin-bottom:0; margin-top:0;"><strong>Griglia: </strong>produce una griglia con immagini tutte a dimensione fissa.</p>
                  <p style="margin-bottom:0; margin-top:0;"><strong>Griglia fluida: </strong>produce una griglia con immagini a dimensione automatica.</p>
                </div>
             </td>
           </tr>
           <tr id="image-limit">
             <td><label for="limit" class="col-form-label">Numero massimo di immagini</label></td>
             <td>
               <input type="number" class="form-control form-control-sm" id="limit" name="limit" value="10">
             </td>
           </tr>
           <tr id="height-slider">
             <td><label for="hSlider" class="col-form-label">Altezza immagini</label></td>
             <td>
               <input type="text" class="form-control form-control-sm" id="hSlider" name="hSlider" value="400">
             </td>
           </tr>
           <tr id="col-num" style="display: none;">
             <td><label for="col" class="col-form-label">Immagini per riga</label></td>
             <td>
               <select name="col" id="col" class="input form-control form-control-sm">
                 <option value="6">2</option>
                 <option value="4">3</option>
                 <option value="3">4</option>
                 <option value="2">6</option>
               </select>
             </td>
           </tr>
           <tr>
             <td><label for="cat-link" class="col-form-label">Link alla categoria</label></td>
             <td>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="catLink" id="cat-link-1" value="1" checked="true">
                 <label class="form-check-label" for="cat-link-1">Si</label>
               </div>
               <div class="form-check">
                 <input class="form-check-input" type="radio" name="catLink" id="cat-link-0" value="0">
                 <label class="form-check-label" for="cat-link-0">No</label>
               </div>
             </td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
         <table class="table">
           <tr>
             <td>
               <input type="submit" class="btn btn-primary" value="<?= JText::_('Inserisci il codice') ?>" onClick="InsertHtmlDialogokClick()">
               <input type="button" class="btn btn-secondary" value="<?= JText::_('Annulla') ?>" onClick="InsertHtmlDialogcancelClick()">
             </td>
           </tr>
         </table>
       </fieldset>

     </form>
   </body>
 </html>
