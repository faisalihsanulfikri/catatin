

  <div id="{{ $modalIdentifier }}" class="modal" tabindex="-1" 
    role="dialog" aria-labelledby="{{ $modalIdentifier }}Title" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="{{ $modalIdentifier }}Title">
            {{ $modalTitle }}
          </h4>
          <button type="button" class="close" 
            data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="{{ $modalIdentifier }}Body">
          {{ $modalBody }}
        </div>
        <div class="modal-footer">
          @if (isset($modalFooter) && !empty($modalFooter))
            {{ $modalFooter }}
          @else
            <button type="button" data-dismiss="modal"
              class="btn btn-danger waves-effect">
              Tutup
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>