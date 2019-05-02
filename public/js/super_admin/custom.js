$(document).ready(function () {
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $('#csv_upload').on('change',function () {
        $(this).parents('form').submit();
    })

    $(document).on('click','.SADelete',function(){
        var access = $(this).attr('access');
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        var href = $(this).attr('data');
        var _this = this;
        $.ajax({
            type:'post',
            url: url+'/super_admin/Delete'+href,
            data:{id:access,_token:token},
            success: function(r){
                if (r.success) {
                    toastr.success('success')
                    $(_this).parents('tr').remove()
                }else{
                    toastr.error('something is wrong');
                }
            }
        })
    })
    var count = 0;
    var input_type;
    $(document).on("click",".btn_for_add_question_to_survey",function(){
        var show_btns;
        count++;
        var radio_btn_question = $('input[name=type_of_input]:checked').val();
        var type;
        if ( radio_btn_question == 1 ){
            type = `<div class="form-group"> <label for="question${count}" >Question ${count} <span class="text-danger">* </span></label><i data-toggle="collapse" data-target="#question_toggle${count}" class="fas fa-sort-down float-right for_down_icon"></i><div id="question_toggle${count}" class="collapse form-group show" ><input type="text" id="question${count}" name="quest_input" class="form-control mt-2 input_for_question${count}" placeholder="Please Enter Your Question"></div></div>`
            show_btns = true;
            input_type = radio_btn_question;
        }
        else if ( radio_btn_question == 2 || radio_btn_question == 3 || radio_btn_question == 4 ) {
            type = `<div class="form-group form_for_quantity"><label for="quantity_quest">Quantity of your Answers <span class="text-danger">*</span></label><input id="quantity_quest" type="number" value="2" min='2' class="form-control input_for_answer_count mt-2" placeholder="Quantity of your answers"><br><button class="btn btn-primary btn_for_show_answers_quantity">Show</button></div>`;
            show_btns = false;
            input_type = radio_btn_question;
        }
        if(count > 1 && input_type == '1'){
            $(".next_question").slideDown(500)
        }
        if( type ){
            if ( show_btns ){
                $(".div_for_next_finish_btn").slideDown(500)
            }
            $(".super_admin_survey_useful_tools").slideUp(500)
            $(".div_for_dynamic_fields").append(type);
        }
        $(".data_type_input").val(radio_btn_question)
    })
    $(document).on("click",".next_question",function(e){
        var survey_form = $(".survey_form").serializeArray();
        var name_survey = $("#name").val();
        var token = $('meta[name="token"]').attr('content');
        var surveytype = $("#surveytype").val();
        if(name_survey && surveytype){
            e.preventDefault();
            var input_val = $(".input_for_question"+count).val();
            var url = $('meta[name="url"]').attr('content');
            if ( input_val  ) {
                $(".input_for_question"+count).removeClass('class_error_input')
                $(".input_for_question"+count).removeAttr('name')
                var data_type = $(".data_type_input").val();
                $(".super_admin_survey_useful_tools").slideDown(500);
                $(".next_question").slideUp(500);
                survey_form.push({name: 'data_type', value:data_type});
                survey_form.push({name: 'next_btn', value:true});
                $.ajax({
                    type:'post',
                    url: url+'/super_admin/AddSurvey',
                    data:survey_form,
                    success:function(res){
                        if ( count == 1 ){
                            $(".div_for_hide_first_part").slideUp(500);
                            $(".class_for_append_survey_name").append(res.survey_name);
                            $(".class_for_append_survey_name").slideDown(700);
                        }
                        $('.input_for_answer').attr('disabled',true)
                        $('.input_for_answer').attr('disabled',true)
                        $(".input_for_question"+count).attr('disabled',true);
                    }
                })
            }
            else{
                $(".input_for_question"+count).addClass('class_error_input')
            }
        }
    })
    $(document).on("click",".btn_for_show_answers_quantity",function(e){
        e.preventDefault();
        $(".next_question").slideDown(500)
        var number_answers = $(".input_for_answer_count").val();
        if ( number_answers > 1 ){
            var html = `<div class="form-group"> <label for="question${count}">Question ${count} <span class="text-danger">*</span></label><i data-toggle="collapse" data-target="#question_toggle${count}" class="fas fa-sort-down float-right for_down_icon"></i><div id="question_toggle${count}" class="collapse form-group show"><input id="question${count}" type='text' placeholder="Please Enter Your Question" name="quest_input" class='form-control mt-2 input_for_question${count}'>`;
            for(var i = 0 ; i < number_answers ; i++){
                html+= `<label for="answer_${i}_for_question_${count}">Answer ${i + 1} for Question ${count} </label><input name="answers[]" type='text' id="answer_${i}_for_question_${count}" placeholder="Answere ${i+1}" class='form-control mt-2 input_for_answer'>`
            }
            html += "</div></div>"
            $(".div_for_dynamic_fields").append(html)
            $(".form_for_quantity").remove();
            $(".div_for_next_finish_btn").slideDown(500)
        }
        else {
            alert("Answers should be minimum 2.")
        }
    })
    $(document).on("click",".editGroup",function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        var _this = this;
        $.ajax({
            type:'post',
            url: url+'/super_admin/EditGroup',
            data:{id:access,_token:token},
            success:function(res){
                if (res.success) {
                    $(".div_for_img_edit_part").empty();
                    $("#school").empty();
                    $("#id_for_group").val(access);
                    $("#name_of_group").val(res.groups.name);
                    $("#date_of_creation").val(res.groups.date_of_creation);
                    if (res.groups.logo){
                        $(".div_for_img_edit_part").append(`<img class="img_for_details_page" src='${url + "/images/Groups/" + res.groups.logo}'>`);
                    }

                    $("#contact_first_name").val(res.groups.contact_first_name);
                    $("#contact_last_name").val(res.groups.contact_last_name);
                    $("#contact_email").val(res.groups.contact_email);
                    $("#administrator_first_name").val(res.groups.administrator_first_name);
                    $("#administrator_last_name").val(res.groups.administrator_last_name);
                    for (var key in res.groupchoosedschools) {
                        var option = `<option value=${res.groupchoosedschools[key].school_id} selected>${res.groupchoosedschools[key].name}</option>`
                        $("#school").append(option);
                    }
                    for (var key in res.showschools) {
                        var option = `<option value=${res.showschools[key].id} >${res.showschools[key].name}</option>`
                        $("#school").append(option);
                    }
                    $('.multiple').select2();
                }
            }
        })
    })
    $(document).on("click",".editCompany",function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        $.ajax({
            type:'post',
            url: url+'/super_admin/EditCompany',
            data:{id:access,_token:token},
            success:function(res){
                if (res.success) {
                    $("#id_for_company").val(access);
                    $("#name").val(res.company.name);
                    $("#last_activity").val(res.company.last_activity);
                    $("#first_name").val(res.company.first_name);
                    $("#last_name").val(res.company.last_name);
                }
            }
        })
    })

    $(document).on("click",".edituser",function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        var _this = this;
        $.ajax({
            type:'post',
            url: url+'/super_admin/EditUser',
            data:{id:access,_token:token},
            success:function(res){
                if (res.success) {
                    $(".div_for_avatar").empty()
                    $("#id_for_user").val(access);
                    $("#first_name").val(res.users.first_name);
                    $("#last_name").val(res.users.last_name);
                    $("#email").val(res.users.email);
                    $("#city").val(res.users.city);
                    $("#graduation_year").val(res.users.graduation_year);
                    $('#date_of_import').val(res.users.date_of_import)
                    var linkedin;
                    if( res.users.linkedin == 1 ) {
                        linkedin = `<p class="alert alert-success">Loged In With Linkedin</p>`;
                    }
                    else{
                        linkedin = `<p class='alert alert-danger'>Loged In Without Linkedin</p>`;
                    }
                    if(res.users.avatar){
                        var user_avatar = `<img class="img_for_modal" src="${url + '/images/users/' + res.users.avatar}">`;
                        $(".div_for_avatar").append(user_avatar);
                    }
                    $(".div_for_linkedin").empty()
                    $(".div_for_linkedin").append(linkedin)
                    $('#category option').each(function(e){
                        for (var key in res.categorys) {
                            if ($('#category option').eq(e).attr('value') == res.categorys[key].category_id) {
                                $('#category option').eq(e).attr('selected','selected')
                            }
                        }
                    })
                    $('#degree option').each(function(e){
                        for (var key in res.degrees) {
                            if ($('#degree option').eq(e).attr('value') == res.degrees[key].degree_id) {
                                $('#degree option').eq(e).attr('selected','selected')
                            }
                        }
                    })
                    $('#school option').each(function(e){
                        for (var key in res.schools) {
                            if ($('#school option').eq(e).attr('value') == res.schools[key].school_id) {
                                $('#school option').eq(e).attr('selected','selected')
                            }
                        }
                    })
                    $('.multiple').select2();
                    if (res.users.status == 1 ) {
                        setTimeout(function(){
                            $('.user_status').attr('checked',true);
                        },200)
                    }
                }
            }
        })
    })
    $(document).on('click','.SendEmailToUser',function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        $.ajax({
            type:'post',
            url: url+'/super_admin/SendMailNewsletter',
            data:{id:access,_token:token},
            success:function(res){
                toastr.success('Done');
            }
        })
    })
    var count_for_degree_scool = 0
    $(document).on("change",".school_input_for_user",function(){
        var schools = $("#schools").val();
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        count_for_degree_scool++;
        $(".div_for_degree_of_the_school").slideToggle(500)
        if(count_for_degree_scool > 1){
            $(".div_for_degree_of_the_school").slideToggle(500)
        }
        $.ajax({
            type:'post',
            url: url+'/super_admin/GetDegreeOfTheSchools',
            data:{_token:token,schools:schools},
            success:function(res){
                $("#degree").empty();
                var html = '';
                if(! jQuery.isEmptyObject(res.DegreesArray) && res.DegreesArray.length > 0){
                    html += `<option value="" disabled="" >Degrees</option>`;
                    for( var i = 0 ; i < res.DegreesArray.length ; i ++ ){
                        html+= `<option value="${res.DegreesArray[i].id}" >${res.DegreesArray[i].name}</option>`;
                    }

                }else{
                    html += `<option value="" disabled="" >There Is No Degree</option>`;
                }
                $("#degree").append(html);
            }
        })
    })
    $(document).on("click",".editDegree",function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        var _this = this;
        $.ajax({
            type:'post',
            url: url+'/super_admin/EditDegree',
            data:{id:access,_token:token},
            success:function(res){
                if (res.success) {
                    $("#id_for_degree").val(access);
                    $("#name_of_degree").val(res.degree.name);
                }
            }
        })
    })
    $(document).on("click",".row_for_details",function(){
        var data_id = $(this).data('id');
        var data_type = $(this).data('type');
        var url = $('meta[name="url"]').attr('content');
        window.open(url + '/super_admin/' + data_type + 'Details/' + data_id, '_blank')
    })
    $(document).on("click",".editJobBoard",function(){
        var access = $(this).attr('access')
        var token = $('meta[name="token"]').attr('content');
        var url = $('meta[name="url"]').attr('content');
        var _this = this;
        $.ajax({
            type:'post',
            url: url+'/super_admin/EditJobBoard',
            data:{id:access,_token:token},
            success:function(res){
                if (res.success) {
                    $("#id_for_jobboard").val(access);
                    $("#title").val(res.job.title);
                    $("#link").val(res.job.link);
                    $('#school option').each(function(e){
                        if ($('#school option').eq(e).attr('value') == res.job.school_id) {
                            $('#school option').eq(e).attr('selected','selected')
                        }
                    })
                    if (res.job.status == 1 ) {
                        setTimeout(function(){
                            $('.job_status').attr('checked',true);
                        },200)
                    }
                }
            }
        })
    })
    var table = $('.datatable').DataTable({
        responsive: true,
        scrollX:true,
    });
    $(document).on("click",".d-md-down-none",function(){
        setTimeout(function(){
            table.draw();
        },400)

    })
    $('.multiple').select2();


    // $('.editor').froalaEditor()

    $('.editor').froalaEditor({
        heightMin: 300,
        imageMove: true,
        imageUploadParam: 'file',
        imageUploadMethod: 'post',
        imageUploadURL: 'UploadImage',
        imageUploadParams: {
            froala: 'true',               // This allows us to distinguish between Froala or a regular file upload.
            _token: $('meta[name="token"]').attr('content'),  // This passes the laravel token with the ajax request.
        }
    });
    $(document).on("click",".btn_for_show_admin_part",function(){
        $(".div_for_form_admin_fields").slideToggle(1000)
    })
    $(document).on("click",".btn_for_show_add_degreet",function(){
        $(".div_for_form_add_degree").slideToggle(1000)
    })
    $(document).on("click",".btn_for_show_add_survey",function(){
        $(".div_for_form_add_survey").slideToggle(1000)
    })
})