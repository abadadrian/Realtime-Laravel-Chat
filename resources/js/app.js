require('./bootstrap');

// Broadcaster of the private event
    Echo.private('notifications')
    .listen('UserSessionChanged', (e) => {
        // Catch the notification
        const notificationElement = document.getElementById('notification');
        // We add it to the HTML
        notificationElement.innerText = e.message;
        // We show the notification, removing the invisible class
        notificationElement.classList.remove('invisible');
        // We remove the success class
        notificationElement.classList.remove('alert-success');
        // We remove the danger class
        notificationElement.classList.remove('alert-danger');
        // We add the class of the type that we need
        notificationElement.classList.add('alert-' + e.type);
    });