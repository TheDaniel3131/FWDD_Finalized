<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MathKids Discussion</title>
    <!-- Import jQuery -->
    <script
      src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    <!-- Import CSS -->
    <link rel="stylesheet" href="discussion.css" />
  </head>
  <body>
    <iframe 
      src="nav.html"
      frameborder="0"
      scrolling="no"
      style="height: 100px; width: 100%; top: 0; left: 0; margin-bottom: -7.5px"
    ></iframe>
    <!-- Add a header -->
    <header>MathKids Discussion</header>

    <!-- Add a container for the discussion -->
    <div id="discussion-container"></div>

    <!-- Add a form for users to submit comments -->
    <form id="comment-form">
      <label for="comment-input">Add your comment:</label>
      <textarea id="comment-input"></textarea>
      <button type="submit">Submit</button>
    </form>

    <!-- Import JavaScript -->
    <script src="./script.js"></script>
  </body>
</html>
