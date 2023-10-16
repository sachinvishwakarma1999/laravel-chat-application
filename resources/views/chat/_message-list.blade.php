<div class="py-2 px-4 border-bottom d-none d-lg-block">
    <div class="d-flex align-items-center py-1">
        <div class="position-relative">
            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman"
                width="40" height="40">
        </div>
        <div class="flex-grow-1 pl-3">
            <strong>{{ $userDetails[0]->name }}</strong>
            <div class="text-muted small"><em>Typing...</em></div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                    </path>
                </svg></button>
            <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-video feather-lg">
                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2">
                    </rect>
                </svg></button>
            <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                </svg></button>
        </div>
    </div>
</div>

<div class="position-relative">
    @if (!empty($getChatHistory) && count($getChatHistory) > 0)
        <div class="chat-messages p-4" id="user-list">
            @foreach ($getChatHistory as $message)
                @if ($message->from_id == auth()->user()->id)
                    <div class="chat-message-right pb-4">
                        <div>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1"
                                alt="Chris Wood" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                            <div class="font-weight-bold mb-1">You</div>
                            {{ $message->message }}
                        </div>
                    </div>
                @else
                    <div class="chat-message-left pb-4">
                        <div>
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1"
                                alt="Sharon Lessman" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                            <div class="font-weight-bold mb-1">{{$message->fromUser->name}}</div>
                            {{ $message->message }}
                        </div>
                    </div>
                @endif
            @endforeach
            
        </div>
        
    @else
    <div class="chat-messages p-4" id="no-conversion">
       
                     No Conversession found
        
    </div>
    @endif
</div>
<div class="flex-grow-0 py-3 px-4 border-top">
    <form class="input-group" action="javascript:void(0)" id="chating-form" method="POST"
        onsubmit="sendMessage('message')" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="from_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="to_id" value="{{ $userDetails[0]->id}}">
        <input type="hidden" name="chat_type" value="text-chat">
        <input type="text" class="form-control" name="message" id="message-input" placeholder="Type a message">

        <button class="btn btn-primary">Send</button>
    </form>
</div>
