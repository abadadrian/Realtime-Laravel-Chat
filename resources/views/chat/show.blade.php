@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])


@push('styles')
<style type="text/css">
    #users>li {
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="notification" class="alert alert-primary mx-3  invisible fade show">
                </div>

                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Chat Online') }}</h4>
                        <p class="card-category">{{ __('Send Messages in Real Time!') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row p-2">
                            <div class="chat-box col-sm-10 col-xs-12">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3">
                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
                                        </ul>
                                    </div>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input id="message" type="text" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="online-box col-2">
                                <p><strong>Online Now</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');
        // Use users channel
        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) => {
                    let element = document.createElement('li');

                    element.setAttribute('id', user.id);
                    element.innerText = user.name;

                    usersElement.appendChild(element);
                });
            })
            .joining((user) => {
                let element = document.createElement('li');

                element.setAttribute('id', user.id);
                element.innerText = user.name;

                usersElement.appendChild(element);
            })
            .leaving((user) => {
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            })
            .listen('MessageSent', (e) => {
                let element = document.createElement('li');
                element.innerText = e.user.name + ': ' + e.message;
                messagesElement.appendChild(element);
            });
    </script>

    <script>
        // Catch the element send button
        const sendElement = document.getElementById('send');
        // Catch the element message input
        const messageElement = document.getElementById('message');
        // Add JavaScript event listener to the send button
        sendElement.addEventListener('click', (e) => {
            // Prevent the default action of the event
            e.preventDefault();
            // Send post request with axios
            window.axios.post('/chat/message', {
                // Body of message in JSON object
                message: messageElement.value
            });
            // Clear the input to send another message
            messageElement.value = '';
        });
    </script>
    @endpush