// JavaScript to dynamically update the progress
const progressText = document.querySelector('.progress-text');
let progressValue = 0;
const interval = setInterval(() => {
  if (progressValue >= 95) { // Set your target progress value here
    clearInterval(interval);
  } else {
    progressValue++;
    progressText.textContent = `${progressValue}%`;
    document.querySelector('.progress-circle').style.background = `conic-gradient(
      #4d5bf9 0%,
      #4d5bf9 ${progressValue}%, 
      #cadcff ${progressValue}%,
      #cadcff 100%
    )`;
  }
}, 100);
