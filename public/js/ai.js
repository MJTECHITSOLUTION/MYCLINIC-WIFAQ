// ===== CONFIGURATION =====
// Replace with your API key from Google AI Studio: https://makersuite.google.com/app/apikey
const API_KEY = "AIzaSyANW6zOzz2aG1Q2nDRkjARhgC7V2fymUpo";
const API_URL = "https://generativelanguage.googleapis.com/v1beta";
const MODEL = "models/gemini-2.0-flash-exp"; 

// System prompt for medical assistant
const BASE_SYSTEM_PROMPT = `
Vous êtes un assistant médical IA très intelligent, fiable et empathique.
Vous aidez les médecins, infirmiers et pharmaciens dans leurs tâches quotidiennes.
Vous pouvez répondre à des questions médicales, suggérer des options de traitement (basées sur des preuves),
expliquer les interactions médicamenteuses, résumer l'état des patients et aider à la documentation.
Vous expliquez toujours clairement, en utilisant un langage médical professionnel quand c'est approprié,
mais vous pouvez simplifier si on vous le demande. Vous ne fabriquez jamais d'informations.
Si vous n'êtes pas sûr ou si quelque chose dépasse votre champ de compétence, vous conseillez de consulter un professionnel de santé.
Votre ton est calme, professionnel et bienveillant.

IMPORTANT : Si l'utilisateur pose sa question en français, répondez uniquement en français. 
Si l'utilisateur pose sa question en darija (arabe marocain), répondez uniquement en darija (arabe marocain), de préférence en alphabet arabe si possible.
Ne répondez jamais dans une autre langue que celle utilisée par l'utilisateur.

Commencez chaque réponse en clarifiant la demande de l'utilisateur si ce n'est pas clair.
Posez des questions de suivi si nécessaire pour offrir la meilleure assistance.

Vous pouvez :
- Suggérer des diagnostics possibles selon les symptômes (avec des avertissements)
- Expliquer le fonctionnement des médicaments et leurs effets secondaires
- Vérifier les interactions médicamenteuses
- Aider à la rédaction de notes cliniques et de la documentation
- Aider à la communication avec les patients (par exemple, expliquer les conditions en termes simples)
- Traduire ou expliquer des termes médicaux
- Répondre aux questions sur les recommandations médicales (posologie, protocoles, etc.)
- Analyser des images médicales ou des documents PDF fournis par l'utilisateur et donner un résumé ou une explication (dans la limite de vos capacités d'IA)

Vous devez toujours :
- Utiliser un langage médical professionnel quand c'est approprié, mais simplifier si on vous le demande
- Ne jamais inventer d'informations. Si vous n'êtes pas sûr ou si c'est hors de votre champ, conseillez de consulter un professionnel de santé
- Garder un ton calme, professionnel et bienveillant
- Répondre uniquement dans la langue utilisée par l'utilisateur (français ou darija). Si l'utilisateur demande une autre langue, expliquez poliment que vous ne pouvez répondre qu'en français ou en darija.

De temps en temps, si c'est pertinent, ajoutez à la fin de votre réponse une référence ou un lien fiable (par exemple vers un site médical reconnu) pour permettre à l'utilisateur d'approfondir le sujet.
`;

// ===== MEMORY FOR CHAT HISTORY =====
const MAX_HISTORY = 50; // Number of previous exchanges to remember (user+assistant pairs)
let chatHistory = []; // Array of {role: 'user'|'assistant', content: string}

// ===== DOM ELEMENTS =====
let chatMessages = null;
let userInput = null;
let sendButton = null;
let fileInput = null; // For file uploads

// ===== EVENT LISTENERS =====
document.addEventListener('DOMContentLoaded', () => {
    chatMessages = document.getElementById('chat-messages');
    userInput = document.getElementById('user-input');
    sendButton = document.getElementById('send-button');
    fileInput = document.getElementById('file-input'); // You must add <input type="file" id="file-input" multiple />

    if (!chatMessages || !userInput || !sendButton) {
        console.error('AI chat: Required DOM elements not found. Please check your HTML.');
        return;
    }

    userInput.focus();

    userInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
        setTimeout(() => {
            userInput.style.height = 'auto';
            userInput.style.height = Math.min(userInput.scrollHeight, 120) + 'px';
        }, 0);
    });

    sendButton.addEventListener('click', sendMessage);

    if (fileInput) {
        fileInput.addEventListener('change', handleFileInput);
    }
});

