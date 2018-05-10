@extends('layout')
@section('main')
  <section id="main-section">
    <div class="container-fluid detail-header-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="detail-header">
              <h1 class="detail-title col-md-6">
               <?php
                if(appLang == "_vi")
                  echo "về chúng tôi";
                else
                  echo "About us";
              ?>                
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 about-content">
          <?php
           if(appLang == "_vi"){
           	echo $about->content_vi;
           }
           else {
           	echo $about->content_en;
           }
           ?>
        </div>
      </div>
    </div>
    <div class="container">
	    <div class="col-md-6 col-md-offset-3 form-contact">
	    <h2>
	    <?php 
	    						if(appLang == "_vi"){
	    							echo "Liên hệ với chúng tôi";
	                }
	                else {
	                  echo "Give us a message";
	                }
	     ?>
			</h2>
	                  {!! Form::open(array('action' => 'MailController@send', 'class' => 'contact-form', 'files'=>true, 'enctype' => 'multipart/form-data', 'id'=>'contact-form')) !!}
	                    <input type="email" id="contact-form-email" name="email" class="email-contact" placeholder="Enter your email" required />
	                    <input type="text" id="contact-form-name" name="name" placeholder="Enter your name" style="margin-top:5px;" required />
	                    <input type="phone" id="contact-form-phone" name="phone" placeholder="Enter your phone number" style="margin-top:5px;" required />

	                    <textarea class="text-contact" name="content" placeholder="Your Message!" required></textarea>
	                    {!! Form::file('attach[]', array('multiple'=>true, 'id'=>'attach')) !!}
	                    <button type="submit" class="btn btn-primary">Send Message</button>
	                  {!! Form::close() !!}
	      </div>
    </div>
  </section>
@stop
