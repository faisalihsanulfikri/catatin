@push("script")
  <script type="text/javascript">
    function request(parameter) {
      let formatedParameter = {
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				url: parameter.url,
				method: parameter.method,
				data: parameter.data,
				dataType: parameter.dataType,
				success: parameter.success,
				error: parameter.error,
			};
      if (parameter.enctype !== null) {
        formatedParameter.enctype = parameter.enctype;
      }
      if (parameter.processData !== null) {
        formatedParameter.processData = parameter.processData;
      }
      if (parameter.contentType !== null) {
        formatedParameter.contentType = parameter.contentType;
      }
      if (parameter.beforeSend !== null) {
        formatedParameter.beforeSend = parameter.beforeSend;
      }
      if (parameter.complete !== null) {
        formatedParameter.complete = parameter.complete;
      }
      $.ajax(formatedParameter);
    }
  </script>
@endpush