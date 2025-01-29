<div class="page-heading">
    <h1 class="page-title">Profile</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Profile</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="ibox">
                <div class="ibox-body text-center">
                    <div class="m-t-20">
                        <img class="img-circle" src="http://localhost/Complaints/css/assets/img/admin-avatar.png" />
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10"><?= $_SESSION['user_name'] ?></h5>
                    <div class="m-b-20 text-muted">Web Developer</div>
                    <div class="profile-social m-b-20">
                        <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:;"><i class="fa fa-pinterest"></i></a>
                        <a href="javascript:;"><i class="fa fa-dribbble"></i></a>
                    </div>
                   
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-body">
                    <div class="row text-center m-b-20">
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">15</div>
                            <div class="text-muted">الشكاوي المنتظرة</div>
                        </div>
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">20</div>
                            <div class="text-muted">الشكاوي المحلولة</div>
                        </div>
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">15</div>
                            <div class="text-muted">الرسائل</div>
                        </div>
                    </div>
                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum
                        has been</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="ibox">
                <div class="ibox-body">
                    <ul class="nav nav-tabs tabs-line">

                        <li class="nav-item">
                            <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-announcement"></i>
                                Complaints</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                        <div class="tab-pane fade" id="tab-2">
                            <form action="dashboard.php" method="post">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>" >
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Full Name</label>
                                        <input name="fullname" class="form-control" type="text" placeholder="First Name" value="<?= $user['fullname'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" type="text" placeholder="Email address" value="<?= $user['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="ui-checkbox">
                                        <input type="checkbox">
                                        <span class="input-span"></span>Remamber me</label>
                                </div>
                                <div class="form-group">
                                    <input name="update_profile" class="btn btn-default" type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-3">
                            <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-bullhorn"></i> Latest Complaints</h5>
                            <ul class="media-list media-list-divider m-0">
                                <!-- عرض الشكاوي -->
                                <?php foreach($complaints as $complaint): ?>
                                <li class="media">
                                    <div class="media-img"><i class="ti-user font-18 text-muted"></i></div>
                                    <div class="media-body">
                                        <div class="media-heading"><?= $complaint['type'] ?><small
                                                class="float-right text-muted"><?= $complaint['submission_date'] ?></small></div>
                                        <div class="font-13"><?= $complaint['description'] ?></div>
                                    </div>
                                </li>
                                <?php endforeach ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- إضافة زر الدردشة العائم ونافذة المحادثة -->
<div class="chat-button" onclick="toggleChat()" style="background: var(--mian_color); color: white;" >
    <i class="fa fa-comments" style="color: var(--crame);"></i>
</div>

<div class="chat-window" id="chatWindow">
    <div class="chat-header">
        <span>المحادثة مع الإدارة</span>
        <button class="close-chat" onclick="toggleChat()">×</button>
    </div>
    <div class="chat-body" id="chatBody">
        <?php foreach($messages as $message): ?>
            <div class="message <?= ($message['sender_id'] == $_SESSION['user_id']) ? 'sent' : 'received' ?>">
                <div class="message-content"><?= $message['message_content'] ?></div>
                <div class="message-info">
                    <span class="message-time"><?= $message['created_at'] ?></span>
                    <span class="message-sender"><?= $message['fullname'] ?></span>
                    <?php if($message['sender_id'] != $_SESSION['user_id']): ?>
                        <button class="reply-btn" onclick="replyToMessage('<?= $message['fullname'] ?>')">
                            <i class="fa fa-reply"></i> رد
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <form id="messageForm" onsubmit="sendMessage(event)">
    <div class="chat-footer">
        <input type="text" name="message" id="messageInput" placeholder="اكتب رسالتك هنا..." required>
        <button type="submit" name="send_message" style="background: var(--mian_color); color: white;" ><i class="fa fa-paper-plane"></i></button>
    </div>
    </form>
</div>
    <style>
    .profile-social a {
        font-size: 16px;
        margin: 0 10px;
        color: #999;
    }

    .profile-social a:hover {
        color: #485b6f;
    }

    .profile-stat-count {
        font-size: 22px
    }

    .message {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 8px;
        max-width: 80%;
        
    }

    .sent {
        background-color: #007bff;
        color: white;
        margin-left: auto;
    }

    .received {
        background-color: #f1f1f1;
        margin-right: auto;
    }

    .message-content {
        margin-bottom: 5px;
    }

    .message-info {
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .message-time, .message-sender {
        color: #666;
    }

    .sent .message-time, .sent .message-sender {
        color: rgba(255, 255, 255, 0.8);
    }

    .reply-btn {
        background: none;
        border: none;
        color: #007bff;
        font-size: 12px;
        cursor: pointer;
        padding: 2px 8px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .reply-btn:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }
    </style>
</div>

<style>
    /* Existing styles ... */
:root{
    --mian_color: #257180;
    --crame: #F2E5BF;
    --orange: #FD8B51;
    --brown: #CB6040;
    --gray: #dadadae2;
}
    .chat-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background-color: #007bff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 1000;
    }

    .chat-button i {
        color: white;
        font-size: 24px;
    }

    .chat-window {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 300px;
        height: 400px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        display: none;
        z-index: 1000;
        flex-direction: column;
    }

    .chat-header {
        padding: 15px;
        background: var(--mian_color);
        color: white;
        border-radius: 10px 10px 0 0;
        display: flex;
        justify-content: space-between;
    }

    .chat-body {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
    }

    .chat-footer {
        padding: 15px;
        border-top: 1px solid #eee;
        display: flex;
    }

    .chat-footer input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-right: 10px;
    }

    .chat-footer button {
        background: #007bff;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
    }

    .close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
</style>
<script>
function toggleChat() {
    const chatWindow = document.getElementById('chatWindow');
    if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
        chatWindow.style.display = 'flex';
    } else {
        chatWindow.style.display = 'none';
    }
}

function sendMessage(e) {
    if(e) {
        e.preventDefault();
    }
    
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();
    
    if (message) {
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `message=${encodeURIComponent(message)}&send_message=1`
        })
        .then(response => {
            if(response.ok) {
                messageInput.value = '';
                // Add message to chat window
                const chatBody = document.getElementById('chatBody');
                const messageElement = document.createElement('div');
                messageElement.style.marginBottom = '10px';
                messageElement.style.textAlign = 'right';
                messageElement.innerHTML = `
                    <div style="background: var(--mian_color); color: white; padding: 8px 15px; border-radius: 20px; display: inline-block;">
                        ${message}
                    </div>
                `;
                chatBody.appendChild(messageElement);
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function replyToMessage(username) {
    const messageInput = document.getElementById('messageInput');
    messageInput.value = `@${username} `;
    messageInput.focus();
}

</script>
