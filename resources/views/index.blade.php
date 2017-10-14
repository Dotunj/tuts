<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Laravel and Cloudinary</title>
    <meta name="description" content="Laravel and Cloudinary">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
     <div class="col-md-5">
                <h4 class="page-header">
                    Files
                </h4>
                <div class="row" style="border:1px solid #ccc;margin-left:5px;width:100%;padding:15px;">
                 @if($files)
                    @foreach($files as $file)
                <div>
                <div><i class="fa fa-check-square-o"></i>
                     <span>
                     <a href="{{$file->file_url}}" target="_blank">{{$file->file_name}}</a>
                     </span>
                     </div>
                     </div>
                     <hr/>
                     @endforeach
                     @endif
                    <form class="form-vertical" role="form" enctype="multipart/form-data" method="post" action="/files">
                     {{csrf_field()}}
                    @if(session()->has('status'))
                    <div class="alert alert-info" role="alert">
                      {{session()->get('status')}}
                    </div>
                    @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="file" name="file_name" class="form-control" id="name" value="">
                            @if($errors->has('file_name'))
                                <span class="help-block">{{ $errors->first('file_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Add Files</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </body>
        </html>