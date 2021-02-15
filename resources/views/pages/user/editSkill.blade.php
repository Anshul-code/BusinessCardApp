@extends('layouts.user')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6">Update Skill</h1>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> 
                Edit Skills 
                <div class="float-right">
                    <a name="back" class="btn btn-light text-dark btn-sm" href="/addSkills" role="button"><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="/updateSkill/{{ $skill_info->id }}" method="post">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="side-by-side clearfix row">
                        <div class="col-sm-10 mx-auto">
                          <div class="form-group py-2">
                            <em for="other_skill">Skill</em>
                            <input type="text" class="form-control" name="skill" id="skill" value="{{ $skill_info->skill }}" style="border: solid rgb(165, 165, 165) 0.1px;height: 30px;border-radius:0px;" autocomplete="off">
                          </div>
                          @error('skill')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                          <div class="form-group py-2">
                            <em for="score">Score (out of 100 : in % percentage)</em>
                            <input type="number" class="form-control" name="score" id="score" value="{{ $skill_info->score }}" style="border: solid rgb(165, 165, 165) 0.1px;height: 30px;border-radius:0px;" autocomplete="off">
                          </div>
                          @error('score')
                              <small class="text-danger">
                                  <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                    </div>
      
                    <div class="text-center py-2">
                        <button type="submit" class="btn btn-success btn-md" style="border-radius: 0px;"><i class="fas fa-edit"></i> Update Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>      
</div>
@endsection

