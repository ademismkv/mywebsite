document.addEventListener('DOMContentLoaded', function() {
    const lines = document.querySelectorAll('.command-line-text');
    const activePrompt = document.querySelector('.active-prompt');
    const userInput = document.getElementById('user-input');
    
    // Store original text
    lines.forEach(line => {
        line.setAttribute('data-text', line.textContent);
        line.textContent = '';
    });

    let lineIndex = 0;

    function typeLine() {
        if (lineIndex >= lines.length) {
            // Show interactive prompt when auto-typing is done
            if (activePrompt) {
                activePrompt.style.display = 'block';
                userInput.focus();
                // Keep focus on input
                document.addEventListener('click', () => userInput.focus());
            }
            return;
        }

        const line = lines[lineIndex];
        const text = line.getAttribute('data-text');
        
        let charIndex = 0;
        function typeChar() {
            if (charIndex < text.length) {
                line.textContent += text.charAt(charIndex);
                charIndex++;
                setTimeout(typeChar, 20);
            } else {
                const parentCmd = line.closest('.command-line');
                if (parentCmd) {
                    const nextEl = parentCmd.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('post-content')) {
                        nextEl.style.display = 'block';
                    }
                }
                
                lineIndex++;
                setTimeout(typeLine, 200);
            }
        }
        typeChar();
    }

    // Handle user input
    if (userInput) {
        userInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const command = this.textContent.trim();
                if (command !== '') {
                    handleCommand(command.toLowerCase(), command);
                    this.textContent = '';
                }
            }
        });
    }

    function handleCommand(cmdLower, originalCmd) {
        const routes = {
            '1': '/about',
            'about_me': '/about',
            'about': '/about',
            '2': '/portfolio-cs',
            'portfolio_cs': '/portfolio-cs',
            '3': '/portfolio-ns-engineering',
            'portfolio_ns': '/portfolio-ns-engineering',
            '4': '/blog',
            'personal_blog': '/blog',
            '5': '/resume-10',
            'resume': '/resume-10'
        };

        if (routes[cmdLower]) {
            window.location.href = window.location.origin + routes[cmdLower];
        } else {
            // It's a message, send to WAHA via PHP proxy
            sendMessageToWaha(originalCmd);
        }
    }

    async function sendMessageToWaha(message) {
        const promptContainer = document.querySelector('.active-prompt');
        const feedback = document.createElement('div');
        feedback.className = 'command-line';
        feedback.innerHTML = '<span class="prompt">system: </span><span>Sending message...</span>';
        promptContainer.parentNode.insertBefore(feedback, promptContainer);

        try {
            const response = await fetch('/wp-json/terminal/v1/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': wpApiSettings.nonce // We need to localize this in functions.php
                },
                body: JSON.stringify({ message: message })
            });
            
            const data = await response.json();
            if (data.success) {
                feedback.lastElementChild.textContent = 'Message sent successfully!';
            } else {
                feedback.lastElementChild.textContent = 'Error: ' + (data.message || 'Unknown error');
                }
        } catch (error) {
            feedback.lastElementChild.textContent = 'Error: Could not connect to server.';
        }
        
        // Auto-scroll to bottom
        window.scrollTo(0, document.body.scrollHeight);
    }

    // Start animation
    setTimeout(typeLine, 500);
});
