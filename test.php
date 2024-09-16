<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Секундомер</title>
</head>
<body>



    <form action="treker/treakerController.php">
        <input name="timer" id="timer">00:00:00</input>
        <button>save</button>
    </form>
    <button id="startBtn">Старт</button>
    <button id="pauseBtn" disabled>Пауза</button>
        <button id="resetBtn" disabled>Сброс</button>

        <script>
    let timer = document.getElementById('timer');
let startBtn = document.getElementById('startBtn');
let pauseBtn = document.getElementById('pauseBtn');
let resetBtn = document.getElementById('resetBtn');

let seconds = 0;
let minutes = 0;
let hours = 0;
let interval;

function updateTime() {
  seconds++;
  if (seconds === 60) {
    minutes++;
    seconds = 0;
  }
  if (minutes === 60) {
    hours++;
    minutes = 0;
  }
  timer.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

startBtn.addEventListener('click', () => {
  interval = setInterval(updateTime, 1000);
  startBtn.disabled = true;
  pauseBtn.disabled = false;
  resetBtn.disabled = false;
});

pauseBtn.addEventListener('click', () => {
    $timer=interval;
  clearInterval(interval);
  startBtn.disabled = false;
  pauseBtn.disabled = true;
});

resetBtn.addEventListener('click', () => {
    $timer=interval;
  clearInterval(interval);
  seconds = 0;
  minutes = 0;
  hours = 0;
  timer.textContent = '00:00:00';
  startBtn.disabled = false;
  pauseBtn.disabled = true;
  resetBtn.disabled = true;
});
  </script>



</body>
</html>

