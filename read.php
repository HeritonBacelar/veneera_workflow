<?php include('template1.php');?> 


<div id="main-content"> 

    <button id="add-user-btn" onclick="window.location.href='create.php'">Add User</button> 

    <!-- Filter Dropdown -->
  <select id="filter-dropdown">
    <option value="name">Filter by Name</option>
    <option value="email">Filter by Email</option>
    <option value="role">Filter by Role</option>
  </select> 
  
    <input type="text" id="search-bar" placeholder="Search...">

    <table id="data-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th class="actions">Actions</th> 
          <th class="actions">A</th>
        </tr>
      </thead>
      <tbody>
      <tr>
          <td>Jane Smith</td>
          <td>jane.smith@example.com</td>
          <td>User</td> 
          <td>User</td>
          <td class="actions"><button class="button button4">Update</button></td>
        </tr>
      <tr>
          <td>Jane Smith</td>
          <td>jane.smith@example.com</td>
          <td>User</td> 
          <td>User</td>
          <td class="actions"><button class="button button4">Update</button></td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>jane.smith@example.com</td>
          <td>User</td> 
          <td>User</td>
          <td class="actions"><button class="button button4">Update</button></td>
        </tr> 
        <tr>
          <td>Jane Smith</td>
          <td>jane.smith@example.com</td>
          <td>User</td> 
          <td>User</td>
          <td class="actions"><button class="button button4">Update</button></td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>
