@extends('layouts.master')

@section('sidebar')
@include('part.sidebar')
@endsection

@section('topbar')
@include('part.topbar')
@endsection

@section('judul')
<h1 class="text-primary">Chat Bot</h1>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    /* Global styling for the chatbot container */
    .wrapper {
        max-width: 500px;
        width: 100%;
        background: #fff;
        margin: 50px auto;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    }

    .title {
        background: #007BFF; /* Warna biru */
        color: white; /* Teks putih */
        padding: 10px 15px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        border-radius: 10px 10px 0 0;
    }

    .form {
        max-height: 500px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
    }

    .inbox {
        display: flex;
        align-items: flex-start;
        margin: 10px 0;
    }

    .bot-inbox {
        justify-content: flex-start;
    }

    .user-inbox {
        justify-content: flex-end;
    }

    .icon {
        background: #007BFF; /* Warna biru */
        border: none;
        color: white; /* Teks putih */
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .icon i {
        color: #fff;
        font-size: 16px;
    }

    .msg-header {
        background: #007BFF; /* Warna biru */
        color: white; /* Teks putih */
        padding: 10px;
        border-radius: 10px;
        max-width: 80%;
        word-wrap: break-word;
    }

    .user-inbox .msg-header {
        background: #0056b3; /* Warna biru yang lebih gelap */
        color: white; /* Teks putih */
    }

    .bot-inbox .msg-header {
        background: #0056b3; /* Warna biru yang lebih gelap */
        color: white; /* Teks putih */
    }

    .typing-field {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-top: 1px solid #eee;
    }

    .input-data {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .input-data input {
        width: 85%;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 0 10px;
        font-size: 16px;
    }

    .input-data button {
        background: #007BFF; /* Warna biru */
        border: none;
        color: white; /* Teks putih */
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .input-data button:hover {
        background: #0056b3; /* Warna biru yang lebih gelap */
    }
</style>


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endpush


@section('content')
<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Chat Bot</h6>
    </div>
    <div class="card-body">
            <div class="title">Simple Online Chatbot</div>
            <div class="form">
                <div class="bot-inbox inbox">
                
                    <div class="msg-header">
                        <p>Hello, I am a chatbot. How can I help you?
                        </p>
                    </div>
                </div>
            </div>
            <div class="typing-field">
                <div class="input-data">
                    <input id="data" type="text" name="replies" placeholder="Type something here.." required>
                    <button id="send-btn">Send</button>
                </div>
            </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#send-btn").on("click", function () {
            $value = $("#data").val();
            $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value +
                '</p></div></div>';
            $(".form").append($msg);
            $("#data").val('');

            // start ajax code
            $.ajax({
                url: '{{ route('bot.post') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'text': $value
                },
                success: function (result) {
                    $reply =
                        '<div class="bot-inbox inbox"><div class="msg-header"><p>' +
                        result.message + '</p></div></div>';
                    console.log(result.message);
                    $(".form").append($reply);
                    // when chat goes down the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }
            });
        });
    });
</script>
<script>
    $('#multiselect').select2({
        allowClear: true
    });
</script>
@endsection
