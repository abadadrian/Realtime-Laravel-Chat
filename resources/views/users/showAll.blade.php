@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card-body">
                        <ul id="users">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.axios.get('/api/users')
        .then((response) => {
            const usersElement = document.getElementById('users');
            let users = response.data;
            users.forEach((user, index) => {
                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.innerText = user.name;
                usersElement.appendChild(element);
            });
        })
</script>

<script>
    // Use users channel
    Echo.channel('users')
        .listen('UserCreated', (e) => {
            const usersElement = document.getElementById('users');
            //Create new element li
            let element = document.createElement('li');
            // Set "id" attribute to the new element
            element.setAttribute('id', e.user.id);
            // Set inner text to the new element
            element.innerText = e.user.name;
            // Append the new element to the list
            usersElement.appendChild(element);
        })
        .listen('UserUpdated', (e) => {
            //Get id of the user that was updated
            let element = document.getElementById(e.user.id);
            //Modify text of the element we got
            element.innerText = e.user.name;
        })
        .listen('UserDeleted', (e) => {
            //Get id of the user that was deleted
            let element = document.getElementById(e.user.id);
            // Remove the element from the DOM
            element.parentNode.removeChild(element);
        });
</script>
@endpush