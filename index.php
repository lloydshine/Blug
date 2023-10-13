<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="modal-container">
    <div class="modal edit">
      <header>
        <h1>Edit Post</h1>
        <svg id="close-edit" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z"/></svg>
      </header>
      <form action="editPost.php" method="POST">
        <input type="hidden" name="id" id="id">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
        <button type="submit">Save</button>
      </form>
    </div>
    <div class="modal create">
      <header>
        <h1>Create Post</h1>
        <svg id="close-create" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z"/></svg>
      </header>
      <form action="createPost.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
        <button type="submit">Post</button>
      </form>
    </div>
  </div>

  <div class="side-nav" id="side-nav">
    <div class="nav-logo">
      <h1>blug.com</h1>
    </div>
    <?php
    // In index.php
    session_start(); // Start the session

    // Check if a custom error message exists
    if (isset($_SESSION['log'])) {
      $logMessage = $_SESSION['log'][1];
      $logType = $_SESSION['log'][0];
      echo "<p class='log {$logType}'>" . $logMessage . '</p>';
      // Clear the custom error message from the session
      unset($_SESSION['log']);
    }

    ?>
    <div class='register' style='display: none;'>
      <form action='register.php' method='POST'>
        <label for='username'>Username:</label>
        <input type='text' name='username' id='username'>
        <label for='password'>Password:</label>
        <input type='text' name='password' id='password'>
        <label for='retype-password'>Retype Password:</label>
        <input type='text' name='retype-password' id='retype-password'>
        <button type='submit'>Register</button>
        <div>
          <p class='link'>Already have an account? <a id='auth-link' style='cursor:pointer;'>Login</a></p>
        </div>
      </form>
    </div>
    <?php
    require "getPosts.php";

    if (!isset($_SESSION['username'])) {
      echo "
      <div class='login'>
        <form action='login.php' method='POST'>
          <label for='username'>Username:</label>
          <input type='text' name='username' id='username'>
          <label for='password'>Password:</label>
          <input type='password' name='password' id='password'>
          <button type='submit'>Login</button>
          <div>
            <p class='link'>Don't have an account? <a id='auth-link' style='cursor:pointer;'>Register</a></p>
          </div>
        </form>
      </div>
      ";
    } else {
      echo "
      <div style='display:flex;flex-direction:column;align-items:center;gap: 1rem;'>
      <p class='welcome'>Welcome, {$_SESSION['username']}</p>
      <button id='create-post'>Create Post</button>
      </div>
      <button id='logout-button'>Logout</button>
      ";
    }
    ?>
  </div>
  <main>
    <header>
      <div class="header-container">
        <svg id="nav-button" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z"/></svg>
        <h1>Blug</h1>
      </div>
      <?php
      if (isset($_SESSION['username'])) {
        echo "
        <div class='header-container'>
          <p>Logged in as <span style='color: green;'>{$_SESSION['username']}</span></p>
        </div>
        ";
      }
      ?>
    </header>
    <section class="main">
      <?php
      foreach ($result as $row) {
        if (isset($_SESSION['username'])) {
        echo $row["username"] != $_SESSION["username"] ? "" : "
        <div>
          <a id='edit-post' postid='{$row['id']}' title='{$row['title']}' body='{$row['post']}'>Edit</a>
          <a href='deletePost.php?id={$row['id']}'>Delete</a>
        </div>
        ";
        }
        echo "
        <div class='content'>
          <div class='post'>
              <p class='info'>By {$row["username"]} {$row["date_posted"]}</p>
            <h3>{$row["title"]}</h3>
            <p class='text'>{$row["post"]}</p>
          </div>
        </div>";
      }
      ?>
    </section>
  </main>
  <script src="script.js"></script>
</body>
</html>