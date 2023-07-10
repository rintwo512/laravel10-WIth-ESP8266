<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My App</title>

    <style>
        html {
            overflow: hidden;
            font-family: 'Nunito', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('public/assets/images/welcome.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;

        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna hitam dengan nilai alfa 0.5 */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 600px;
            height: 400px;
            border-radius: 5px;

        }

        .title {
            order: -1;
            color: white;
            text-align: center;
            font-size: 20px;
            padding:30px;
            transition: opacity 0.5s ease;
        }


.btn{

  display: flex;
  align-items: center;
  justify-content: center;
}

        .button {
  min-width: 200px;
  min-height: 50px;
  font-family: 'Nunito', sans-serif;
  font-size: 22px;
  text-transform: uppercase;
  letter-spacing: 1.3px;
  font-weight: 700;
  color: #f1f1f7;
  background: #4FD1C5;
background: linear-gradient(90deg, rgba(129,230,217,1) 0%, rgba(79,209,197,1) 100%);
  border: none;
  border-radius: 1000px;
  box-shadow: 12px 12px 24px rgba(79,209,197,.64);
  transition: all 0.3s ease-in-out 0s;
  cursor: pointer;
  outline: none;
  position: relative;
  padding: 10px;
  }

button::before {
content: '';
  border-radius: 1000px;
  min-width: calc(200px + 12px);
  min-height: calc(50px + 12px);
  border: 6px solid #00FFCB;
  box-shadow: 0 0 60px rgba(0,255,203,.64);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: all .3s ease-in-out 0s;
}

.button:hover, .button:focus {
  color: #ffffff;
  transform: translateY(-6px);
}

button:hover::before, button:focus::before {
  opacity: 1;
}

button::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #00FFCB;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
}

button:hover::after, button:focus::after {
  animation: none;
  display: none;
}

@keyframes ring {
  0% {
    width: 30px;
    height: 30px;
    opacity: 1;
  }
  100% {
    width: 300px;
    height: 300px;
    opacity: 0;
  }
}
    </style>


</head>

<body>

    <div class="container">
        <span class="title" id="typing" data-title='["Sesuatu yang belum dikerjakan seringkali tampak mustahil dan kita akan yakin jika kita telah melakukannya dengan baik.","Kerjakan segala sesuatu dengan baik, maka dengan sendirinya segala sesuatu yang baik pun akan mengikutinya.","Seseorang yang lahir dalam kemiskinan itu bukanlah kesalahannya. Namun, bila kita mati dalam kemiskinan, maka itu kesalahannya. Oleh karenanya kerja keras dan berusahalah.","Tidak akan ada keberhasilan hingga Anda mengerjakannya.", "Ada empat hal untuk sukses: bekerja, berdoa, berpikir, dan percaya.", "Sulit untuk mengalahkan orang yang tidak pernah akan menyerah.", "Cara untuk memulai adalah dengan cara berhenti bicara dan mulai melakukannya.","Tidak ada pekerjaan yang rendah, yang ada hanyalah sikap yang rendah.", "Konsentrasilah pada pekerjaan Anda dan Anda pun dapat melupakan masalah Anda yang lainnya."]'></span>
        <div class="btn">
            <form action="{{ url('/auth') }}">

                <button class="button">Sign In</button>
            </form>
        </div>
    </div>


    <script>
        // JavaScript untuk efek bergantian pada elemen span
        const typingElement = document.getElementById("typing");
        const titles = JSON.parse(typingElement.getAttribute("data-title"));
        // Memberikan padding pada setiap judul dalam array titles
    const paddedTitles = titles.map(title => title.padStart(title.length + 50));
        let index = 0;

        function changeText() {
            typingElement.style.opacity = 0;

            setTimeout(() => {
                typingElement.textContent = paddedTitles[index];
                typingElement.style.opacity = 1;
            }, 500);

            index++;
            if (index >= paddedTitles.length) {
                index = 0;
            }
        }

        // Memulai efek bergantian setelah judul pertama kali muncul
        function startTyping() {
            // Menampilkan judul pertama kali
            typingElement.textContent = paddedTitles[0];
            typingElement.style.opacity = 1;

            // Mengatur jeda waktu sebelum memulai efek bergantian
            setTimeout(() => {
                // Memulai efek bergantian setiap 2 detik
                setInterval(changeText, 4000);
            }, 4000);
        }

        // Memulai efek setelah halaman dimuat
        window.addEventListener("load", startTyping);
    </script>

</body>

</html>
