@extends("landing.template.main") 

@section("subtitle", "Home")

@section("content")
	@include("landing.home.components.about")	
	@include("landing.home.components.feature")	
	@include("landing.home.components.greeting")	
	@include("landing.home.components.vision-mission")	
	@include("landing.home.components.teacher")	
	@include("landing.home.components.article")	
	@include("landing.home.components.summary", ['summary' => $summary])	
	@include("landing.home.components.extracurricular")	
	@include("landing.home.components.gallery", ['galleries' => $galleries])	
	@include("landing.home.components.testimony")	
	@include("landing.home.components.contact")	

  @component("components.ajax-request")
  @endcomponent
@endsection