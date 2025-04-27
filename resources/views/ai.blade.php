@extends('layouts.master')

@section('title')
    Ai assistant
@endsection
<style>
    html, body {
        height: 100%;
        min-height: 100%;
    }
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
        font-family: 'Segoe UI', 'Arial', sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        margin-top: 60px;
        width: 100vw;
        min-width: 0;
        padding-left: 8px;
        padding-right: 8px;
        box-sizing: border-box;
    }
    .chat-container {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 48px rgba(60, 72, 88, 0.18);
        width: 100%;
        max-width: 430px;
        min-width: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    @media (min-width: 600px) {
        .chat-container {
            max-width: 600px;
        }
    }
    @media (min-width: 900px) {
        .chat-container {
            max-width: 900px;
        }
    }
    .chat-header {
        background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
        color: #fff;
        padding: 28px 18px;
        text-align: center;
        font-weight: 700;
        letter-spacing: 1.5px;
    }
    .chat-header h1 {
        margin: 0;
        font-size: 2.1rem;
        letter-spacing: 1.5px;
    }
    .chat-messages {
        background: #f3f4f6;
        padding: 24px 10px 16px 10px;
        min-height: 220px;
        max-height: 400px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 14px;
        font-size: 1.08rem;
        border-bottom: 1px solid #e5e7eb;
    }
    @media (min-width: 600px) {
        .chat-header {
            padding: 38px 48px;
        }
        .chat-messages {
            padding: 38px 32px 24px 32px;
            min-height: 350px;
            max-height: 600px;
            font-size: 1.18rem;
        }
    }
    .message {
        border-radius: 16px;
        padding: 14px 14px;
        max-width: 90%;
        word-break: break-word;
        font-size: 1.05rem;
        line-height: 1.7;
        box-shadow: 0 2px 8px rgba(60, 72, 88, 0.04);
        transition: background 0.2s;
    }
    .message.system {
        background: #e0e7ff;
        color: #3730a3;
        align-self: flex-start;
        font-style: italic;
        font-size: 1.05rem;
        border-left: 5px solid #6366f1;
    }
    .message.user {
        background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%);
        color: #fff;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
        font-weight: 500;
    }
    .message.assistant {
        background: #ffffff;
        color: #0f172a;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }
    .chat-input {
        display: flex;
        align-items: flex-end;
        padding: 16px 10px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        gap: 10px;
        flex-wrap: wrap;
    }
    @media (min-width: 600px) {
        .chat-input {
            padding: 24px 32px;
            gap: 16px;
        }
    }
    #user-input {
        flex: 1 1 120px;
        border: 1.5px solid #c7d2fe;
        border-radius: 12px;
        padding: 12px 12px;
        font-size: 1.08rem;
        resize: none;
        background: #fff;
        color: #1e293b;
        transition: border 0.2s;
        min-height: 38px;
        max-height: 180px;
        box-shadow: 0 1px 4px rgba(99,102,241,0.04);
    }
    #user-input:focus {
        border: 2px solid #6366f1;
        outline: none;
        background: #f0f9ff;
    }
    #send-button {
        background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
        border: none;
        border-radius: 12px;
        padding: 10px 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        min-width: 44px;
        min-height: 44px;
    }
    #send-button:hover {
        background: linear-gradient(90deg, #4338ca 0%, #0ea5e9 100%);
        box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    }
    #send-button svg {
        stroke: #fff;
        width: 28px;
        height: 28px;
    }
    /* Custom file input with icon */
    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        margin-right: 4px;
        flex: 0 0 auto;
        width: 44px;
        height: 44px;
    }
    #file-input {
        opacity: 0;
        width: 44px;
        height: 44px;
        position: absolute;
        left: 0;
        top: 0;
        cursor: pointer;
        z-index: 2;
    }
    .file-input-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
        border-radius: 12px;
        color: #fff;
        font-size: 1.5rem;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        z-index: 1;
    }
    .file-input-wrapper:active .file-input-icon,
    .file-input-wrapper:focus-within .file-input-icon,
    .file-input-wrapper:hover .file-input-icon {
        background: linear-gradient(90deg, #4338ca 0%, #0ea5e9 100%);
        box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    }
    @media (max-width: 600px) {
        .chat-container {
            max-width: 99vw;
        }
        .chat-header, .chat-messages, .chat-input {
            padding-left: 6px;
            padding-right: 6px;
        }
        .file-input-wrapper, .file-input-icon {
            width: 38px;
            height: 38px;
        }
        #file-input {
            width: 38px;
            height: 38px;
        }
    }
    ::placeholder {
        color: #a5b4fc;
        opacity: 1;
    }
    /* Friendly touch: animated wave hand */
    .wave-hand {
        display: inline-block;
        animation: wave 1.6s infinite;
        transform-origin: 70% 70%;
    }
    @keyframes wave {
        0% { transform: rotate(0deg);}
        10% { transform: rotate(14deg);}
        20% { transform: rotate(-8deg);}
        30% { transform: rotate(14deg);}
        40% { transform: rotate(-4deg);}
        50% { transform: rotate(10deg);}
        60% { transform: rotate(0deg);}
        100% { transform: rotate(0deg);}
    }
    .reference-banner {
        margin-top: 16px;
        padding: 12px;
        background: #f0f9ff;
        border-left: 4px solid #6366f1;
        border-radius: 6px;
    }
    .reference-banner h4 {
        margin: 0 0 8px 0;
        color: #4338ca;
        font-size: 1.1rem;
    }
    .reference-banner ul {
        margin: 0;
        padding-left: 20px;
    }
    .reference-banner li {
        margin-bottom: 4px;
    }
    .reference-banner a {
        color: #2563eb;
        text-decoration: none;
    }
    .reference-banner a:hover {
        text-decoration: underline;
    }
    /* Style for image previews in chat */
    .chat-image-preview {
        max-width: 220px;
        max-height: 180px;
        border-radius: 10px;
        margin-top: 8px;
        margin-bottom: 4px;
        box-shadow: 0 2px 8px rgba(60, 72, 88, 0.10);
        display: block;
    }
