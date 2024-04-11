@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #09B0B0 ;">Company</h1>
                </div>

            </div>
        </div>
    </div>


    <section class="content">
        <div class="col-sm-12"><br>
            <!-- text input -->
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.company.store') }}" method="POST" id="cardUpload"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Please enter Employee">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imageUpload">Upload Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="imageUpload">
                                    <label id="imageUploadLabel" class="custom-file-label" for="imageUpload">Choose
                                        file</label>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>contact Number</label>
                                    <input type="text" name="contact_number" class="form-control"
                                placeholder="Please enter your contact number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Annual Turnover</label>
                                    <input type="text" name="annual_turnover" class="form-control"
                                placeholder="Please enter your Annual turnover">
                                </div>
                            </div>
                      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="8" name="description"
                                        placeholder="Please enter a description in less than 150 words"></textarea>
                                </div> 
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-block btn-primary" style="width: 100px;">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#cardUpload').validate({
            rules: {
                title: {
                    required: true
                },
            },
            messages: {
                image: {
                    required: "Please upload an image"
                },
                title: {
                    required: "Enter title"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>


    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 250,
            });
        });
    </script>

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
                    $('#imgCard').css('display', 'block');
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
