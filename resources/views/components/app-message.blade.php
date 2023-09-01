@if (session("message"))
  <div class="alert alert-{{ session("status") === "success" ? "success" : "danger" }}">
    <button
      type="button"
      class="close" 
      data-dismiss="alert"
      aria-label="Close"
      style="margin-top: 0px;"
      >
      <span aria-hidden="true">×</span>
    </button>
    <i class="ti-info"></i>
    {!! session("message") !!}
  </div>
@endif