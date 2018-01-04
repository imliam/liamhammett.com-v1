window._ = require('lodash')
window.$ = window.jQuery = require('jquery')
import Typed from 'typed.js'

const ellipsis = ".^500.^500.^500"

const messages = [
    [
        "Dad,^50 I'm hungry! ^500🍔^500🍟",
        "Hi hungry, I'm <div class='text-green-darker text-5xl font-extrabold tracking-wide'>LIAM</div>",
        ellipsis,
        showTaglineWithGreeting
    ],
    [
        "I'll call you later... ^200📞",
        "Don't call me Later, call me <div class='text-green-darker text-5xl font-extrabold tracking-wide'>LIAM</div>",
        `${ellipsis}<br><br>Never mind, I'm blocking you`,
        showTaglineWithGreeting
    ],
    [
        "Can you call me a taxi?",
        "You're a taxi. And I'm <div class='text-green-darker text-5xl font-extrabold tracking-wide'>LIAM</div>",
        [
            `${ellipsis}<br><br>I'll think just get an Uber`,
            `${ellipsis}<br><br>Maybe I should walk`,
            `${ellipsis}<br><br>I'll get my own cab then`
        ],
        showTaglineWithGreeting
    ],
    [
        "Make me a sandwich 🍔",
        "Poof! 💨^200 You're a sandwich!",
        showGreeting,
        showTagline
    ],
    [
        "",
        "Do you know why I can't be buried in a cemetery?",
        "No, why not?",
        "Because I'm not dead yet! 💀",
        showGreeting,
        showTagline
    ]
]

/**
 * Display chat messages consecutively to form a conversation-like interface.
 *
 * @param {array} conversation  Array of chat messages in the conversation.
 * @param {bool}  fromSelf      If true, the message will display from the
 *                              right-hand-side, as if you are the sender.
 *                              If false, it will display as another
 *                              participant's message.
 */
function chat(conversation, fromSelf) {
    if (typeof conversation === 'undefined' || conversation.length === 0) {
        return
    }

    fromSelf = Boolean(fromSelf);
    const templateSelector = fromSelf ? '#chat-self' : '#chat-other'
    let templateHTML = $(templateSelector).html()

    let message = conversation.shift()
    if (typeof message === 'object') {
        message = message[Math.floor(Math.random() * message.length)]
    } else if (typeof message === 'function') {
        message = message()
        if (typeof message === 'undefined') {
            message = ''
        }
    }

    if (message.length === 0) {
        return chat(conversation, !fromSelf)
    }

    $(templateHTML)
        .attr('id', `chat-message-${conversation.length}`)
        .appendTo('#chat-messages')

    new Typed(`#chat-message-${conversation.length} [data-chat-text]`, {
        strings: [message],
        typeSpeed: 50,
        showCursor: false,
        contentType: 'html',
        onComplete: function () {
            if (conversation.length) {
                chat(conversation, !fromSelf)
            }
        }
    })
}

function showGreeting() {
    $('#greeting').removeClass('hidden').addClass('animated fadeInUp')
}

function showTagline() {
    $('#tagline').removeClass('hidden').addClass('animated fadeInUp')
}

function showTaglineWithGreeting() {
    $('#greeting-small').removeClass('hidden')
    showTagline()
}

// Start the conversation...
$(function () {
    let conversation = messages[Math.floor(Math.random() * messages.length)]
    chat(conversation)
})
