@extends('super_admin_inc.template')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel p-4">
            <div class="super_admin_survey">
                <form action="{{ route('super_admin.AddSurvey') }}" method="post" class="form survey_form mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="div_for_hide_first_part">
                        <h4 class="text-info">New Survey</h4>
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            @if ($errors->has('name'))
                                <p role="alert" class='text-danger'><strong>{{ $errors->first('name') }}</strong></p>
                            @endif
                            <input type="text"  id="name" value="{{ old('name') }}"  class="form-control" placeholder="Enter Survey Name" name="name" required >
                        </div>
                        <div class="form-group">
                            <label for="surveytype">Survey Type</label>
                            <select id="surveytype" name="surveytype" required="" class="form-control">
                                <option value="" disabled="" {{ old('surveytype')?'':'selected' }}>Select Survey Type</option>
                                @foreach(App\SurveyTypes::all() as $surveytype)
                                    <option value="{{$surveytype->id}}">{{$surveytype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h3 class="text-info class_for_append_survey_name"></h3>
                    <div class="div_for_dynamic_fields"></div>
                    <input type="hidden" name="data_type" class="data_type_input" >
                    <div class="form-group text-right div_for_next_finish_btn mt-4 ">
                        <button class="btn btn-outline-danger next_question">Next Question</button>
                        <button type="submit" class="btn btn-outline-warning ml-2">Create Survey</button>
                    </div>
                </form>
            </div>
            <div class="super_admin_survey_useful_tools">
                <table class="table table-hover nowrap w-100 text-center">
                    <thead>
                        <tr>
                            <th>
                                Types
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input placeholder="Any Question ?" class="form-control" type="text">
                            </td>
                            <td>
                                <input class="mt-2 radio_btn_question" value="{{App\Questions::input}}" name="type_of_input" type="radio">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control">
                                    <option>Answer 1</option>
                                    <option>Answer 2</option>
                                    <option>Answer 3</option>
                                </select>
                            </td>
                            <td>
                                <input class="mt-2 radio_btn_question" value="{{App\Questions::select}}" name="type_of_input" type="radio">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><input class="ml-4" type="checkbox" > Option 1 </label>
                                <label><input class="ml-4" type="checkbox" > Option 2 </label>
                                <label><input class="ml-4" type="checkbox" > Option 3 </label>
                            </td>
                            <td>
                                <input class="mt-2 radio_btn_question" value="{{App\Questions::checkbox}}" name="type_of_input" type="radio">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><input class="ml-4" name="for_example" type="radio" > Answer 1 </label>
                                <label><input class="ml-4" name="for_example" type="radio" > Answer 2 </label>
                                <label><input class="ml-4" name="for_example" type="radio" > Answer 3 </label>
                            </td>
                            <td>
                                <input class="mt-2 radio_btn_question" value="{{App\Questions::radio}}" name="type_of_input" type="radio">
                            </td>
                        </tr>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th colspan="2">
                                <button class='btn btn-success btn_for_add_question_to_survey'> Add To New Survey </button>
                            </th>
                        </tr>
                    </tfooter>
                </table>
            </div>

        </div>
    </div>
@endsection