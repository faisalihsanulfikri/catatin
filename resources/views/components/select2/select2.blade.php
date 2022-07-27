  
  <link rel="stylesheet" href="{{ asset("plugins/select2/select2.min.css") }}">
  <style>
    .select2-selection__rendered {
      line-height: 35px !important;
    }
    .select2-container .select2-selection--single {
      height: 35px !important;
    }
    .select2-selection__arrow {
      height: 34px !important;
    }
    .select2-search--inline {
      display: contents; /*this will make the container disappear, making the child the one who sets the width of the element*/
    }
    .select2-search__field:placeholder-shown {
      width: 100% !important; /*makes the placeholder to be 100% of the width while there are no options selected*/
    }
  </style>

  <script src="{{ asset("plugins/select2/select2.min.js") }}"></script>
