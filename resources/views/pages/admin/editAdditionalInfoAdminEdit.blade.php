@extends('layouts.userEdit')

@section('content')
<div class="content-header">
    <h1 class="col-sm-6">Edit Additional Info</h1>
  </div>
  <div class="container">
  <div class="row">
      <div class="col-lg-10 mx-auto">
          <div class="card card-info">
              <div class="card-header">Update Your Business Card Info</div>
              <div class="card-body">
                  <form action="/updateAdditionalInfoAdminEdit/{{ $user_data->id }}" method="post">
                      @csrf
                      {{ method_field("PUT") }}
                      <div class="form-group row">
                          <label for="about" class="col-md-4 col-form-label text-md-right">About</label>
      
                          <div class="col-md-6">
                              <textarea class="form-control @error('about') is-invalid @enderror" name="about" id="about" rows="4"  style="resize: none;" placeholder="Tell us about yourself" required>@isset($info->about){{ $info->about }}@endisset</textarea>
                            
                              @error('about')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="career_goal" class="col-md-4 col-form-label text-md-right">Career Goal</label>
      
                          <div class="col-md-6">
                              <textarea class="form-control @error('career_goal') is-invalid @enderror" name="career_goal" id="career_goal" rows="3"  placeholder="Your career goal" style="resize: none;" required>@isset($info->career_goal){{ $info->career_goal }}@endisset</textarea>
                            
                              @error('career_goal')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="facebook_link" class="col-md-4 col-form-label text-md-right">Facebook link</label>
      
                          <div class="col-md-6 input-group">
                              <input type="url" class="form-control @error('facebook_link') is-invalid @enderror" name="facebook_link" id="facebook_link" placeholder="Place your facebook profile link here" value="@isset($info->facebook_link) {{ $info->facebook_link }} @endisset">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                              </div>
                              @error('facebook_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
  
                      <div class="form-group row">
                          <label for="twitter_link" class="col-md-4 col-form-label text-md-right">Twitter link</label>
      
                          <div class="col-md-6 input-group">
                              <input type="url" class="form-control @error('twitter_link') is-invalid @enderror" name="twitter_link" id="twitter_link" placeholder="Place your Twitter profile link here" value="@isset($info->twitter_link) {{ $info->twitter_link }} @endisset">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                              </div>
                              @error('twitter_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
  
                      <div class="form-group row">
                          <label for="google_plus_link" class="col-md-4 col-form-label text-md-right">Google Plus link</label>
      
                          <div class="col-md-6 input-group">
                              <input type="url" class="form-control @error('google_plus_link') is-invalid @enderror" name="google_plus_link" id="google_plus_link" placeholder="Place your Google plus link here" value="@isset($info->google_plus_link) {{ $info->google_plus_link }} @endisset">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fab fa-google-plus"></i></span>
                              </div>
                              @error('google_plus_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
  
                      <div class="form-group row">
                          <label for="instagram_link" class="col-md-4 col-form-label text-md-right">Instagram Profile link</label>
      
                          <div class="col-md-6 input-group">
                              <input type="url" class="form-control @error('instagram_link') is-invalid @enderror" name="instagram_link" id="instagram_link" placeholder="Place your Instagram Profile link here" value="@isset($info->instagram_link) {{ $info->instagram_link }} @endisset">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                              </div>
                              @error('instagram_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
  
                      <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="langauges">Languages</label>
                        <div class="col-md-4">
                        <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm"  class="form-control selectpicker" id="languages" name="languages[]" required>
                          <option value="Afrikaans">Afrikaans</option>
                          <option value="Albanian">Albanian</option>
                          <option value="Arabic">Arabic</option>
                          <option value="Armenian">Armenian</option>
                          <option value="Basque">Basque</option>
                          <option value="Bengali">Bengali</option>
                          <option value="Bulgarian">Bulgarian</option>
                          <option value="Catalan">Catalan</option>
                          <option value="Cambodian">Cambodian</option>
                          <option value="Chinese(Mandarin)">Chinese(Mandarin)</option>
                          <option value="Croatian">Croatian</option>
                          <option value="Czech">Czech</option>
                          <option value="Danish">Danish</option>
                          <option value="Dutch">Dutch</option>
                          <option value="English">English</option>
                          <option value="Estonian">Estonian</option>
                          <option value="Fiji">Fiji</option>
                          <option value="Finnish">Finnish</option>
                          <option value="French">French</option>
                          <option value="Georgian">Georgian</option>
                          <option value="German">German</option>
                          <option value="Greek">Greek</option>
                          <option value="Gujarati">Gujarati</option>
                          <option value="Hebrew">Hebrew</option>
                          <option value="Hindi">Hindi</option>
                          <option value="Hungarian">Hungarian</option>
                          <option value="Icelandic">Icelandic</option>
                          <option value="Indonesian">Indonesian</option>
                          <option value="Irish">Irish</option>
                          <option value="Italian">Italian</option>
                          <option value="Japanese">Japanese</option>
                          <option value="Javanese">Javanese</option>
                          <option value="Korean">Korean</option>
                          <option value="Latin">Latin</option>
                          <option value="Latvian">Latvian</option>
                          <option value="Lithuanian">Lithuanian</option>
                          <option value="Macedonian">Macedonian</option>
                          <option value="Malay">Malay</option>
                          <option value="Malayalam">Malayalam</option>
                          <option value="Maltese">Maltese</option>
                          <option value="Maori">Maori</option>
                          <option value="Marathi">Marathi</option>
                          <option value="Mongolian">Mongolian</option>
                          <option value="Nepali">Nepali</option>
                          <option value="Norwegian">Norwegian</option>
                          <option value="Persian">Persian</option>
                          <option value="Polish">Polish</option>
                          <option value="Portuguese">Portuguese</option>
                          <option value="Punjabi">Punjabi</option>
                          <option value="Quechua">Quechua</option>
                          <option value="Romanian">Romanian</option>
                          <option value="Russian">Russian</option>
                          <option value="Samoan">Samoan</option>
                          <option value="Serbian">Serbian</option>
                          <option value="Slovak">Slovak</option>
                          <option value="Slovenian">Slovenian</option>
                          <option value="Spanish">Spanish</option>
                          <option value="Swahili">Swahili</option>
                          <option value="Swedish ">Swedish </option>
                          <option value="Tamil">Tamil</option>
                          <option value="Tatar">Tatar</option>
                          <option value="Telugu">Telugu</option>
                          <option value="Thai">Thai</option>
                          <option value="Tibetan">Tibetan</option>
                          <option value="Tonga">Tonga</option>
                          <option value="Turkish">Turkish</option>
                          <option value="Ukrainian">Ukrainian</option>
                          <option value="Urdu">Urdu</option>
                          <option value="Uzbek">Uzbek</option>
                          <option value="Vietnamese">Vietnamese</option>
                          <option value="Welsh">Welsh</option>
                          <option value="Xhosa">Xhosa</option>
                          </select>
                        </div>
                        @error('languages')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
  
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  </div>
      @php
          $arr = array();
          if(isset($info->languages)){
              $lang = str_replace(" ","",$info->languages);
          }else{
              $lang = "";
          }
          
          $temp = "";
          for($i = 0; $i<strlen($lang); $i++) {
              if($lang[$i] == "," || $i == strlen($lang)-1){
                  $temp = $temp . $lang[$i];
                  array_push($arr, str_replace(",","",$temp));
                  $temp = "";
              }
              else{
                  $temp = $temp . $lang[$i];
              }
          } 
      @endphp
      <script>
          var arr = [];
      </script>
  @endsection
  
  @section('scripts')
  <?php
      foreach($arr as $value) {
          echo "<script>
                  arr.push('".$value."');
                </script>";
      }   
      ?>
      <script>
          $(function (){
              $('.selectpicker').selectpicker();
          });
          $("#languages").val(arr);
      </script>
  @endsection