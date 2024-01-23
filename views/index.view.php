<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>
<main>

<div class="text-center p-4">
  <h2 class="text-2xl font-bold mb-4">Welcome, use the button below or the nav bar to navigate:</h2>
  <a href="/courses" class="w-1/3 mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 block">See the Courses available</a>
  <a href="/subjects" class="w-1/3 mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">See the Subjects you will study</a>
  </br>
  <h2 class="text-2xl font-bold mb-4">Or create a new course/subject using the button below:</h2>
  <a href="/courses/new_course" class="w-1/3 mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 block">New course</a>
  <a href="/subjects/new_subject" class="w-1/3 mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">New subject</a>
</div>

</main>

<?php require('partials/footer.php') ?>