// ===== LANGUAGE DETECTION =====
function detectLanguage(text) {
    const arabicRegex = /[\u0600-\u06FF]/;
    if (arabicRegex.test(text)) {
        return 'darija';
    }
    const frenchRegex = /[éèêàçùâîôûëïüœæ]/i;
    if (frenchRegex.test(text) || /[\w\s]+/.test(text)) {
        return 'fr';
    }
    return 'fr';
}

// ===== FILE HANDLING =====
let uploadedFiles = []; // Array of {name, type, data, displayType}

function handleFileInput(e) {
    const files = Array.from(e.target.files);
    if (!files.length) return;

    uploadedFiles = []; // Reset for each new upload

    const filePromises = files.map(file => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            if (file.type.startsWith('image/')) {
                reader.onload = function(evt) {
                    uploadedFiles.push({
                        name: file.name,
                        type: file.type,
                        data: evt.target.result.split(',')[1], // base64
                        displayType: 'image'
                    });
                    resolve();
                };
                reader.onerror = reject;
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                reader.onload = function(evt) {
                    // Convert PDF to base64
                    uploadedFiles.push({
                        name: file.name,
                        type: file.type,
                        data: evt.target.result.split(',')[1], // base64
                        displayType: 'pdf'
                    });
                    resolve();
                };
                reader.onerror = reject;
                reader.readAsDataURL(file);
            } else {
                resolve(); // Ignore unsupported file types
            }
        });
    });

    Promise.all(filePromises).then(() => {
        // Optionally show a preview or a message
        if (uploadedFiles.length > 0) {
            addMessageToChat('user', `[Fichier(s) ajouté(s) : ${uploadedFiles.map(f => f.name).join(', ')}]`);
        }
    });
}

// ===== CHAT FUNCTIONS =====
async function sendMessage() {
    if (!userInput || !chatMessages || !sendButton) return;

    const message = userInput.value.trim();
    if (!message && uploadedFiles.length === 0) return;

    const userLang = detectLanguage(message);

    // Show user message and/or file info
    if (message) addMessageToChat('user', message);
    if (uploadedFiles.length > 0 && !message) {
        addMessageToChat('user', `[Fichier(s) ajouté(s) : ${uploadedFiles.map(f => f.name).join(', ')}]`);
    }

    chatHistory.push({ role: 'user', content: message, lang: userLang, files: uploadedFiles.length ? [...uploadedFiles] : undefined });
    if (chatHistory.length > MAX_HISTORY * 2) {
        chatHistory = chatHistory.slice(-MAX_HISTORY * 2);
    }

    userInput.value = '';
    userInput.style.height = 'auto';
    if (fileInput) fileInput.value = '';
    setInputState(false);

    const thinkingId = addThinkingIndicator();

    try {
        const response = await fetchGeminiResponseWithHistory(userLang, uploadedFiles);

        removeThinkingIndicator(thinkingId);

        if (response) {
            addMessageToChat('assistant', response);
            chatHistory.push({ role: 'assistant', content: response, lang: userLang });
            if (chatHistory.length > MAX_HISTORY * 2) {
                chatHistory = chatHistory.slice(-MAX_HISTORY * 2);
            }
        } else {
            throw new Error('Empty response from API');
        }
    } catch (error) {
        console.error('Error:', error);
        removeThinkingIndicator(thinkingId);
        addMessageToChat('system', 'Sorry, I encountered an error. Please try again later.');
    } finally {
        setInputState(true);
        userInput.focus();
        uploadedFiles = []; // Reset after sending
    }
}

