"use strict;"

if (!window.WebSocket) {
  alert('Ваш браузер не поддерживает Веб-сокеты');
}
const webSocket = new WebSocket('ws://chat.ws:8080?channel=' + channel);

document.getElementById('chat_form')
  .addEventListener('submit', function (event) {
    const data = {
      message: this.message.value,
      channel: this.channel.value,
      user_id: this.user_id.value,
    };
    webSocket.send(JSON.stringify(data));
    event.preventDefault();
    return false;
  });


webSocket.onmessage = function (event) {
  const data = JSON.parse(event.data);
  const messageContainer = document.createElement('div');
  let textNode = document.createTextNode(data.created_at);
  messageContainer.appendChild(textNode);
  const strongUsername = document.createElement('strong');
  textNode = document.createTextNode(' ' + data.username);
  strongUsername.appendChild(textNode);
  messageContainer.appendChild(strongUsername);
  textNode = document.createTextNode(' ' + data.message);
  messageContainer.appendChild(textNode);
  document.querySelector('.chat')
    .appendChild(messageContainer);
  document.getElementsByName('message')[0].value = '';
}

