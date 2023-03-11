<?php include 'partials/header.php';

if (isset($_GET['id'])) {
  // fetch the user from the database
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);
} else {
  // redirect to manage users page if the id is not set
  header('location: ' . ROOT_URL . 'admin/manage-users.php');
  die();
}
?>
<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Edit User</h2>
    <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
      <input type="hidden" value="<?= $user['id'] ?>" name="id">
      <input type="text" name="firstname" value="<?= $user['firstname'] ?>" placeholder="First Name" />
      <input type="text" name="lastname" value="<?= $user['lastname'] ?>" placeholder="Last Name" />
      <label for="">User Role</label>
      <select name="userrole">
        <option value="0">Admin</option>
        <option value="1">Author</option>
      </select>
      <button type="submit" name="submit" class="btn">Update User</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>