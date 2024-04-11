@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #09B0B0 ;">Salons</h1>
                </div>

            </div>
        </div>
    </div>


    <section class="content">
        <div class="col-sm-12"><br>
            <!-- text input -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.company.update', $data->company_id) }}" method="post" id="cardUpload"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-widget" style="width: 300px; border-radius: 10px;" id="imgCard">
                                    <div class="card mb-2" style="border-radius: 10px;">
                                        <img class="card-img-top" id="imgPrev"
                                            src="{{ asset('/image/salon/' . $data->image . '') }}" alt="Photo"
                                            style="width: 300px; border-radius: 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imageUpload">Upload image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" value="{{$data->image}}" name="image" class="custom-file-input" id="imageUpload">
                                    <label class="custom-file-label" for="imageUpload">Choose file</label>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" value="{{ $data->name }}" name="name" class="form-control"
                                placeholder="Please enter a salon name">
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>About</label>
                                    <textarea class="form-control" rows="8" name="about" value="{{ $data->about }}"
                                        placeholder="Please enter a description in less than 150 words">{{ $data->about }}</textarea>
                                </div>
                                <?php
                                $imgArr = [];
                                $imgArr = explode(',', $data->facilities);
                                ?>
                                <div class="form-group">
                                    <label>Select facilities available</label><br>

                                    <img src="/image/R.png" style="width: 100px">
                                    <input class="form-check-input" type="checkbox" value="1" name="image1"
                                        @php if(isset($imgArr[0])){ if($imgArr[0] =="1" ){echo "checked=checked" ;}} @endphp
                                        style="  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;">

                                    <img src="/image/2160941.png" style="width: 110px">
                                    <input class="form-check-input" type="checkbox" value="2" name="image2"
                                        @php if(isset($imgArr[1])){ if($imgArr[1]=="2" ){echo "checked=checked" ;}} @endphp
                                        style="  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;">

                                    <img src="/image/portable-toilet-icon.png" style="width: 100px">
                                    <input class="form-check-input" type="checkbox" value="3" name="image3"
                                        @php if(isset($imgArr[2])){ if($imgArr[2]=="3" ){echo "checked=checked" ;}} @endphp
                                        style="  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;">

                                    <img src="/image/icon-parking.png" style="width: 100px">
                                    <input class="form-check-input" type="checkbox" value="4" name="image4"
                                        @php if(isset($imgArr[3])){ if($imgArr[3]=="4" ){echo "checked=checked" ;}} @endphp
                                        style="  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  transform: scale(2);
  padding: 10px;">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Opening Hours</label>
                                    <textarea id="summernote" name="hours">{{ $data->opening_hours }}</textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                        $image = [];
                        $image = explode(',', $data->payment);
                        ?>
                        <!-- <div class="form-group">
                            <label>Packages </label>
                            <input type="text" name="packages" value="{{ $data->packages }}" class="form-control"
                                placeholder="Enter a url link (Redirect to packages in Zenoti)">
                        </div> -->
                        <div class="form-group">
                            <label>Gift Cards</label>
                            <input type="gift" name="gift" value="{{ $data->gift }}" class="form-control"
                                placeholder="Enter a url link (Redirect to gift card in Zenoti)">
                        </div>
                        <div class="form-group">
                            <label>Map</label>
                            <input type="map" name="map" value="{{ $data->map }}" class="form-control"
                                placeholder="Enter a url link (Redirect to booking page)">
                        </div>
                        <div class="form-group">
                            <label>Appointment Link</label>
                            <input type="link" name="appointment" value="{{ $data->appointment }}"
                                class="form-control" placeholder="title">
                        </div>
                        <div class="form-group">
                            <label>Packages Link</label>
                            <input type="link" name="package_link" value="{{ $data->package_link }}"
                                class="form-control" placeholder="title">
                        </div>

                        <button type="submit" class="btn btn-block btn-primary" style="width: 100px;">Update</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection

@section('script')


    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });


        $('#imageUpload').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgPrev').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script type="text/javascript">
        document.getElementById('salonz').className = 'nav-link active';
    </script>
@endsection
