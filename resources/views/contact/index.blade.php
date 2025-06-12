@extends($layout)

@section('content')
<div class="chat-container">
    <div class="chat-wrapper">
        <!-- Sidebar avec liste des conversations -->
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <h4 class="mb-0">
                    @if(auth()->user()->is_admin)
                        Chat Admin
                    @else
                        Support
                    @endif
                </h4>
            </div>

            @if(auth()->user()->is_admin)
                <!-- Barre de recherche pour admin -->
                <div class="search-container">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un utilisateur...">
                    </div>
                </div>

                <!-- Liste des conversations pour admin -->
                <div class="conversations-list" id="conversationsList">
    @foreach($users as $user)
        <div class="conversation-item" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}">
            <div class="conversation-link">
                <div class="conversation-avatar">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff"
                         alt="{{ $user->name }}" class="avatar-img">
                </div>
                <div class="conversation-content">
                   <div class="conversation-header">
        <h6 class="conversation-name">{{ $user->name }}</h6>
        <span class="conversation-time">
            @if($user->latest_message)
                {{ $user->latest_message->created_at->format('H:i') }}
            @else
                --
            @endif
        </span>
    </div>

    <p class="conversation-preview">
        @if($user->latest_message)
            {{ Str::limit($user->latest_message->message, 50) }}
        @else
            Aucun message
        @endif
    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

            @else
                <!-- Vue simplifiée pour utilisateur -->
                <div class="conversations-list">
                    <div class="conversation-item active">
                        <div class="conversation-link">
                            <div class="conversation-avatar">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=dc3545&color=fff"
                                     alt="Admin" class="avatar-img">
                            </div>
                            <div class="conversation-content">
                                <div class="conversation-header">
                                    <h6 class="conversation-name">Administrateur</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Zone de chat principale -->
        <div class="chat-main">
            @if(auth()->user()->is_admin)
                <!-- Vue par défaut pour admin -->
                <div class="chat-welcome" id="chatWelcome">
                    <div class="chat-header">
                        <div class="chat-header-info">
                            <div class="chat-avatar1">
                                <img src="https://ui-avatars.com/api/?name=Support&background=28a745&color=fff"
                                     alt="Support" class="avatar-img">
                            </div>
                            <div class="chat-user-info">
                                <h6 class="chat-user-name">Support Général</h6>
                                <span class="chat-user-status">Messages récents</span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages par défaut -->
                    <div class="chat-messages" id="defaultChatMessages">
                        @if(isset($defaultMessages) && count($defaultMessages) > 0)
                            @foreach($defaultMessages as $msg)
                                <div class="message-wrapper {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    <div class="message-bubble">
                                        <div class="message-content">{{ $msg->message }}</div>
                                        <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                                        <div class="message-sender">
                                            <small>{{ $msg->sender->name ?? 'Utilisateur' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-messages">
                                <i class="fas fa-comments empty-icon"></i>
                                <h6>Messages de support</h6>
                                <p>Les messages entre utilisateurs et administrateurs apparaîtront ici</p>
                            </div>
                        @endif
                    </div>

                    <!-- Zone de saisie pour message général -->
                    <div class="chat-input-container">
                        <form id="defaultChatForm" class="chat-form">
                            @csrf
                            <div class="chat-input-wrapper">
                                <input type="text" id="defaultMessageInput" class="chat-input" placeholder="Message général..." required>
                                <button type="submit" class="btn btn-primary send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Conversation active -->
                <div class="chat-active" id="chatActive" style="display: none;">
                    <div class="chat-header">
                        <div class="chat-header-info">
                            <div class="chat-avatar1">
                                <img src="" alt="User" class="avatar-img" id="chatUserAvatar">
                            </div>
                            <div class="chat-user-info">
                                <h6 class="chat-user-name" id="chatUserName">Utilisateur</h6>
                                <span class="chat-user-status" id="chatUserEmail"></span>
                            </div>
                        </div>
                        <div class="chat-header-actions">
                            <button class="btn btn-sm btn-outline-secondary" id="closeChatBtn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chatMessages">
                        <!-- Messages chargés via AJAX -->
                    </div>

                    <div class="chat-input-container">
                        <form id="chatForm" class="chat-form">
                            @csrf
                            <input type="hidden" id="selectedUserId" name="user_id" value="">
                            <div class="chat-input-wrapper">
                                <input type="text" id="messageInput" name="message" class="chat-input" placeholder="Tapez votre message..." required>
                                <button type="submit" class="btn btn-primary send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- Vue utilisateur normal -->
                <div class="chat-header">
                    <div class="chat-header-info">
                        <div class="chat-avatar">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=dc3545&color=fff"
                                 alt="Admin" class="avatar-img">
                        </div>
                        <div class="chat-user-info">
                            <h6 class="chat-user-name">Administrateur</h6>
                        </div>
                    </div>
                </div>

                <div class="chat-messages" id="userChatMessages">
                    @foreach($messages as $msg)
                        <div class="message-wrapper {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                            <div class="message-bubble">
                                <div class="message-content">{{ $msg->message }}</div>
                                <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="chat-input-container">
                    <form id="userChatForm" class="chat-form">
                        @csrf
                        <div class="chat-input-wrapper">
                            
                            <input type="text" id="userMessageInput" name="message" class="chat-input" placeholder="Tapez votre message..." required>
                            <button type="submit" class="btn btn-primary send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
<style>
.chat-container {
  height: 120vh;
    background: linear-gradient(135deg, #667eea 0%, #f1f1f1 100%);
    padding: 20px;
  
}

.chat-wrapper {
    display: flex;
    height: 100%;
    max-width: 1400px;
    margin: 0 auto;
    background: #f8f9fa;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow-y: auto;

}

/* Sidebar */
.chat-sidebar {
    width: 350px;
    background: #f8f9fa;
    border-right: 1px solid #e9ecef;
    display: flex;
    flex-direction: column;
}

.chat-sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    background: white;
}

.search-container {
    padding: 15px;
    background: white;
    border-bottom: 1px solid #e9ecef;
}

.search-input-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 14px;
}

.search-input {
    width: 100%;
    padding: 10px 12px 10px 35px;
    border: 1px solid #e9ecef;
    border-radius: 20px;
    font-size: 14px;
    background: #f8f9fa;
}

.search-input:focus {
    outline: none;
    border-color: #6366f1;
    background: white;
}

.conversations-list {
    flex: 1;
    overflow-y: auto;
    height: 100%;
}

.conversation-item {
    border-bottom: 1px solid #e9ecef;
    transition: all 0.2s;
    cursor: pointer;
}

.conversation-item:hover {
    background: #f1f3f4;
}

.conversation-item.active {
    background: #e3f2fd;
    border-right: 3px solid #6366f1;
}

.conversation-link {
    display: flex;
    padding: 15px;
    text-decoration: none;
    color: inherit;
}

.conversation-avatar {
    margin-right: 12px;
}
.conversation-avatar img{
    position: relative;
}

.avatar-img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}


