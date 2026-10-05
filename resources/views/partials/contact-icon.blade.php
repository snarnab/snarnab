<svg class="contact-option-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    @switch($type)
        @case('email')
            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
            <path d="m3 7 9 6 9-6"></path>
            @break
        @case('phone')
            <path d="M5 3h4l2 5-2.5 1.5a14 14 0 0 0 6 6L16 13l5 2v4a2 2 0 0 1-2 2A17 17 0 0 1 3 5a2 2 0 0 1 2-2Z"></path>
            @break
        @case('location')
            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path>
            <circle cx="12" cy="10" r="2.5"></circle>
            @break
        @case('linkedin')
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6ZM2 9h4v12H2z"></path>
            <circle cx="4" cy="4" r="2"></circle>
            @break
        @case('github')
            <path d="M9 19c-4.3 1.4-4.3-2.5-6-3m12 6v-3.9a3.4 3.4 0 0 0-.9-2.7c3-.3 6.2-1.5 6.2-6.7a5.2 5.2 0 0 0-1.4-3.6 4.8 4.8 0 0 0-.1-3.6s-1.2-.4-3.8 1.4a13 13 0 0 0-6.9 0C5.5 1.1 4.3 1.5 4.3 1.5a4.8 4.8 0 0 0-.1 3.6 5.2 5.2 0 0 0-1.4 3.6c0 5.2 3.2 6.4 6.2 6.7a3.4 3.4 0 0 0-.9 2.7V22"></path>
            @break
        @case('whatsapp')
            <path d="M20.5 11.5a8.5 8.5 0 0 1-12.6 7.4L3 20l1.2-4.7a8.5 8.5 0 1 1 16.3-3.8Z"></path>
            <path d="M8.5 8.2c.2-.5.5-.5.8-.5h.5c.2 0 .4.1.5.4l.8 1.8c.1.2.1.4 0 .6l-.6.8c-.2.2-.2.4 0 .6.6 1 1.4 1.7 2.4 2.2.2.1.4.1.6-.1l.8-1c.2-.2.4-.2.6-.1l1.7.8c.3.1.4.3.4.5 0 .3-.2 1.4-.9 1.9-.6.5-1.3.7-2.2.5-1-.2-2.3-.8-3.8-2.1-1.8-1.6-2.8-3.6-2.9-4.7-.1-.8.5-1.4.8-1.6Z"></path>
            @break
        @case('facebook')
            <path d="M14 21v-8h2.7l.4-3H14V8.1c0-.9.3-1.5 1.6-1.5h1.7V3.9c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V10H8v3h2.6v8Z"></path>
            @break
        @case('youtube')
            <rect x="3" y="5" width="18" height="14" rx="4"></rect>
            <path d="m10 9 5 3-5 3z"></path>
            @break
        @default
            <path d="M14 3h7v7m-1-6L10 14"></path>
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
    @endswitch
</svg>
