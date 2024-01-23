<?php include('template1.php');?>

<div id="main-content">
    <a id="go-back-btn" href="read.php"><i class="fas fa-arrow-left"></i> Go Back</a>

    <form>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="role">Role:</label>
      <select id="role" name="role" required>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>

      <label for="comments">Comments:</label>
      <textarea id="comments" name="comments" rows="4"></textarea>

      <button type="submit">Submit</button>
    </form>
  </div>