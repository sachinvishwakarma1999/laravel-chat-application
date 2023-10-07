@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container p-0">

            <h1 class="h3 mb-3">Messages</h1>

            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-5 col-xl-3 border-right" >

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
                       

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type your message">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>

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


    function getChattingMessageList(userId){
        $('.list-group-item-action').removeClass('active');
        $('.user-list-'+userId).addClass('active');
        $.ajax({
            type: "GET",
            url: '{{ url("/get-chatting-message-list") }}/'+userId,
            data: {},
            success: function (result) {
                $('#message-list').html('');
                if(result.success){
                    $('#message-list').html(result.html);
                }else{
                    $('#message-list').html('<div class="alert alert-danger text-center">Sorry! We could not find any thread</div>');
                }
            }
        });
    }
</script>
@endpush