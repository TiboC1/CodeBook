@extends('layouts.app')
     
     
     
     <!-- implement navbar/header -->
     <div class="form-group row">
         <label for="banner" class="col-md-4 col-form-label text-md-right">{{ __('Banner') }}</label>
         <input type="file" name="banner" placeholder="Upload a banner" /><br />
     </div>
     <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
            <div class="col-md-6">
                <input type="text" name="groupname"/>
                </div>
     
     
     
     
     
     
     
     <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
            <div class="col-md-6">
                 <textarea id = "myTextArea"
                  rows = "6"
                  cols = "34">Your text here
                  </textarea>
             </div>
     </div>



     <!-- implement footer -->