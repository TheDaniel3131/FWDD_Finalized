<?php 
error_log("Session ID: " . session_id());
error_log("Session Username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set'));

include "nav_afterlogin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Math Kids System</title>
  <link rel="stylesheet" href="exerciseStyle.css">
</head>
<body>
  <div class="container">
    <h1>MathKids</h1>
    <h2>Year 5 Addition</h2>
    <div id="quiz">
      <!-- Each question page will be displayed here -->
    </div>
    <div id="result"></div>
    <button id="startButton">Start Quiz</button>
    <div class="timer" id="timer" style="visibility: hidden">
        <div class ="progress">
          <div class ="progress-bar"></div>
          
          <span class="progress-text" id ="time"></span>
        </div>
      </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const quizContainer = document.getElementById('quiz');
      const resultContainer = document.getElementById('result');
      const startButton = document.getElementById('startButton');
      const progressBar = document.querySelector('.progress-bar');
      const progressText = document.querySelector('.progress-text');
      const quizTimer = document.querySelector('.timer');

      

      const progress = (value) => {
        const percentage = (value / time) * 100;
        progressBar.style.width = `${percentage}%`;
        
      };

      let currentQuestionIndex = 0;
      let score = 0;
      let questions = [];
      let time = 10;
      let timer = time;

      startButton.addEventListener('click', startQuiz);

      function loadQuestion() {
        if (currentQuestionIndex < questions.length) {
          const quizTimer = document.querySelector('.timer');
          const questionObj = questions[currentQuestionIndex];
          const questionDiv = document.createElement('div');
          questionDiv.classList.add('question');
          questionDiv.innerHTML = `
            <h3>Question ${currentQuestionIndex + 1}:</h3>
            <p>${questionObj.question_text}</p>
            <label><input type="radio" name="answer" value="A"> ${questionObj.option_a}</label><br>
            <label><input type="radio" name="answer" value="B"> ${questionObj.option_b}</label><br>
            <label><input type="radio" name="answer" value="C"> ${questionObj.option_c}</label><br>
            <label><input type="radio" name="answer" value="D"> ${questionObj.option_d}</label><br>
            <button id="nextButton">Next Question</button>
            <div class="question-timer"></div>
          `;

          quizContainer.innerHTML = '';
          quizContainer.appendChild(questionDiv);
        

          const nextButton = document.getElementById('nextButton');
          nextButton.addEventListener('click', handleNext);
        
          startTimer(time);
        } else {
          showResult();
        }
      }

      function startQuiz() {
        startButton.style.display = 'none';
        quizTimer.style.visibility = 'visible';
        loadQuestion();
      }

      function handleNext() {
  const selectedAnswer = document.querySelector('input[name="answer"]:checked');

  if (selectedAnswer) {
    if (selectedAnswer.value === questions[currentQuestionIndex].correct_answer) {
      score++;
    }
  }

  currentQuestionIndex++;
  if (currentQuestionIndex < questions.length) {
    clearInterval(timer); // Clear the timer interval
    loadQuestion();
  } else {
    showResult();
  }
}

function startTimer(time) {
    const questionTimer = document.querySelector('.question-timer');
    let count = time; // Use count instead of overwriting the 'time' variable

    questionTimer.textContent = `Time left: ${count}s`; // Initial display

    timer = setInterval(() => {
      count--;

      if (count >= 0) {
        questionTimer.textContent = `Time left: ${count}s`;
        progress(time - count); // Update progress bar
      } else if(currentQuestionIndex == questions.length){
        clearInterval(timer);
        
      } else {
        clearInterval(timer);
        handleNext(); // Move to the next question automatically when time is up
      }
    }, 1000);
  }

      function showResult() {
        quizTimer.style.visibility = 'hidden';
        const percentageScore = ((score / questions.length) * 100).toFixed(2);
        const resultText = `You scored ${score} out of ${questions.length}. ${percentageScore}%`;

        resultContainer.textContent = resultText;
        quizContainer.innerHTML = '';
        saveScore();
      }

      function saveScore() {
    // Get lessonID from the URL header or set it dynamically based on the lesson selected
    const lessonID = 1; // Replace this with the appropriate method to get lessonID

    const percentageScore = ((score / questions.length) * 100).toFixed(2);
    fetch('fetch_userID.php')
        .then(response => response.json())
        .then(data => {
            const userID = data.userID;

            // Pass userID along with other data to save_score.php
            fetch('save_score.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    percentageScore: percentageScore,
                    lessonID: lessonID,
                    userID: userID
                })
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Output response from PHP file
            })
            .catch(error => console.error('Error:', error));
        })
        .catch(error => console.error('Error:', error));
}


      fetch('fetch_questions.php') // Change the file path according to your setup
        .then(response => response.json())
        .then(data => {
          questions = data;
        })
        .catch(error => console.error('Error:', error));
    });
  </script>
</body>
</html>