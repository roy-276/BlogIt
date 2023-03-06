<?php include 'partials/header.php'; ?>

<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Add Category</h2>
    <div class="alert_message error">
      <p>This is error message</p>
    </div>
    <form action="">
      <input type="text" placeholder="Title" />
      <textarea row="4" placeholder="Description"></textarea>
      <button type="submit" class="btn">Add Category</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>