<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
  <div class="mt-6 border-t border-gray-100">
  <?php foreach($subjects as $index => $subject): ?>
    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 <?= $index % 2 === 0 ? 'bg-gray-400' : 'bg-gray-100' ?> text-center">
      <dt class="text-base font-medium leading-6 text-gray-900">Name</dt>
      <dd class="mt-1 text-base leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= $subject['subject_name'] ?></dd>
    </div>
    <div class="text-base text-center px-4 py-6 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-0 <?= $index % 2 === 0 ? 'bg-gray-100' : 'bg-gray-200' ?>">
      <a href="/edit_subject?id=<?= $subject['id'] ?>" class="px-3 py-1 bg-blue-500 text-white rounded text-sm mr-2">Edit</a>
    </div>
  <?php endforeach ?>
</div>

</main>

<?php require base_path('views/partials/footer.php') ?>