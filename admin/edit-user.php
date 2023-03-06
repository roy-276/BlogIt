<?php include 'partials/header.php'; ?>

<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Edit User</h2>
    <form action="" enctype="multipart/form-data">
      <input type="text" placeholder="First Name" />
      <input type="text" placeholder="Last Name" />
      <label for="">User Role</label>
      <select>
        <option value="0">Admin</option>
        <option value="1">Author</option>
      </select>
      <button type="submit" class="btn">Update User</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>