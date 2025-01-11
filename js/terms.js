document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('privacyPolicyLink').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('terms').checked = true;
    });

    document.getElementById('subscribeButton').addEventListener('click', function(event) {
        if (!document.getElementById('terms').checked) {
            alert('You must agree to the Privacy Policy.');
            event.preventDefault();
        } else {
            // Send email using PHP
            var email = document.getElementById('email').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/test/php/email.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    var response = xhr.responseText;
                    var messageElement = document.getElementById('emailMessage')
                    if (xhr.status === 200 && response === 'Email sent successfully!') {
                        messageElement.textContent = 'Email sent successfully!';
                        messageElement.style.color = 'green';
                    } else {
                        messageElement.textContent = 'Failed to send email.';
                        messageElement.style.color = 'red';
                    }
                }
            };
            xhr.send('email=' + encodeURIComponent(email));
        }
    });
});