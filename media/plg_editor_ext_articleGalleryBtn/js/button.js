// JavaScript code handling the dynamic modal functionality
function openArticleGallery() {
    // Create a new Bootstrap modal
    var modalHTML = `
    <div class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Article Gallery</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Content for the article gallery goes here...</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>`;

    // Append modal HTML to the body
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Show the modal
    $('.modal').modal('show');
}
