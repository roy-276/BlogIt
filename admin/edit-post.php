<?php include 'partials/header.php'; ?>

<!-- Form starts here -->
<section class="form_section">
  <div class="container form_section-container">
    <h2>Edit Post</h2>
    <form action="" enctype="multipart/form-data">
      <input type="text" placeholder="Title" />
      <select>
        <option value="">Food</option>
        <option value="">Music</option>
        <option value="">Lifestyle</option>
        <option value="">Politics</option>
        <option value="">Travel</option>
        <option value="">Sports</option>
      </select>
      <textarea row="10" placeholder="Body"></textarea>
      <div class="form_control inline">
        <input type="checkbox" id="is_featured" checked />
        <label for="is_featured">Featured</label>
      </div>
      <div class="form_control">
        <label for="thumbnail">Edit Thumbnail</label>
        <input type="file" id="thumbnail" />
      </div>
      <button type="submit" class="btn">Update Post</button>
    </form>
  </div>
</section>
<!-- Form ends here -->

<?php include '../partials/footer.php'; ?>