<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino Edur Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b1b1b;
            color: white;
            font-family: 'Arial', sans-serif;
        }
        .board {
            width: 600px;
            height: 600px;
            background: linear-gradient(45deg, #28a745, #1e7e34);
            position: relative;
            border-radius: 30px;
            margin: 50px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.3);
            border: 5px solid gold;
        }
        .pocket {
            width: 70px;
            height: 70px;
            background: radial-gradient(circle, black, #333);
            border-radius: 50%;
            position: absolute;
            box-shadow: inset 0px 0px 10px rgba(255, 255, 255, 0.2);
        }
        .pocket.top-left { top: 15px; left: 15px; }
        .pocket.top-right { top: 15px; right: 15px; }
        .pocket.bottom-left { bottom: 15px; left: 15px; }
        .pocket.bottom-right { bottom: 15px; right: 15px; }
        .edur {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: url('images/games/mouse.png') no-repeat center;
            background-size: cover;
            position: absolute;
            transition: all 2s ease-in-out;
        }
        h2 {
            text-align: center;
            font-size: 2.5rem;
            text-transform: uppercase;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.5);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const edur = document.querySelector(".edur");
            const pockets = document.querySelectorAll(".pocket");
            
            function moveEdur() {
                let randomPocket = pockets[Math.floor(Math.random() * pockets.length)];
                let pocketRect = randomPocket.getBoundingClientRect();
                let boardRect = document.querySelector(".board").getBoundingClientRect();
                
                edur.style.left = (pocketRect.left - boardRect.left + 10) + "px";
                edur.style.top = (pocketRect.top - boardRect.top + 10) + "px";
                
                setTimeout(() => {
                    alert("Pocket Winner: " + randomPocket.classList[1]);
                }, 2000);
            }
            
            setInterval(moveEdur, 10000);
        });
    </script>
</head>
<body>
    <div class="container text-center">

        <div class="board">
            <div class="pocket top-left"></div>
            <div class="pocket top-right"></div>
            <div class="pocket bottom-left"></div>
            <div class="pocket bottom-right"></div>
            <div class="edur"></div>
        </div>
    </div>
</body>
</html>