.conversation-content {
    flex: 1;
    min-width: 0;
}

.conversation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.conversation-name {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    color: #2d3748;
}

.conversation-time {
    font-size: 12px;
    color: #6c757d;
}

.conversation-status {
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 10px;
    background: #28a745;
    color: white;
}

.conversation-preview {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Zone de chat principale */
.chat-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: white;
}

.chat-active {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.chat-welcome {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: white;
     overflow-y: auto;
}

.empty-messages {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    text-align: center;
    padding: 40px 20px;
}

.empty-icon {
    font-size: 48px;
    margin-bottom: 16px;
    color: #6366f1;
}

.message-sender {
    margin-top: 2px;
    text-align: right;
}

.message-sender small {
    font-size: 10px;
    opacity: 0.6;
}

.welcome-content {
    text-align: center;
    color: #6c757d;
}

.welcome-icon {
    font-size: 48px;
    margin-bottom: 16px;
    color: #6366f1;
}

.chat-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-header-info {
    display: flex;
    align-items: center;
}

.chat-avatar {
    margin-right: 12px;
}
.chat-avatar1 {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;

        margin-right: 10px;
    }
.chat-avatar1 img{
    position: relative;
}

.chat-user-name {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #2d3748;
}

.chat-user-status {
    font-size: 13px;
    color: #6c757d;
}

.chat-header-actions {
    display: flex;
    gap: 8px;
}

.chat-messages {
    flex: 1;
    padding: 20px;

    background: #f8f9fa;
}

.message-wrapper {
    margin-bottom: 16px;
    display: flex;

}

.message-wrapper.sent {
    justify-content: flex-end;
}

.message-wrapper.received {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
}

.message-wrapper.sent .message-bubble {
    background: #6366f1;
    color: white;
    border-bottom-right-radius: 4px;
}

.message-wrapper.received .message-bubble {
    background: white;
    color: #2d3748;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 4px;
}

.message-content {
    margin-bottom: 4px;
    line-height: 1.4;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
}

.chat-input-container {
    padding: 20px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.chat-form {
    width: 100%;
}

.chat-input-wrapper {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 25px;
    padding: 8px;
    border: 1px solid #e9ecef;
}

.chat-input-wrapper:focus-within {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.attachment-btn {
    padding: 8px 12px;
    color: #6c757d;
    border: none;
    background: none;
}

.attachment-btn:hover {
    color: #6366f1;
}

.chat-input {
    flex: 1;
    border: none;
    background: none;
    padding: 8px 12px;
    font-size: 14px;
    outline: none;
}

.send-btn {
    padding: 8px 16px;
    border-radius: 20px;
    border: none;
    background: #6366f1;
    color: white;
    font-size: 14px;
}

.send-btn:hover {
    background: #5856eb;
}

.loading-message {
    text-align: center;
    padding: 20px;
    color: #6c757d;
}

/* Responsive */
@media (max-width: 768px) {
    .chat-container {
        padding: 10px;
    }

    .chat-sidebar {
        width: 100%;
        max-width: 300px;
    }

    .chat-wrapper {
        flex-direction: column;
        height: calc(100vh - 20px);
    }

    .chat-main {
        flex: 1;
        min-height: 0;
    }

    .message-bubble {
        max-width: 85%;
    }
}

/* Scrollbar personnalisé */
.conversations-list::-webkit-scrollbar,
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.conversations-list::-webkit-scrollbar-track,
.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.conversations-list::-webkit-scrollbar-thumb,
.chat-messages::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.conversations-list::-webkit-scrollbar-thumb:hover,
.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const chatWelcome = document.getElementById('chatWelcome');
    const chatActive = document.getElementById('chatActive');
    const chatMessages = document.getElementById('chatMessages');
    const defaultChatMessages = document.getElementById('defaultChatMessages');
    const userChatMessages = document.getElementById('userChatMessages');
    const chatForm = document.getElementById('chatForm');
    const defaultChatForm = document.getElementById('defaultChatForm');
    const userChatForm = document.getElementById('userChatForm');
    const messageInput = document.getElementById('messageInput');
    const defaultMessageInput = document.getElementById('defaultMessageInput');
    const userMessageInput = document.getElementById('userMessageInput');
    const selectedUserIdInput = document.getElementById('selectedUserId');
    const closeChatBtn = document.getElementById('closeChatBtn');
    const searchInput = document.getElementById('searchInput');
    const chatUserName = document.getElementById('chatUserName');
    const chatUserEmail = document.getElementById('chatUserEmail');
    const chatUserAvatar = document.getElementById('chatUserAvatar');

    const isAdmin = {{ auth()->user()->is_admin ? 'true' : 'false' }};
    const currentUserId = {{ auth()->id() }};


    // Fonctions utilitaires
    function scrollToBottom(element = null) {
        const target = element || chatMessages || userChatMessages;
        if (target) {
            setTimeout(() => {
                target.scrollTop = target.scrollHeight;
            }, 100);
        }
    }

    function formatTime(dateString) {
        return new Date(dateString).toLocaleTimeString('fr-FR', {
            hour: '2-digit', 
            minute: '2-digit'
        });
    }

    function createMessageHTML(message, isCurrentUser) {
        const messageClass = isCurrentUser ? 'sent' : 'received';
        const time = formatTime(message.created_at);
        
        return `
            <div class="message-wrapper ${messageClass}">
                <div class="message-bubble">
                    <div class="message-content">${message.message}</div>
                    <div class="message-time">${time}</div>
                    ${message.sender ? `<div class="message-sender"><small>${message.sender.name}</small></div>` : ''}
                </div>
            </div>
        `;
    }

    function showError(message) {
        console.error('Erreur:', message);
        // Vous pouvez ajouter ici une notification toast
    }

    // Gestion des conversations (Admin)
    if (isAdmin) {
        // Clic sur une conversation
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.addEventListener('click', function() {
                // Mise à jour UI
                document.querySelectorAll('.conversation-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');

                // Données utilisateur
                const userId = this.dataset.userId;
                const userName = this.dataset.userName;
                const userEmail = this.dataset.userEmail;

                // Mise à jour interface
                if (chatUserName) chatUserName.textContent = userName;
                if (chatUserEmail) chatUserEmail.textContent = userEmail;
                if (chatUserAvatar) {
                    chatUserAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=6366f1&color=fff`;
                }
                if (selectedUserIdInput) selectedUserIdInput.value = userId;

                // Basculer vers la vue conversation
                if (chatWelcome) chatWelcome.style.display = 'none';
                if (chatActive) chatActive.style.display = 'flex';

                // Charger les messages
                loadUserMessages(userId);
            });
        });

        // Fermer conversation
        if (closeChatBtn) {
            closeChatBtn.addEventListener('click', function() {
                if (chatActive) chatActive.style.display = 'none';
                if (chatWelcome) chatWelcome.style.display = 'flex';
                document.querySelectorAll('.conversation-item').forEach(el => el.classList.remove('active'));
                if (selectedUserIdInput) selectedUserIdInput.value = '';
            });
        }

        // Message général (admin)
       // Charger les anciens messages généraux au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    fetch('/messagerie/messages-generaux') // Crée cette route Laravel
        .then(response => response.json())
        .then(data => {
            if (data.success && data.messages) {
                data.messages.forEach(msg => {
                    const isMine = msg.sender_id === currentUserId; // à définir dans Blade
                    const html = createMessageHTML({
                        message: msg.message,
                        created_at: msg.created_at,
                        sender: { name: msg.sender.name }
                    }, isMine);
                    defaultChatMessages.insertAdjacentHTML('beforeend', html);
                });
                scrollToBottom(defaultChatMessages);
            }
        })
        .catch(error => showError("Erreur de chargement des messages généraux : " + error.message));
});

// Envoi du message général (admin uniquement)
if (defaultChatForm && defaultMessageInput) {
    defaultChatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = defaultMessageInput.value.trim();
        if (!message) return;

        fetch('/messagerie/send-general', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const messageHTML = createMessageHTML({
                    message: message,
                    created_at: new Date().toISOString(),
                    sender: { name: data.sender_name }
                }, true);

                if (defaultChatMessages) {
                    defaultChatMessages.insertAdjacentHTML('beforeend', messageHTML);
                    scrollToBottom(defaultChatMessages);
                }
                defaultMessageInput.value = '';
            } else {
                showError('Erreur lors de l\'envoi du message');
            }
        })
        .catch(error => showError(error.message));
    });
}

        // Message individuel (admin)
        if (chatForm && messageInput && selectedUserIdInput) {
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = messageInput.value.trim();
        const userId = selectedUserIdInput.value;
        
        if (!message || !userId) return;

        fetch('/messagerie/send-user', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: message,
                user_id: userId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                
                const messageHTML = createMessageHTML({
                    message: message,
                    created_at: new Date().toISOString()
                }, true); // true = message de l'admin
                
                if (chatMessages) {
                    chatMessages.insertAdjacentHTML('beforeend', messageHTML);
                    scrollToBottom(chatMessages);
                }
                messageInput.value = '';
            } else {
                showError('Erreur lors de l\'envoi du message');
            }
        })
        .catch(error => 
        showError(error.message)
    );
    });
}

// 🔧 Fonction pour créer le bloc HTML du message
function createMessageHTML(messageData, isAdmin) {
    const alignment = isAdmin ? 'text-right' : 'text-left';
    const bgColor = isAdmin ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800';
    const time = new Date(messageData.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    return `
        <div class="${alignment} my-2">
            <div class="inline-block px-4 py-2 rounded-lg ${bgColor} max-w-xs break-words">
                ${messageData.message}
                <div class="text-xs text-gray-300 mt-1">${time}</div>
            </div>
        </div>
    `;
}

// 🔽 Fonction pour scroller automatiquement en bas
function scrollToBottom(container) {
    container.scrollTop = container.scrollHeight;
}

// 🔔 Fonction pour afficher une erreur
function showError(message) {
    alert(message); // Tu peux remplacer ça par une alerte stylée ou une div d’erreur
}


        // Recherche
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.conversation-item').forEach(conversation => {
                    const userName = conversation.dataset.userName.toLowerCase();
                    const userEmail = conversation.dataset.userEmail.toLowerCase();
                    
                    conversation.style.display = 
                        userName.includes(searchTerm) || userEmail.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }

        // Charger messages par défaut
        loadDefaultMessages();
    } else {
        // Gestion utilisateur normal
        if (userChatForm && userMessageInput) {
    userChatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = userMessageInput.value.trim();
        if (!message) return;

        // Affichage immédiat du message dans l'interface
        const messageHTML = createMessageHTML({
            message: message,
            created_at: new Date().toISOString(),
            // ou laisse vide si tu préfères
        }, true); // true = current user

        if (userChatMessages) {
            userChatMessages.insertAdjacentHTML('beforeend', messageHTML);
            scrollToBottom(userChatMessages);
        }

        userMessageInput.value = ''; // vider le champ

        // Envoi au serveur
        fetch('/messagerie/send-admin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                showError('Erreur lors de l\'envoi du message');
            }
        })
        .catch(error => showError(error.message));
    });
}

      
    }

    // Fonctions de chargement
    function loadUserMessages(userId) {
        if (!chatMessages) return;
        
        chatMessages.innerHTML = '<div class="loading-message"><i class="fas fa-spinner fa-spin"></i> Chargement...</div>';

        fetch(`/messagerie/messages/${userId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let messagesHTML = '';
                data.messages.forEach(msg => {
                    const isCurrentUser = msg.sender_id == currentUserId;
                    messagesHTML += createMessageHTML(msg, isCurrentUser);
                });
                
                chatMessages.innerHTML = messagesHTML || '<div class="empty-messages">Aucun message</div>';
                scrollToBottom(chatMessages);
            } else {
                chatMessages.innerHTML = '<div class="error-message">Erreur lors du chargement</div>';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            chatMessages.innerHTML = '<div class="error-message">Erreur de connexion</div>';
        });
    }

   function loadDefaultMessages() {
    if (!defaultChatMessages) return;

    fetch('/messagerie/all-messages', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.messages.length > 0) {
            let messagesHTML = '';

            data.messages.forEach(msg => {
                const isCurrentUser = msg.sender_id == currentUserId;
                messagesHTML += createMessageHTML(msg, isCurrentUser); // += au lieu de =
            });

            // Affiche les messages seulement si aucun n'est encore affiché
            const existingMessages = defaultChatMessages.querySelectorAll('.message-wrapper');
            if (existingMessages.length === 0) {
                defaultChatMessages.innerHTML = messagesHTML;
                scrollToBottom(defaultChatMessages);
            }
        }
    })
    .catch(error => console.error('Erreur chargement messages par défaut:', error));
}

    // Gestion Enter pour envoyer
    [defaultMessageInput, messageInput, userMessageInput].forEach(input => {
        if (input) {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.closest('form').dispatchEvent(new Event('submit'));
                }
            });
        }
    });

    // Auto-scroll initial
    scrollToBottom();
    console.log("Message envoyé et affiché :", messageHTML);
});
</script>

@endsection