<?php/*
	Template Name: test
*/
?>
<?php get_header(); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	.quizimgblock {
  text-align: center;
  margin-bottom: 2em;
}

.wrapper {
  display: inline-block;
  vertical-align: top;
  position: relative;
}

.quizimgblock img.quizitems {
  width: 150px;
  height: 150px;
}
.quizimgblock a:hover img{
  opacity: 0.5;
}
.quizimgblock .check {
  left: 30%;
  position: absolute;
  top: 34%;
  transform: translate(-45%, -45%);
}
.quizimgblock a .check {
  opacity: 0;
  z-index: 9;
  transition:opacity .5s ease
}
.quizimgblock .check img {
  border: 0px !important;
}
.quizimgblock a:hover .check {
  opacity: 1;
}
.quiz-answer.active .check {
  opacity: 1;
}
.quizimgblock a:hover .check img {
  opacity: 1 !important;
}



.quizbutton {
  text-align: center;
  margin: 1.25em auto 3em;
}
.quizbutton .quizbtn {
  display: inline-block;
  vertical-align: middle;
  padding: 0.65em 1.75em;
  background-color: #f6700e;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4), inset 0 1px rgba(255, 255, 255, 0.6);
  -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4), inset 0 1px rgba(255, 255, 255, 0.6);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.4), inset 0 1px rgba(255, 255, 255, 0.6);
  border: solid 1px #f06c0b;
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  line-height: 16px;
  text-transform: uppercase;
  color: white;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
}
.quizbutton .quizbtn:hover {
  color: white;
  text-decoration: none;
  background-color: #f77f27;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#f77f27), to(#f6700e));
  background-image: -webkit-linear-gradient(top, #f77f27, #f6700e);
  background-image: -moz-linear-gradient(top, #f77f27, #f6700e);
  background-image: -o-linear-gradient(top, #f77f27, #f6700e);
  background-image: linear-gradient(to bottom, #f77f27, #f6700e);
}
.quizbutton .quizbtn:active {
  color: white;
  text-decoration: none;
  background-color: #f6700e;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#f6700e), to(#f77f27));
  background-image: -webkit-linear-gradient(top, #f6700e, #f77f27);
  background-image: -moz-linear-gradient(top, #f6700e, #f77f27);
  background-image: -o-linear-gradient(top, #f6700e, #f77f27);
  background-image: linear-gradient(to bottom, #f6700e, #f77f27);
  -webkit-box-shadow: 0 0 0 1px #f58029, inset 0 1px 1px #b14f07;
  box-shadow: 0 0 0 1px #f58029, inset 0 1px 1px #b14f07;
}



@media only screen and (max-width: 767px) {
  .check { 
    top:35%; 
    left:35%; 
    transform:translate(-35%, -35%);
  }

    .quizimgblock .check img { 
      max-width: 40px; 
      max-height: 40px;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .quizimgblock a .check {
      vertical-align: middle;
    }

    .check { 
    top:35%; 
    left:35%; 
    transform:translate(-35%, -35%);
  }

    .quizimgblock .check img { 
     max-width: 55px; 
    max-height: 55px;
  }
}




</style>
<div class="page">
	<div class="contentwrapper" id="blogwrap">
		<div id="newswrapper">
			<div class="row">
<section>   
  <div class="quizimgblock">
    <div class="container">
      <div class="row wrapper">
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="#" class="quiz-answer multiple-answers" data-question="1" data-answer="1">
            <span class="check">
              <img src="http://icons.iconarchive.com/icons/cheezen/web-2/64/check-icon.png" alt="check">
            </span>
            <img class="quizitems" src="http://lorempixel.com/165/240/business/" alt="">
          </a>
          <p>Image Caption</p>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="#" class="quiz-answer multiple-answers" data-question="1" data-answer="1">
            <span class="check"><img src="http://icons.iconarchive.com/icons/cheezen/web-2/64/check-icon.png" alt="check"></span>
            <img class="quizitems" src="http://lorempixel.com/165/240/people/4" alt="">
          </a>
          <p>Image Caption</p>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="#" class="quiz-answer multiple-answers" data-question="1" data-answer="1">
            <span class="check"><img src="http://icons.iconarchive.com/icons/cheezen/web-2/64/check-icon.png" alt="check"></span>
            <img class="quizitems" src="http://lorempixel.com/165/240/city/2" alt="">
          </a>
          <p>Image Caption</p>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <a href="#" class="quiz-answer multiple-answers" data-question="1" data-answer="1">
            <span class="check"><img src="http://icons.iconarchive.com/icons/cheezen/web-2/64/check-icon.png" alt="check"></span>
            <img class="quizitems" src="http://lorempixel.com/165/240/abstract/4" alt="">
          </a>
          <p>Image Caption</p>
        </div>

      </div>
    </div>
  </div>
</section>

<section>
  <div class="quizbutton">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <a class="quizbtn" href="../step-two">Next Step</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
	</div>
		</div>

				

	</div>
</div>
</div>
<script>
	$('.quizbutton').hide();

$( ".quiz-answer" ).click(function() {
  $( this ).toggleClass( "active" );  
  if ($(".quiz-answer.active").length > 0) {
    $('.quizbutton').show();
  }

  else {
    $('.quizbutton').hide();
  }

});
</script>
			<!--
<input id="fileupload" type="file" multiple="multiple" />
<hr />
<b>Live Preview</b>
<br />
<br />
<div id="dvPreview">
</div>

</div>
</div>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(function () {
    $("#fileupload").change(function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#dvPreview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "height:100px;width: 100px");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    dvPreview.html("");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
});
</script>-->
<?php get_footer(); ?>
