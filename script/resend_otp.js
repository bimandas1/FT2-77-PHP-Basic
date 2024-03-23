// Select countdown line.
let countdownShowingLine = document.querySelector('#countdown-showing-line');
// Select Reset OTP button.
let resetOtpRequestButton = document.querySelector('input[name="resend-otp-request"]');

let countDownTime = 40;

/**
 * Function to update resend otp time and the button.
 */
function updateResendOtpactivationtime () {
  // Update the time.
  countdownShowingLine.textContent = 'Send new OTP after ' + countDownTime + ' seconds';

  countDownTime--;

  // Time is over.
  if (countDownTime < 0) {
    // Stop calling the function in every 1 second.
    clearInterval(intervalId);
    countdownShowingLine.style.display = 'none';
    resetOtpRequestButton.style.pointerEvents = 'auto';
    resetOtpRequestButton.style.opacity = '1';
    // Make the resend OTP button clickable.
    resetOtpRequestButton.style.cursor = 'pointer';
  }
}

// Reload countdown line and timer after every 1 second.
const intervalId = setInterval(updateResendOtpactivationtime, 1000);
