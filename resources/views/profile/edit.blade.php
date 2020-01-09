@extends('layouts.app')
@section('contents')
<div>
<form method="POST" action="" enctype="multipart/form-data">
<label>Date of birth</label>
<input name="date_of_birth" value="15-05-1984" data-format="DD-MM-YYYY" data-template="D MMM YYYY"> 

<label>Gender</label><br />
<input type="radio" name="gender" value="male" checked> Male<br>
  <input type="radio" name="gender" value="female"> Female<br>
  <input type="radio" name="gender" value="other"> Other<br />

<label>Relationshipstatus</label><br />
<input type="radio" name="relationship" value="single" checked> Single<br>
  <input type="radio" name="relationship" value="in-relationship"> In a relationship<br>
  <input type="radio" name="relationship" value="Engaged"> Engaged<br />
  <input type="radio" name="relationship" value="Married"> Married<br />
<label>Photo</label>
<input type="file" name="avatar" placeholder="Upload an avatar" /><br />
<label>Banner image</label>
<input type="file" name="banner" placeholder="Upload a banner" /><br />
<label>City</label>
<input type="text" name="city"><br />

</form>
</div>

@endsection