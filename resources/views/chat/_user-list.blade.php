@if (count($users) > 0)
@foreach ($users as $user)
    <a href="#" class="list-group-item list-group-item-action border-0 __web-inspector-hide-shortcut__ user-list-{{ $user->id }}" onclick="getChattingMessageList('{{$user->id}}')">
        <div class="badge bg-success float-right">5</div>
        <div class="d-flex align-items-start"> <img src="https://bootdey.com/img/Content/avatar/avatar5.png"
                class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
            <div class="flex-grow-1 ml-3"> {{$user->name}}<div class="small"><span
                        class="fas fa-circle chat-online"></span>
                    Online</div>
            </div>
        </div>
    </a>
@endforeach
@else
    <p>Not User Found</p>
@endif