function addMessageToChat(role, content) {
    if (!chatMessages) return;
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message', role);

    // Improved structure: split paragraphs and lists for better readability
    if (role === 'assistant' || role === 'system') {
        // Try to parse content into paragraphs and lists
        messageDiv.innerHTML = formatAssistantResponse(content);
    } else {
        // User message: keep as plain text
        const messagePara = document.createElement('p');
        messagePara.textContent = content;
        messageDiv.appendChild(messagePara);
    }

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Helper: format assistant response for better structure
function formatAssistantResponse(text) {
    if (!text) return '';
    // Remove any double newlines at the start/end
    text = text.trim();

    // If already contains HTML (e.g. reference banner), split before banner
    let banner = '';
    let bannerIndex = text.indexOf('<div class="reference-banner">');
    if (bannerIndex !== -1) {
        banner = text.slice(bannerIndex);
        text = text.slice(0, bannerIndex);
    }

    // Split into paragraphs by double newlines or single newline if not in a list
    let lines = text.split('\n');
    let html = '';
    let inList = false;
    let listItems = [];

    for (let i = 0; i < lines.length; i++) {
        let line = lines[i].trim();
        if (!line) continue;

        // Detect list item (starts with - or * or digit.)
        if (/^[-*]\s+/.test(line) || /^\d+\.\s+/.test(line)) {
            if (!inList) {
                inList = true;
                listItems = [];
            }
            // Remove marker and push
            listItems.push(line.replace(/^[-*]\s+/, '').replace(/^\d+\.\s+/, ''));
        } else {
            if (inList) {
                // Close list
                html += '<ul>';
                listItems.forEach(item => {
                    html += `<li>${item}</li>`;
                });
                html += '</ul>';
                inList = false;
                listItems = [];
            }
            // Paragraph
            html += `<p>${line}</p>`;
        }
    }
    if (inList) {
        html += '<ul>';
        listItems.forEach(item => {
            html += `<li>${item}</li>`;
        });
        html += '</ul>';
    }

    // Add banner if present
    if (banner) {
        html += banner;
    }

    return html;
}

function addThinkingIndicator() {
    if (!chatMessages) return null;
    const id = Date.now().toString();
    const thinkingDiv = document.createElement('div');
    thinkingDiv.classList.add('message', 'thinking');
    thinkingDiv.id = `thinking-${id}`;

    const thinkingPara = document.createElement('p');
    thinkingPara.textContent = 'Thinking...';

    thinkingDiv.appendChild(thinkingPara);
    chatMessages.appendChild(thinkingDiv);

    chatMessages.scrollTop = chatMessages.scrollHeight;

    return id;
}

function removeThinkingIndicator(id) {
    if (!id) return;
    const thinkingDiv = document.getElementById(`thinking-${id}`);
    if (thinkingDiv) {
        thinkingDiv.remove();
    }
}

function setInputState(enabled) {
    if (userInput) userInput.disabled = !enabled;
    if (sendButton) sendButton.disabled = !enabled;
    if (fileInput) fileInput.disabled = !enabled;
}

// ===== API FUNCTIONS =====
async function fetchGeminiResponseWithHistory(userLang, files = []) {
    if (!API_KEY || API_KEY === 'YOUR_API_KEY_HERE') {
        addMessageToChat('system', 'Please set your API key in the script.js file.');
        return null;
    }

    const url = `${API_URL}/${MODEL}:generateContent?key=${API_KEY}`;

    let langInstruction = '';
    if (userLang === 'darija') {
        langInstruction = `
IMPORTANT : L'utilisateur a posé sa question en darija (arabe marocain). 
Vous devez répondre uniquement en darija (arabe marocain), jamais en français ou dans une autre langue.
Utilisez un style naturel et compréhensible pour un marocain, et si possible, écrivez en alphabet arabe.
De temps en temps, si c'est pertinent, ajoutez à la fin de votre réponse une référence ou un lien fiable (par exemple vers un site médical reconnu) pour permettre à l'utilisateur d'approfondir le sujet.
Si l'utilisateur a envoyé une image ou un PDF, analysez le contenu et donnez un résumé ou une explication en darija.
`;
    } else {
        langInstruction = `
IMPORTANT : L'utilisateur a posé sa question en français. 
Vous devez répondre uniquement en français, jamais en darija ou dans une autre langue.
De temps en temps, si c'est pertinent, ajoutez à la fin de votre réponse une référence ou un lien fiable (par exemple vers un site médical reconnu) pour permettre à l'utilisateur d'approfondir le sujet.
Si l'utilisateur a envoyé une image ou un PDF, analysez le contenu et donnez un résumé ou une explication en français.
`;
    }
    const SYSTEM_PROMPT = BASE_SYSTEM_PROMPT + langInstruction;

    let contents = [
        {
            role: "user",
            parts: [
                { text: SYSTEM_PROMPT }
            ]
        }
    ];

    // Add chat history
    for (let i = 0; i < chatHistory.length; i++) {
        const entry = chatHistory[i];
        if (entry.role === 'user') {
            let parts = [];
            if (entry.content) parts.push({ text: entry.content });
            if (entry.files && Array.isArray(entry.files)) {
                for (const file of entry.files) {
                    if (file.displayType === 'image') {
                        parts.push({
                            inlineData: {
                                mimeType: file.type,
                                data: file.data
                            }
                        });
                    } else if (file.displayType === 'pdf') {
                        // For PDFs, Gemini supports inlineData for application/pdf
                        parts.push({
                            inlineData: {
                                mimeType: file.type,
                                data: file.data
                            }
                        });
                    }
                }
            }
            contents.push({
                role: "user",
                parts: parts.length ? parts : [{ text: "" }]
            });
        } else if (entry.role === 'assistant') {
            contents.push({
                role: "model",
                parts: [{ text: entry.content }]
            });
        }
    }

    // Add current files if any (for new message)
    if (files && files.length > 0) {
        let fileParts = [];
        for (const file of files) {
            if (file.displayType === 'image') {
                fileParts.push({
                    inlineData: {
                        mimeType: file.type,
                        data: file.data
                    }
                });
            } else if (file.displayType === 'pdf') {
                fileParts.push({
                    inlineData: {
                        mimeType: file.type,
                        data: file.data
                    }
                });
            }
        }
        if (fileParts.length > 0) {
            contents.push({
                role: "user",
                parts: fileParts
            });
        }
    }

    const requestBody = {
        contents: contents,
        generationConfig: {
            temperature: 0.4,
            topK: 32,
            topP: 0.95,
            maxOutputTokens: 2048,
        },
        safetySettings: [
            // Optionally, you can add safety settings here
        ]
    };

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            const errorData = await response.json();
            console.error('API Error:', errorData);
            if (response.status === 404 && MODEL === "models/gemini-2.0-flash-exp") {
                addMessageToChat('system', 'Experimental model not available. Falling back to gemini-1.5-flash...');
                const fallbackResponse = await fetchFallbackResponseWithHistory(userLang, files);
                return fallbackResponse;
            }
            throw new Error(`API Error: ${response.status} ${response.statusText}`);
        }

        const data = await response.json();

        if (data.candidates && data.candidates.length > 0 && 
            data.candidates[0].content && 
            data.candidates[0].content.parts && 
            data.candidates[0].content.parts.length > 0) {
            let text = data.candidates[0].content.parts[0].text;
            text = linkify(text);
            return text;
        } else {
            console.error('Unexpected API response structure:', data);
            throw new Error('Invalid API response format');
        }
    } catch (error) {
        console.error('Fetch error:', error);
        throw error;
    }
}

