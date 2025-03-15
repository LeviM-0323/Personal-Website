document.getElementById('subscribeButton').addEventListener('click', async function () {
    const email = document.getElementById('email').value;

    if (!email) {
        alert("Please enter a valid email.");
        return;
    }

    const messageElement = document.getElementById('message');
    messageElement.style.display = 'none'; // Hide message before submitting

    // Show confirmation message
    messageElement.innerHTML = "Sending email...";
    messageElement.style.color = "blue";
    messageElement.style.display = 'block';

    try {
        // Send POST request to PHP script
        const response = await fetch('email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ email: email })
        });

        const result = await response.text();
        if (response.ok) {
            messageElement.innerHTML = "Subscription successful! Please check your inbox.";
            messageElement.style.color = "green";
        } else {
            messageElement.innerHTML = "Error: " + result;
            messageElement.style.color = "red";
        }
    } catch (error) {
        messageElement.innerHTML = "Error sending email.";
        messageElement.style.color = "red";
    }
});