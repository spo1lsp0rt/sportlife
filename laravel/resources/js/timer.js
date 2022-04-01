const FULL_DASH_ARRAY = 283;
const TIME_LIMIT = 20;
const WARNING_THRESHOLD = TIME_LIMIT / 2;
const ALERT_THRESHOLD = TIME_LIMIT / 4;

const COLOR_CODES = {
    info: {
        color: "green",
        threshold: TIME_LIMIT
    },
    warning: {
        color: "orange",
        threshold: WARNING_THRESHOLD
    },
    alert: {
        color: "red",
        threshold: ALERT_THRESHOLD
    }
};

let timePassed;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

let timers = document.getElementsByClassName("timer");
for(let timer of timers){
    timer.innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining${timer.id.slice(5)}"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label${timer.id.slice(5)}" class="base-timer__label">${formatTime(
        timeLeft
    )}</span>
</div>
`;
}



function onTimesUp() {
    clearInterval(timerInterval);
}

for(let timer of timers){
    console.log(timer.id.slice(5));
    const btnID = "timer_btn" + timer.id.slice(5);
    let btn = document.getElementById(btnID);
    btn.addEventListener("click", () => {startTimer(); })
}

function startTimer() {
    const fullID = document.activeElement.id.slice(9);
    onTimesUp();
    timePassed = 0;
    timeLeft = TIME_LIMIT;
    timerInterval = null;
    timerInterval = setInterval(() => {
        timePassed += 1;
        timeLeft = TIME_LIMIT - timePassed;
        document.getElementById("base-timer-label" + fullID).innerHTML = formatTime(
            timeLeft
        );
        setCircleDasharray(fullID);
        setRemainingPathColor(timeLeft, fullID);

        if (timeLeft === 0) {
            onTimesUp();
        }
    }, 1000);
}

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;

    if (seconds < 10) {
        seconds = `0${seconds}`;
    }

    return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft, id) {
    const { alert, warning, info } = COLOR_CODES;
    if (timeLeft <= alert.threshold) {
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.remove(warning.color);
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.add(alert.color);
    } else if (timeLeft <= warning.threshold) {
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.remove(info.color);
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.add(warning.color);
    } else if (timeLeft <= info.threshold) {
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.remove(alert.color);
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.remove(warning.color);
        document
            .getElementById("base-timer-path-remaining" + id)
            .classList.add(info.color);
    }
}

function calculateTimeFraction() {
    const rawTimeFraction = timeLeft / TIME_LIMIT;
    return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray(id) {
    const circleDasharray = `${(
        calculateTimeFraction() * FULL_DASH_ARRAY
    ).toFixed(0)} 283`;
    document
        .getElementById("base-timer-path-remaining" + id)
        .setAttribute("stroke-dasharray", circleDasharray);
}
