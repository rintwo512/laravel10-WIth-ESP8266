@extends('layout.main')



@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">



    <div class="page">
        <div class="marvel-device nexus5">
          <div class="top-bar"></div>
          <div class="sleep"></div>
          <div class="volume"></div>
          <div class="camera"></div>
          <div class="screen">
            <div class="screen-container">
              <div class="status-bar">
                <div class="time">{{ date('H:i', strtotime('-1 hour')) }}</div>
                <div class="battery">
                  <i class="bi bi-battery"></i>
                </div>
                <div class="network">
                  <i class="bi bi-reception-4"></i>
                </div>
                <div class="wifi">
                  <i class="bi bi-wifi-2"></i>
                </div>
                <div class="star">
                  <i class="bi bi-star-fill"></i>
                </div>
              </div>
              <div class="chat">
                <div class="chat-container">
                  <div class="user-bar">
                    <div class="back">
                      <i class="bi bi-arrow-left-short"></i>
                    </div>
                    <div class="avatar">
                      <img src="{{ asset('assets/images/bot.jpg') }}" alt="Avatar">
                    </div>
                    <div class="name">
                      <span>AI</span>
                      <span class="status">online</span>
                    </div>
                    <div class="actions more">
                      <i class="bi bi-three-dots-vertical"></i>
                    </div>
                    <div class="actions attachment">
                      <i class="bi bi-paperclip"></i>
                    </div>
                    <div class="actions">
                      <i class="bi bi-telephone-fill"></i>
                    </div>
                  </div>
                  <div class="conversation">
                    <div class="conversation-container" id="content-box">

                        <div class="message received"><span>
                            Hai saya adalah AI, Nama saya Bagong, jika ingin bertanya silahkan!</span>
                            <span class="metadata"><span class="time"></span></span>
                          </div>



                    </div>
                    <div class="conversation-compose" style="margin-bottom: 10px">
                      <div class="emoji" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489"/></svg>
                      </div>
                      <input class="input-msg" name="input" id="input" placeholder="Type a message" autocomplete="off" autofocus>
                      <div class="photo">
                        <i class="bi bi-image"></i>
                      </div>
                      <button class="send" id="button-submit">
                          <div class="circle">
                            <i class="bi bi-cursor-fill"></i>
                          </div>
                        </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>






    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>


        var csrfToken = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
})

$("#button-submit").on("click", function(){


    $val = $("#input").val();
    $("#content-box").append(`<div class="message sent">
                        `+$val+`
                        <span class="metadata">
                            <span class="time"></span><span class="tick"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg></span>
                        </span>
                      </div>`);


    $.ajax({
        type: "post",
        url: "{{ url('/chatbot/send') }}",
        data: {
            "input": $val,
            "_token": csrfToken
        },
        success: function(data) {

            $("#content-box").append(`<div class="message received">
                        `+data+`<span class="metadata"><span class="time"></span></span>
                      </div>`);
            $val = $("#input").val('');
        }
    })


});

    </script>




<script>
    // Fungsi untuk membuka panel emoji
    function openEmojiPanel() {
      // Simpan inputan yang aktif saat ini
      var activeInput = document.activeElement;

      // Tambahkan panel emoji ke dalam dokumen
      var emojiPanel = document.createElement('div');
      emojiPanel.id = 'emoji-panel';
      emojiPanel.innerHTML = `
        <span onclick="insertEmoji('')">😀</span>
        <span onclick="insertEmoji('')">❤️</span>
        <span onclick="insertEmoji('')">😁</span>
        <span onclick="insertEmoji('')">😂</span>`
        // Tambahkan emoji lainnya di sini

      // Tempatkan panel emoji di bawah tombol
      var btn = document.getElementById('smiley');
      btn.parentNode.insertBefore(emojiPanel, btn.nextSibling);

      // Fungsi untuk menutup panel emoji
      function closeEmojiPanel() {
        emojiPanel.parentNode.removeChild(emojiPanel);
      }

      // Event listener untuk emoji
      emojiPanel.addEventListener('click', function(event) {
        var emoji = event.target.innerText;
        if (emoji) {
          insertEmoji(emoji);
          if (activeInput) {
            activeInput.focus();
          }
          closeEmojiPanel(); // Tutup panel setelah memilih emoji
        }
      });

      // Event listener untuk dokumen
      document.addEventListener('click', function(event) {
        var target = event.target;
        if (!target.closest('#emoji-panel') && !target.closest('#smiley')) {
          closeEmojiPanel(); // Tutup panel jika mengklik di luar panel dan tombol emoji
        }
      });
    }

    // Fungsi untuk memasukkan emoji ke dalam inputan
    function insertEmoji(emoji) {
      var input = document.getElementById('input');
      input.value += emoji;
    }

    // Event listener untuk tombol
    var button = document.getElementById('smiley');
    button.addEventListener('click', openEmojiPanel);
  </script>



@endsection