</style>
@section('content')
<div class="container">
    <div class="chat-container">
        <div class="chat-header">
            <span class="ai-emoji" style="font-size:2.2rem;vertical-align:middle;">🤖</span>
            <h1>
                MJTECH AI
            </h1>
            <p style="margin: 12px 0 0 0; font-size:1.18rem; font-weight:400;">
                <span class="wave-hand" style="font-size:1.5rem;">👋</span>
                Bienvenue ! Je suis votre MJTECH assistant AI médical, prêt à vous aider avec bienveillance et professionnalisme.
            </p>
        </div>
        <div class="chat-messages" id="chat-messages">
            <div class="message system">
                <p>
                    Bonjour&nbsp;! <span class="wave-hand">👋</span> Je suis votre assistant AI propulsé par <b>MJTECH</b>.<br>
                    <span style="color:#6366f1;">Posez-moi vos questions médicales, demandez des explications ou de l'aide pour vos tâches quotidiennes.<br>
                    Je suis là pour vous accompagner&nbsp;!</span>
                </p>
            </div>
        </div>
        <div class="chat-input">
            <label class="file-input-wrapper" title="Joindre un fichier (image ou PDF)">
                <input type="file" id="file-input" multiple accept="image/*,application/pdf">
                <span class="file-input-icon" aria-label="Joindre un fichier">
                    <!-- Paperclip SVG icon for file upload -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21.44 11.05l-8.49 8.49a5.5 5.5 0 0 1-7.78-7.78l9.19-9.19a3.5 3.5 0 1 1 4.95 4.95l-9.2 9.19a1.5 1.5 0 1 1-2.12-2.12l8.49-8.49"/>
                    </svg>
                </span>
            </label>
            <textarea id="user-input" placeholder="Écrivez votre message ici... (ex: 'Quels sont les effets secondaires du paracétamol ?')" rows="1"></textarea>
            <button id="send-button" title="Envoyer" type="button" aria-label="Envoyer le message">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>
</div>
<br>
<br>
@endsection

{{-- Defer script loading to ensure DOM is ready before JS runs --}}
<script src="{{ asset('js/ai.js') }}" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file-input');
    const chatMessages = document.getElementById('chat-messages');

    fileInput.addEventListener('change', function(event) {
        const files = Array.from(event.target.files);
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create a new message div for the image
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'message user';
                    // Add the image
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;
                    img.className = 'chat-image-preview';
                    msgDiv.appendChild(img);
                    chatMessages.appendChild(msgDiv);
                    // Scroll to bottom
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                };
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>
