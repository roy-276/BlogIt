<?php include 'partials/header.php';

// fetch all the categories from the database
$query = "SELECT * FROM categories";
$result = mysqli_query($connection, $query);
?>

<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Add Post</h2>
    <div class="alert_message error">
      <p>This is error message</p>
    </div>
    <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
      <input type="text" name="title" placeholder="Title" />
      <select name="category">
        <?php
        // loop through all the categories and show them in the select box
        while ($category = mysqli_fetch_assoc($categories)) : ?>
          <option value="<?= $category['id'] ?>"><? $category['title'] ?></option>
        <?php endwhile; ?>
      </select>
      <textarea row="10" name="body" placeholder="Body"></textarea>

      <?php
      // if the user is an admin, show the featured checkbox
      if (isset($_SESSION['user_is_admin'])) : ?>
        <div class="form_control inline">
          <input type="checkbox" name="is_featured" value="1" id="is_featured" checked />
          <label for="is_featured">Featured</label>
        </div>
      <?php endif; ?>
      <div class="form_control">
        <label for="thumbnail">Add Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail" />
      </div>
      <button type="submit" name="submit" class="btn">Add Post</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>