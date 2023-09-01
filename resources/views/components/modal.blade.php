<div id="{{ $modalIdentifier }}" class="modal fade show" role="dialog" aria-labelledby="{{ $modalIdentifier }}Title" aria-hidden="true">
  <div class="modal-dialog {{ isset($modalSize) ? $modalSize : " modal-md " }}">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $modalIdentifier }}Title">
          {{ $modalTitle }}
        </h5>
        <button type="button" class="close" 
          data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body" id="{{ $modalIdentifier }}Body">
        {{ $modalBody }}
      </div>
      <div class="modal-footer">
        @if (isset($modalFooter) && !empty($modalFooter))
          {{ $modalFooter }}
        @endif
      </div>
    </div>
  </div>
</div>