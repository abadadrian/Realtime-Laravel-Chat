<!-- If user has image, show it, if not, show default -->
@if($image->user->image)
<div class="container-avatar">
    <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
</div>
@else
<div class="container-avatar">
    <img src="src="{{ asset('material/img/default.jpg') }}"" class="avatar" />
</div>
@endif