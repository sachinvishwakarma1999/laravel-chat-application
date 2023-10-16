@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container p-0">

            <h1 class="h3 mb-3">Messages</h1>

            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right">

                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                </div>
                            </div>
                        </div>

                        <div id="user-list"></div>

                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9" id="message-list">
                        <img src="https://surf.dev/wp-content/uploads/2022/05/Frame-474284.png" alt="">

                    </div>
                </div>
               
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            getUserList();
        });

        function getUserList(action) {
            $.ajax({
                type: "GET",
                url: '{{ url('getUsers') }}',
                success: function(result) {
                    $('#user-list').html(result.html);
                }
            });
        }


        function getChattingMessageList(userId) {
            $('.list-group-item-action').removeClass('active');
            $('.user-list-' + userId).addClass('active');
            $.ajax({
                type: "GET",
                url: '{{ url('/get-chatting-message-list') }}/' + userId,
                data: {},
                success: function(result) {
                    $('#message-list').html('');
                    if (result.success) {
                        $('#message-list').html(result.html);
                    } else {
                        $('#message-list').html(
                            '<div class="alert alert-danger text-center">Sorry! We could not find any thread</div>'
                        );
                    }
                }
            });
        }


        function sendMessage(messageType = 'message') {
            $('.chat-messages').scrollTop($(document).height());
            var message = $('#message-input').val();

            if (messageType == 'message') {
                $('.chat-messages').append(
                    `<div class="chat-message-right pb-4">
                    <div>
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                    </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"> 
                            <div class="font-weight-bold mb-1">You</div>
                        ${message}
                        </div>
                    </div>`
                );

                $('.chat-messages').scrollTop($(document).height());
            }

            var form = $('#chating-form');
            var formData = new FormData(form.get(0));
            $.ajax({
                url: "{{ url('send-massage') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                async: 'false',
                success: function(data) {
                    $('#message-input').val('');
                    getUserList('auto_action');
                }
            });
        }
    </script>
@endpush
