@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"></script>

<style>


    .page {
        margin: 1em auto;
        max-width: 768px;
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        height: 100%;
    }

    .box {
        padding: 0.5em;
        width: 100%;
        margin:0.5em;
    }

    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    .options label,
    .options input{
        width:4em;
        padding:0.5em 1em;
    }
    .btn{
        background:white;
        color:black;
        border:1px solid black;
        padding: 0.5em 1em;
        text-decoration:none;
        margin:0.8em 0.3em;
        display:inline-block;
        cursor:pointer;
    }

    .hide {
        display: none;
    }

    img {
        max-width: 100%;
    }



    </style>

<form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ route('admin.car.save') }}" >
    @csrf

<div id="multple-step-form-n" class="container overflow-hidden" style="margin-top: 0px;margin-bottom: 10px;padding-bottom: 30px;padding-top: 57px;">

    <div id="multistep-start-row" class="row mb-3">
        <div id="multistep-start-column" class="col-12 col-lg-8 m-auto">

                <div id="single-form-next" class="multisteps-form__panel shadow p-4 rounded bg-white js-active pb-5" data-animation="scaleIn">
                    <h3 class="title text-center multisteps-form__title">Add new car</h3>
                    <div id="form-content" class="multisteps-form__content">
                        <div id="input-grp-double" class="form-row mt-4">
                            <div class="form-group col-12 col-sm-6">
                                <label class="label-control">Plate no.</label>
                                <input type="text" class="form-control " name="no_plate" value=""/>
                            </div>
                            <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0">
                                <label class="label-control">Car Model</label>
                                <input type="text" class="form-control " name="car_name" value=""/>
                            </div>
                        </div>
                        <div id="input-grp-double" class="form-row mt-4">
                            <div class="form-group col-12 col-sm-6">
                                <label class="label-control">Rate</label>
                                <input type="number" class="form-control " name="rate" value=""/>
                            </div>

                        </div>


                    </div>
                </div>


        </div>

    </div>
    <div class="col-12 col-lg-10 shadow rounded bg-white py-2 px-4 m-auto">
        <h3 class="title text-center multisteps-form__title">Upload car picture</h3>


        <!-- input file -->
        <div class="box mb-2">
            <input type="file" id="file-input">
        </div>
        <!-- leftbox -->
    <div class="row">
        <div class="col-12 col-sm-6">
            <label>Uploaded picture</label>
            <div class="result"></div>
        </div>
        <!--rightbox-->
        <div class="col-12 col-sm-6">
            <!-- result of crop -->
            <div class="d-flex flex-column">
                <label>Cropped picture</label>
                <label><small class="text-muted">This picture will be saved.</small></label>
            </div>
            <div class="img-result hide">
               <img class="cropped" src="" alt="">
            </div>
        </div>
    </div>
        <!-- input file -->
        <div class="box">
            <div class="options hide">
                <input type="hidden" class="img-w" value="250" min="100" max="300" />
            </div>
            <!-- save btn -->
            <button class="btn save hide">Crop</button>
            <!-- download btn -->

        </div>

    </div>


        <input class="uri" type="hidden" name="uri" value="">

         <div class="d-flex justify-content-center my-2">
             <button type="submit" class="btn btn-primary" id="submit">Submit</button>
         </div>
    </form>

</div>


<script>

    // vars
    let result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    img_w = document.querySelector('.img-w'),
    img_h = document.querySelector('.img-h'),
    options = document.querySelector('.options'),
    save = document.querySelector('.save'),
    cropped = document.querySelector('.cropped'),
    upload = document.querySelector('#file-input'),
    cropper = '';

    uri = document.querySelector('.uri'),


    // on change show image with crop options
    upload.addEventListener('change', (e) => {
      if (e.target.files.length) {
            // start file reader
        const reader = new FileReader();
        reader.onload = (e)=> {
          if(e.target.result){
                    // create new image
                    let img = document.createElement('img');
                    img.id = 'image';
                    img.src = e.target.result
                    // clean result before
                    result.innerHTML = '';
                    // append new image
            result.appendChild(img);
                    // show save btn and options
                    save.classList.remove('hide');
                    options.classList.remove('hide');
                    // init cropper
                    cropper = new Cropper(img);
          }
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });

    // save on click
    save.addEventListener('click',(e)=>{
      e.preventDefault();
      // get result to data uri
      let imgSrc = cropper.getCroppedCanvas({
            width: img_w.value // input value
        }).toDataURL();
      // remove hide class of img
      cropped.classList.remove('hide');
        img_result.classList.remove('hide');
        // show image cropped
      cropped.src = imgSrc;

      uri.setAttribute('value',imgSrc);
    });



    </script>




@endsection
