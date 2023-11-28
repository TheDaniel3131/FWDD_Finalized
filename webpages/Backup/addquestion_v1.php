<?php include 'nav.html';?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <!-- Import CSS -->
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Rubik&display=swap");
      @import url("https://fonts.googleapis.com/css2?family=Work+Sans:wght@600;900&display=swap");

      *,
      *::before,
      *::after {
          font-family: Poppins, sans-serif;
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      html {
          font-size: 16px;
          min-height: 100%;
      }

      body {
          margin: 0;
          padding: 0;
          background-color: #f0f0f0;
          background-image: url("images/bg_d.jpg");
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
          background-attachment: fixed;
          font-family: Poppins, sans-serif;
      }

      header {
          font-weight: 900;
          background-color: #333;
          color: white;
          padding: 10px;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      
      .header h2 {
          font-weight: bold;
          font-size: 25px; /* Adjust the size as needed */
          letter-spacing: 3px;
      }

      h2 {
          font-weight: 750;
      }


      form {
          display: flex;
          flex-direction: column;
          align-items: center;
          background-color: #f7f7f7;
          border-radius: 0.25rem;
          padding: 2rem;
          box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
          transition-duration: 0.3s;
          max-width: 750px;
          margin: 0 auto;
          margin-top: 50px;
      }

      form:hover {
          transform: translateY(-5px);
          box-shadow: rgba(0, 0, 0, 0.2) 0px 10px 20px -10px;
      }

      label {
          font-family: "Work Sans", sans-serif;
          font-size: 25px;
          font-weight: 550;
          margin-bottom: 0.5rem;
      }

      input[type="text"] {
          width: 100%;
          padding: 0.5rem 0.75rem;
          border-radius: 0.25rem;
          border-color: #ced4da;
          margin-bottom: 1rem; /* Add some spacing between input fields */
      }

      input[type="submit"] {
          font-family: "Work Sans", sans-serif;
          font-size: 20px; /* Increase font size for better visibility on small screens */
          font-weight: 500;
          background-color: #007bff;
          color: #fff;
          border-radius: 0.25rem;
          padding: 0.5rem 1rem; /* Increase padding for better touch targets */
          border: none;
          transition-duration: 0.3s;
      }

      input[type="submit"]:hover {
          background-color: #0069d9;
          color: #fff;
          border-radius: 0.25rem;
          padding: 0.5rem 1rem; /* Increase padding on hover for better touch targets */
          border: none;
          transform: translateY(-2px);
          box-shadow: rgba(0, 0, 0, 0.2) 0px 15px 30px -10px;
          cursor: pointer;
      }

      @media (max-width: 768px) {
          form {
              padding: 1rem;
          }

          label {
              font-size: 20px;
          }

          input[type="text"] {
              padding: 0.5rem;
          }

          input[type="submit"] {
              font-size: 18px;
              padding: 0.5rem 1rem;
          }

          /* Further adjustments for smaller screens */
          header {
              flex-direction: column;
          }

          header h2 {
              font-size: 20px;
          }
      }

    </style>
    <title>Add Question | MathKids</title>
  </head>
  <body>
    <header class="header">
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    </header>
    <form method="post" action="qf_process.php">
    <label for="question_text">LESSON QUESTION</label><br/>
    <input type="text" id="question_text" name="question_text" /><br /><br />

    <label for="option_a">Option A</label><br/>
    <input type="text" id="option_a" name="option_a" /><br /><br />

    <label for="option_b">Option B</label><br/>
    <input type="text" id="option_b" name="option_b" /><br /><br />

    <label for="option_c">Option C</label><br/>
    <input type="text" id="option_c" name="option_c" /><br /><br />

    <label for="option_d">Option D</label><br/>
    <input type="text" id="option_d" name="option_d" /><br /><br />

    <label for="correct_answer">Correct Answer</label><br/>
    <select id="correct_answer" name="correct_answer">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br /><br />

    <input type="submit" value="Submit" />
    </form>
  </body>
</html>
