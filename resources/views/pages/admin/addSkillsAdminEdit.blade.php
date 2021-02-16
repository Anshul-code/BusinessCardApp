@extends('layouts.userEdit')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Add/Remove Skills</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-dark">
            <div class="card-header"><i class="fas fa-chart-bar"></i> Add Skills</div>
            <div class="card-body">
                <form action="/addUserSkillAdminEdit/{{ $user_data->id }}" method="post">
                    @csrf
                    <div class="side-by-side clearfix row">
                        <div class="col-sm-10 mx-auto">
                          <em>Select Skills</em>
                          <select data-placeholder="Type &apos;C&apos; to view" multiple class="chosen-select-no-results w-100" tabindex="11" name="skills[]">
                            <option value=""></option>
                            <option value="PHP">PHP</option>
                            <option value="Java">Java</option>
                            <option value="JavaScript">JavaScript</option>
                            <option value="Android Development">Android Development</option>
                            <option value="Python">Python</option>
                            <option value="C Language">C Language</option>
                            <option value="C++">C++</option>
                            <option value="Jquery">Jquery</option>
                            <option value="Ruby">Ruby</option>
                            <option value="C#">C#</option>
                            <option value="COBOL">COBOL</option>
                            <option value="Visual Basic">Visual Basic</option>
                            <option value="MATLAB">MATLAB</option>
                            <option value="Wordpress">Wordpress</option>
                            <option value="HTML">HTML</option>
                            <option value="XML">XML</option>
                            <option value="BASIC">BASIC</option>
                            <option value="Lisp">Lisp</option>
                            <option value="Pascal">Pascal</option>
                            <option value="Perl">Perl</option>
                            <option value="Swift">Swift</option>
                          </select>
                          @error('skills')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                          <div class="form-group py-2">
                            <em for="other_skill">Other Skill</em>
                            <input type="text" class="form-control" name="other_skill" id="other_skill" placeholder="Other Skill" style="border: solid rgb(165, 165, 165) 0.1px;height: 30px;border-radius:0px;" autocomplete="off">
                          </div>
                          @error('other_skill')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                    </div>
      
                    <div class="text-center py-2">
                        <button type="submit" class="btn btn-dark btn-md" style="border-radius: 0px;"><i class="fas fa-plus"></i> Add Skill</button>
                    </div>
                </form>

                <hr>
                @if(count($skills) != 0 )
                <h5>All Skills Added By you</h5> 
                    <table class="table table-striped table-bordered data-table-skills" style="overflow-x:auto;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Skill</th>
                                <th>Score</th>
                                <th>Created At</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($skills as $row)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $row->skill }}</td>
                                    <td>{{ $row->score }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <form action="/deleteSkillAdminEdit/{{ $row->id }}/{{ $user_data->id }}" method="post">
                                            @csrf
                                            <a type="button" class="btn btn-success btn-sm" href="/editSkillAdminEdit/{{ $row->id }}/{{ $user_data->id }}"><i class="fas fa-edit"></i></a>
                                            {{ method_field("DELETE") }}
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>      
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(".chosen-select-no-results").chosen({max_selected_options: 10});
            $(".chosen-select-no-results").bind("chosen:maxselected", function () { alert("Max skills : 10"); });
        });
    </script>
@endsection