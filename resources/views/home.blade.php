<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="UkkSDiiSpum746cEE5jgfEIz5UBbnzYCXYigwcIn">

    <title>MyExchangeBot</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="http://myexchangebot.local/css/app.css">

    <!-- Livewire Styles -->
    <style>
        [wire\:loading], [wire\:loading\.delay] {
            display: none;
        }

        [wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {
            animation-duration: 50000s;
            animation-name: livewireautofill;
        }

        @keyframes livewireautofill {
            from {
            }
        }


        .unread {
            cursor: pointer;
            background-color: #f4f4f4;
        }

        .messages-box {
            max-height: 26rem;
            overflow: auto;
        }

        .online-circle {
            border-radius: 5rem;
            width: 5rem;
            height: 5rem;
        }

        .messages-title {
            float: right;
            margin: 0px 5px;
        }

        .message-img {
            float: right;
            margin: 0px 5px;
        }

        .message-header {
            text-align: right;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .text-editor {
            min-height: 18rem;
        }

        .messages-list li.messages-you .messages-title {
            float: left;
        }

        .messages-list li.messages-you .message-img {
            float: left;
        }

        .messages-list li.messages-you p {
            float: left;
            text-align: left;
        }

        .messages-list li.messages-you .message-header {
            text-align: left;
        }

        .messages-list li p {
            max-width: 60%;
            padding: 5px;
            border: #e6e7e9 1px solid;
        }

        .messages-list li.messages-me p {
            float: right;
        }

        .ql-editor p {
            font-size: 1rem;
        }
    </style>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <!-- Logo -->
        <div class="max-w-10xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My ExchangeBot
            </h2>
        </div>
    </header>
    <!-- Page Content -->
    <main>
        <div class="py-2">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="sm:px-15 bg-white border-b border-gray-200">
                        <div class="mt-3 text-2xl">
                            Welcome to your personal exchange bot application!
                        </div>

                        <div class="mt-3 text-gray-500">
                            My ExchangeBot is a chatbot where you can make financial transactions in your currency!
                            Start now!
                        </div>
                        <!--start code-->
                        <div class="card">
                            <div class="mt-3 card-body messages-box">
                                <ul class="list-unstyled messages-list">
                                    <li class="messages-me clearfix start_chat">
                                        Please type something to start!
                                    </li>
                                    {{--                                            <li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:35 AM</span></small> </div><p class="messages-p">Hi</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:35 AM</span></small> </div><p class="messages-p">Hello, how are you.</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:35 AM</span></small> </div><p class="messages-p">Fine</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:35 AM</span></small> </div><p class="messages-p">Sorry not be able to understand you</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">whats your name</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">My name is MyExchangeBot</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">where are you from?</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">Sorry not be able to understand you</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">where are you from?</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">Sorry not be able to understand you</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">where are you from</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:36 AM</span></small> </div><p class="messages-p">Sorry not be able to understand you</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">where are your from?</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">Sorry not be able to understand you</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">where are your from</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">I m from Brazil</p></div></li><li class="messages-me clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">Bye</p></div></li><li class="messages-you clearfix"><span class="message-img"><img src="http://myexchangebot.local/img/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">01:37 AM</span></small> </div><p class="messages-p">Sad to see you are going. Have a nice day</p></div></li>--}}
                                </ul>
                            </div>

                            <div class="card-header">
                                <div class="input-group">
                                    <input id="input-me" type="text" name="messages"
                                           class="form-input rounded-md shadow-sm"
                                           placeholder="Type your message here..."/>
                                    <span class="input-group-append">
                                                <button
                                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                                    id="myBtn" onclick="sendMessage()">
                                                    Send
                                                </button>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <!--end code-->
                        <div class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
<script type="text/javascript">

    $(document).ready(function () {
        $('#input-me').keypress(function (e) {
            if (e.keyCode === 13)
                $('#myBtn').click();
        });
    });

    function sendMessage() {
        const messageListObj = $('.messages-list');
        const messagesBoxObj = $('.messages-box');
        const inputMeObj = $('#input-me');
        const startChatObj = $('.start_chat');
        const question = inputMeObj.val();
        if (question) {
            startChatObj.hide();
            const messageUser = getMessageUserTag(question);
            messageListObj.append(messageUser);
            inputMeObj.val("");
            $.ajax({
                url: "/api/process",
                type: "POST",
                data: JSON.stringify({question: question}),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (result) {
                    const messageBot = getMessageBotTag(result.data.reply)
                    messageListObj.append(messageBot);
                    messagesBoxObj.scrollTop(messagesBoxObj[0].scrollHeight);
                }
            });
        }
    }


    function getMessageUserTag(message) {
        return getMessageTag(message, 'messages-me', 'img/user_avatar.png', 'Me');
    }

    function getMessageBotTag(message) {
        return getMessageTag(message, 'messages-you', 'img/bot_avatar.png', 'Chatbot');
    }

    function getMessageTag(message, clazz, img, title) {
        return '' +
            '<li class="' + clazz + ' clearfix">' +
            '   <span class="message-img">' +
            '       <img src="' + img + '" class="avatar-sm rounded-circle">' +
            '   </span>' +
            '   <div class="message-body clearfix">' +
            '       <div class="message-header">' +
            '           <strong class="messages-title">' + title + '</strong>' +
            '           <small class="time-messages text-muted">' +
            '               <span class="fas fa-time"></span>' +
            '               <span class="minutes">' + getCurrentTime() + '</span>' +
            '           </small>' +
            '       </div>' +
            '       <p class="messages-p">' + message + '</p>' +
            '   </div>' +
            '</li>';
    }

    function getCurrentTime() {
        const now = new Date();
        let hh = now.getHours();
        const ampm = (hh >= 12) ? 'PM' : 'AM';
        hh = hh % 12;
        hh = hh ? hh : 12;
        hh = hh < 10 ? '0' + hh : hh;
        let min = now.getMinutes();
        min = min < 10 ? '0' + min : min;
        return hh + ":" + min + " " + ampm;
    }
</script>
</html>

