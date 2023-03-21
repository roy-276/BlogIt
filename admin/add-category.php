<?php include 'partials/header.php';

// get the form data from the session if invalid form data was submitted
$text = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;
?>

<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Add Category</h2>
    <?php if (isset($_SESSION['add-category'])) : ?>
      <div class="alert_message error">
        <p>
          <?= $_SESSION['add-category'];
          unset($_SESSION['add-category']); ?> </p>
      </div>
    <?php endif; ?>
    <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
      <input type="text" value="<?= $title ?>" name="title" placeholder="Title" />
      <textarea row="4" name="description" placeholder="Description"><?= $category['description'] ?></textarea>
      <button type="submit" name="submit" class="btn">Add Category</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>