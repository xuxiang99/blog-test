@extends('layouts.base')

@section('main')

<div class="mainbar">
	<div class="article">
	  <h2><span>Contact</span></h2><div class="clr"></div>
	  <p>You can find more of my free template designs at my website. For premium commercial designs, you can check out DreamTemplate.com.</p>
	</div>
	<div class="article">
	  <h2><span>Send us</span> mail</h2><div class="clr"></div>
	  <form action="/contact/store" method="post" id="sendemail">
	  	{{ csrf_field() }}
		  <ol>
			  <li>
			    <label for="name">Name (required)</label>
			    <input id="name" name="name" class="text" />
			  </li>
			  <li>
			    <label for="email">Email Address (required)</label>
			    <input type="email" id="email" name="email" class="text" />
			  </li>
			  <li>
			    <label for="website">Website</label>
			    <input type="url" id="website" name="website" class="text" />
			  </li>
			  <li>
			    <label for="message">Your Message (required)</label>
			    <textarea id="message" name="message" rows="8" cols="50"></textarea>
			  </li>
			  <li>
			    <input type="image" name="imageField" id="imageField" src="/images/submit.gif" class="send" />
			    <div class="clr"></div>
			  </li>
		  </ol>
	  </form>
		@if (Session::has('message'))
	    	{{Session::get('message')}}
	    @endif
	</div>
</div>

@endsection