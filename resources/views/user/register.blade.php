<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="token" content="{{ csrf_token() }}"/>
    <meta name="url" content="{{ URL('/') }}"/>
    <title>Datalumni</title>
    <!-- Icons-->
    <link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @toastr_css
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<div class="signup-frm py-5">
    <div class="container-fluid bg-blur ">
        <div class="signup-frm-wrp m-auto">
            <div class=" signup-frm-header clearfix">
                <ul class="mybread d-flex justify-content-between">
                    <li class="square square-left bg-gre" id="cr-left">
                        <span class="bg-gre step">1</span>
                        <p>Activation de votre compte</p>
                    </li>
                    <li class="square square-center" id="cr-cent">
                        <span class="step">2</span>
                        <p>Complétion du profil</p>
                    </li>
                    <li class="square square-right" id="cr-right">
                        <span class="step">3</span>
                        <p>C'est parti !</p>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="signup-frm-form mt-5">
                <div class="row">
                    <div class="col-md-6 signup-frm-form-lside">
                        <div class="signup-frm-form-lside-wrp h-100 w-100 d-table ">
                            <div class="d-table-cell align-middle">
                                <div class="signup-logo text-center ">
                                    <a href="index.html">
                                        <img src="{{  asset('images/custom/logo2.png') }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 signup-frm-form-rside bg-white">
                        <form id="regForm" action="{{ route('register.user') }}" method="post">
                            @csrf
                            <div class="tab" >
                                <div class="">
                                    <h3 class="text-center">Etape 1</h3>
                                    <div class="linkedin-btn-wrp">
                                        <a href="{{ route('user.linkedin.redirect') }}" class="btn btn-theme-x btn-block my-4 p-3 position-relative"><i class="fa fa-linkedin-square btn-left-design"></i> &nbsp; Se connecter With LinkedIn </a>
                                    </div>
                                </div>
                                <div class="form-group signup-form-group-paswrd">
                                    @if ($errors->has('first_name'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('first_name') }}</strong></p>
                                     @endif
                                    <input type="text" class="form-control" name="first_name" id="first_name" required="" value="{{ old('first_name') }}" placeholder="foarnamme">
                                </div>
                                <div class="form-group signup-form-group-paswrd">
                                     @if ($errors->has('last_name'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('last_name') }}</strong></p>
                                     @endif
                                    <input type="text" class="form-control" name="last_name" id="last_name" required="" value="{{ old('last_name') }}" placeholder="achternamme">
                                </div>
                                <div class="form-group signup-form-group-paswrd">
                                     @if ($errors->has('email'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('email') }}</strong></p>
                                     @endif
                                    <input type="email" class="form-control" name="email" id="email" required="" value="{{ old('email') }}" placeholder="e-mail adresse">
                                </div>
                                <div class="form-group signup-form-group-paswrd">
                                     @if ($errors->has('date'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('date') }}</strong></p>
                                     @endif
                                    <input type="date" class="form-control" name="date" id="date"  value="{{ old('date') }}" required="" placeholder="bertedatum">
                                </div>
                                <div class="form-group mb-2">
                                     @if ($errors->has('password'))
                                        <p role="alert" class='text-danger'><strong>{{ $errors->first('password') }}</strong></p>
                                     @endif
                                    <input type="password" class="form-control" name="password" id="cm-pwd" required="" placeholder="mot de passe">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="password" class="form-control" name="password_confirmation" required="" placeholder="Befêstigje Wachtwurd">
                                </div>

                                {{--<p class="clearfix text-uppercase mt-2">--}}
                                    {{--<a href="#" class="text-right"><small id="forgotpassword" class="form-text text-dark text-capitalize">"j'ai predu mon mot de passe"</small></a>--}}
                                {{--</p>--}}
                            </div>
                            <div class="tab">
                                <h3 class="text-center mb-4">Etape 2</h3>
                                <div class="form-group currently-working-wrp float-right" id="etape2_time" access="true">30</div>
                                <div class="yes-i-am-working">
                                    <div class="form-group">
                                        @if ($errors->has('small_description'))
                                            <p role="alert" class='text-danger'><strong>{{ $errors->first('small_description') }}</strong></p>
                                        @endif
                                        <textarea type="text" class="form-control" name="small_description" placeholder="Small description" required="required">{{old('small_description')}}</textarea>
                                    </div>
                                    <div class="form-group form-control-select-wrp">
                                        <select class="form-control" id="" name="category" required="required">
                                            <option value="" disabled {{ old('category')?'':'selected' }}>Select Category</option>
                                            @if (old('category'))
                                                @foreach(App\Category::all() as $category)
                                                    <option value="{{ $category->id }}"  <?php if($category->id == old('category')) {echo 'selected';} ?>>{{$category->title}}</option>
                                                @endforeach
                                            @else
                                                @foreach(App\Category::all() as $category)
                                                    <option value="{{ $category->id }}">{{$category->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" >
                                <h3 class="text-center mb-4">Etape 3</h3>
                                <h3 class="text-center mb-4">{{ $survey->getSurvey->name }}</h3>
	                            <div class="survey p-4">
	                                @foreach($survey->getSurvey->GetQuestions as $question)
	                                    <div class="form-group">
	                                        <h5>{{ $question->title }}</h5>
	                                            @if( $question->type== \App\Questions::input)
	                                                <input type="text" class="form-control" name="answer{{ $question->id }}">
	                                            @elseif($question->type== \App\Questions::select)
	                                                <select  name="answer{{ $question->id }}"  class="form-control">
		                                                <option value=""></option>
	                                                    @foreach($question->GetAnswer as $answer)
	                                                            <option value="{{ $answer->title }}">{{ $answer->title }}</option>
	                                                    @endforeach
	                                                </select>
												@elseif($question->type== \App\Questions::checkbox)
				                                    @foreach($question->GetAnswer as $answer)
					                                    <div class="form-check">
						                                    <label class="form-check-label" >
							                                    <input type="checkbox" class="form-check-input" value="{{ Crypt::encrypt($answer->id) }}"  name="answer{{ $question->id }}[]">{{ $answer->title }}
						                                    </label>
					                                    </div>
				                                    @endforeach
												@elseif($question->type== \App\Questions::radio)
				                                    @foreach($question->GetAnswer as $answer)
					                                    <div class="form-check">
						                                    <label class="form-check-label"><input type="radio" class="form-check-input" value="{{ $answer->title }}" name="answer{{ $question->id }}" >{{ $answer->title }}</label>
					                                    </div>
				                                    @endforeach
	                                            @endif
	                                    </div>
                                    @endforeach
	                            </div>
                            </div>
{{--                            <div class="tab ">--}}
{{--                                <h3 class="text-center mb-4">Etape 4</h3>--}}
{{--                                <div class="text-center mb-5">--}}
{{--                                    <a href="index.html" class="btn btn-theme-x p3 w-100">Aller</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div style="overflow:auto;">
                                <div style="float:right;margin-top: 10px;">
                                    <button type="button " class="btn btn-theme-x pagination_button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" class="btn btn-theme-x pagination_button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


</body>

<script>
    $(document).ready(function() {
        var windowheight = jQuery(window).height();
        jQuery(".signup-frm ").css("min-height", windowheight + 'px')
    });
    // signup - frm

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        if(n == 1){
            $('#etape2_time').attr('access','true')
            time30(Number($('#etape2_time').html()))
        }else{
            time30(Number($('#etape2_time').html()),true)
        }
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    var timeOut = '';
    function time30(time = null,pause = false) {
        if (time == null){

            var time = 30
        }


        if ($('#etape2_time').attr('access') == 'true'){
            $('#etape2_time').attr('access','false')
            timeOut = setInterval(function(){
                time = time -1
                $('#etape2_time').text(time)
                if(time <= 0){
                    window.location.href = $("meta[name='url']").attr('content')+'/register';
                }
            }, 1000);
        }
        if (pause){
            clearInterval(timeOut);
        }
    }

    $('.pagination_button').click(function (e) {
        e.preventDefault();
    })

    function nextPrev(n) {

        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (!validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        // A loop that checks every input field in the current tab:
	    if (currentTab != 2){

            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }else{
                    $(y[i]).removeClass("invalid");
                }
                if ($(y[i]).attr('type') == 'email'){

                    if (!emailReg.test(y[i].value)) {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }

            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
<script>
    $(document).ready(function(){
        jQuery('.currently-working-wrp input[type=radio][name=Etes-vous-en-poste-actuellemen]').change(function() {
            if (this.value == 'Oui') {
                jQuery('.yes-i-am-working').show();
                jQuery('.no-i-am-working').hide();
            }
            else if (this.value == 'Non') {
                jQuery('.yes-i-am-working').hide();
                jQuery('.no-i-am-working').show();
            }
        });
    });
</script>
<script src="{{ asset('js/custom/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>

@toastr_js
@toastr_render
</html>