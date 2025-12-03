document.addEventListener("DOMContentLoaded", () => {
    const chatHeader = document.getElementById("chat-header");
    const chatContent = document.getElementById("chat-content");
    const messageInput = document.getElementById("message-input");
    const closeBtn = document.getElementById("close-btn");
    const whatsappBtn = document.getElementById("whatsapp-btn");
    const chatIcon = document.getElementById("chat-icon");

    let hasShownWelcomeMessage = false;

    const toggleChat = (show) => {
        chatIcon.style.display = show ? "none" : "flex";
        chatHeader.style.display = show ? "flex" : "none";
        chatContent.style.display = show ? "block" : "none";
        messageInput.style.display = show ? "flex" : "none";
        if (show) {
            setTimeout(() => {
                chatHeader.style.opacity = "1";
                chatHeader.style.transform = "translateY(0)";
                chatContent.style.opacity = "1";
                chatContent.style.transform = "translateY(0)";
                messageInput.style.opacity = "1";
                messageInput.style.transform = "translateY(0)";
            }, 50);
            if (!hasShownWelcomeMessage) setTimeout(showTypingIndicator, 1000);
        } else {
            chatHeader.style.opacity = "0";
            chatHeader.style.transform = "translateY(20px)";
            chatContent.style.opacity = "0";
            chatContent.style.transform = "translateY(20px)";
            messageInput.style.opacity = "0";
            messageInput.style.transform = "translateY(20px)";
            setTimeout(() => chatIcon.style.display = "flex", 500);
        }
    };

    const showTypingIndicator = () => {
        const typingIndicator = document.createElement("div");
        typingIndicator.className = "typing-indicator";
        typingIndicator.innerHTML = "<span></span><span></span><span></span>";
        chatContent.appendChild(typingIndicator);
        chatContent.scrollTop = chatContent.scrollHeight;
        setTimeout(() => {
            typingIndicator.remove();
            showIncomingMessage();
        }, 1000);
    };

    const showIncomingMessage = () => {
        if (!hasShownWelcomeMessage) {
            const incomingMessage = document.createElement("div");
            incomingMessage.className = "message received";
            incomingMessage.textContent = "🌍 Adventure awaits! Book Motorcycle Tours & Rentals with CEYLON ADVENTURE TOURS for an unforgettable experience in Sri Lanka!!🏍️";
            chatContent.appendChild(incomingMessage);
            chatContent.scrollTop = chatContent.scrollHeight;
            hasShownWelcomeMessage = true;
        }
    };

    closeBtn.addEventListener("click", () => toggleChat(false));
    chatIcon.addEventListener("click", (e) => {
        e.preventDefault();
        toggleChat(true);
    });
    whatsappBtn.addEventListener("click", () => {
        window.open("https://api.whatsapp.com/send/?phone=%2B94777173007&text&type=phone_number&app_absent=0", "_blank");
        toggleChat(false);
    });
});
