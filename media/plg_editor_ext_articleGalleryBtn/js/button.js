(function(window, document) {
    'use strict';

    function createModalElement() {
        var existing = document.getElementById('extArticleGalleryModal');
        if (existing) {
            return existing;
        }

        var div = document.createElement('div');
        div.id = 'extArticleGalleryModal';
        div.className = 'modal fade';
        div.tabIndex = -1;
        div.setAttribute('aria-hidden', 'true');

        div.innerHTML = '\
<div class="modal-dialog modal-lg">\
  <div class="modal-content">\
    <div class="modal-header">\
      <h5 class="modal-title">Article Gallery</h5>\
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\
    </div>\
    <div class="modal-body">\
      <div id="extArticleGalleryModalBody">Caricamento...</div>\
    </div>\
    <div class="modal-footer">\
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>\
    </div>\
  </div>\
</div>';

        document.body.appendChild(div);
        return div;
    }

    window.openArticleGallery = function() {
        if (typeof bootstrap === 'undefined' || typeof bootstrap.Modal === 'undefined') {
            console.warn('Bootstrap 5 bundle non trovato. Verifica che il plugin carichi bootstrap.bundle via WebAssetManager.');
            alert('Impossibile aprire la gallery: componente modal non disponibile.');
            return;
        }

        var modalEl = createModalElement();

        // Popola il body (puoi usare fetch per caricare contenuto dinamico)
        var body = modalEl.querySelector('#extArticleGalleryModalBody');
        body.innerHTML = '<p>Caricamento galleria...<\/p>';

        // Esempio di caricamento dinamico (decommenta e adatta l'URL):
        // fetch('/index.php?option=com_yourcomponent&task=gallery.view&format=raw')
        //   .then(function(resp){ return resp.text(); })
        //   .then(function(html){ body.innerHTML = html; })
        //   .catch(function(){ body.innerHTML = '<p>Errore nel caricamento della galleria.<\/p>'; });

        // Inizializza e mostra la modal con l'API di Bootstrap 5
        var bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();

        // Rimuovi l'elemento dalla DOM quando chiuso per evitare duplicati (opzionale)
        modalEl.addEventListener('hidden.bs.modal', function onHidden() {
            modalEl.removeEventListener('hidden.bs.modal', onHidden);
            try {
                modalEl.parentNode.removeChild(modalEl);
            } catch (e) { /* ignore */ }
        });
    };
})(window, document);
