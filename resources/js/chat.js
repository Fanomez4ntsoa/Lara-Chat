document.addEventListener('DOMContentLoaded', () => {
    const messagesContainer = document.getElementById('messages');
    const messageInput = document.getElementById('message-text-area');
    const sendButton = document.getElementById('send-button');

    // Fonction pour récupérer les messages
    async function fetchMessages() {
        const response = await fetch('/messages');
        const messages = await response.json();
        messagesContainer.innerHTML = '';
        messages.forEach(message => {
            const messageElement = document.createElement('div');
            messageElement.textContent = `${message.user.name}: ${message.message}`;
            messagesContainer.appendChild(messageElement);
        });
    }

    // Fonction pour envoyer un message
    async function sendMessage() {
        const message = messageInput.value;
        if (message.trim() === '') return;

        try {
            const response = await fetch('/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            });

            if(!response.ok) {
                throw new Error('Network response was not ok on sending message');
            }

            const newMessage = await response.json();
            const messageElement = document.createElement('div');
            messageElement.textContent = `${newMessage.user.name}: ${newMessage.message}`;
            messagesContainer.appendChild(messageElement);
            messageInput.value = '';

        } catch (error) {
            console.error('Error sending message', error);
        }
    }

    // Initialiser la récupération des messages et la configuration du bouton d'envoi
    fetchMessages();
    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keyup', (event) => {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });
});