async function fetchFallbackResponseWithHistory(userLang, files = []) {
    const fallbackUrl = `${API_URL}/models/gemini-1.5-flash:generateContent?key=${API_KEY}`;

    let langInstruction = '';
    if (userLang === 'darija') {
        langInstruction = `
IMPORTANT : L'utilisateur a posé sa question en darija (arabe marocain). 
Vous devez répondre uniquement en darija (arabe marocain), jamais en français ou dans une autre langue.
Utilisez un style naturel et compréhensible pour un marocain, et si possible, écrivez en alphabet arabe.
De temps en temps, si c'est pertinent, ajoutez à la fin de votre réponse une référence ou un lien fiable (par exemple vers un site médical reconnu) pour permettre à l'utilisateur d'approfondir le sujet.
Si l'utilisateur a envoyé une image ou un PDF, analysez le contenu et donnez un résumé ou une explication en darija.
`;
    } else {
        langInstruction = `
IMPORTANT : L'utilisateur a posé sa question en français. 
Vous devez répondre uniquement en français, jamais en darija ou dans une autre langue.
De temps en temps, si c'est pertinent, ajoutez à la fin de votre réponse une référence ou un lien fiable (par exemple vers un site médical reconnu) pour permettre à l'utilisateur d'approfondir le sujet.
Si l'utilisateur a envoyé une image ou un PDF, analysez le contenu et donnez un résumé ou une explication en français.
`;
    }
    const SYSTEM_PROMPT = BASE_SYSTEM_PROMPT + langInstruction;

    let contents = [
        {
            role: "user",
            parts: [
                { text: SYSTEM_PROMPT }
            ]
        }
    ];

    for (let i = 0; i < chatHistory.length; i++) {
        const entry = chatHistory[i];
        if (entry.role === 'user') {
            let parts = [];
            if (entry.content) parts.push({ text: entry.content });
            if (entry.files && Array.isArray(entry.files)) {
                for (const file of entry.files) {
                    if (file.displayType === 'image') {
                        parts.push({
                            inlineData: {
                                mimeType: file.type,
                                data: file.data
                            }
                        });
                    } else if (file.displayType === 'pdf') {
                        parts.push({
                            inlineData: {
                                mimeType: file.type,
                                data: file.data
                            }
                        });
                    }
                }
            }
            contents.push({
                role: "user",
                parts: parts.length ? parts : [{ text: "" }]
            });
        } else if (entry.role === 'assistant') {
            contents.push({
                role: "model",
                parts: [{ text: entry.content }]
            });
        }
    }

    // Add current files if any (for new message)
    if (files && files.length > 0) {
        let fileParts = [];
        for (const file of files) {
            if (file.displayType === 'image') {
                fileParts.push({
                    inlineData: {
                        mimeType: file.type,
                        data: file.data
                    }
                });
            } else if (file.displayType === 'pdf') {
                fileParts.push({
                    inlineData: {
                        mimeType: file.type,
                        data: file.data
                    }
                });
            }
        }
        if (fileParts.length > 0) {
            contents.push({
                role: "user",
                parts: fileParts
            });
        }
    }

    const requestBody = {
        contents: contents,
        generationConfig: {
            temperature: 0.4,
            topK: 32,
            topP: 0.95,
            maxOutputTokens: 2048,
        }
    };

    try {
        const response = await fetch(fallbackUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            throw new Error(`Fallback API Error: ${response.status} ${response.statusText}`);
        }

        const data = await response.json();

        if (data.candidates && data.candidates.length > 0 && 
            data.candidates[0].content && 
            data.candidates[0].content.parts && 
            data.candidates[0].content.parts.length > 0) {
            let text = data.candidates[0].content.parts[0].text;
            text = linkify(text);
            return text;
        } else {
            throw new Error('Invalid fallback API response format');
        }
    } catch (error) {
        console.error('Fallback fetch error:', error);
        throw error;
    }
}

// ===== LINKIFY FUNCTION =====
// Converts URLs in text to a banner of links at the end of the response
function linkify(text) {
    if (!text) return '';
    const links = [];
    const urlRegex = /(?:(?:https?:\/\/)|(?:www\.))[^\s\n<]+()/gi;
    let match;
    while ((match = urlRegex.exec(text)) !== null) {
        let url = match[0];
        if (url.endsWith('.') || url.endsWith(',') || url.endsWith(')') || url.endsWith(']')) {
            url = url.slice(0, -1);
        }
        let href = url;
        if (!href.match(/^https?:\/\//)) {
            href = 'http://' + href;
        }
        if (!links.some(link => link.url === url)) {
            links.push({
                url: url,
                href: href,
                title: url.replace(/^https?:\/\//, '').replace(/^www\./, '').split('/')[0]
            });
        }
    }
    if (links.length > 0) {
        let banner = '<div class="reference-banner"><h4>Références:</h4><ul>';
        links.forEach(link => {
            banner += `<li><a href="${link.href}" target="_blank" rel="noopener noreferrer">${link.title}</a></li>`;
        });
        banner += '</ul></div>';
        text += banner;
    }
    return text;
}