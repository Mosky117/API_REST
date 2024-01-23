<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <form method="POST" action="/courses">

        <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new course</h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="course_name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input type="text" name="course_name" id="course_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['course_name'] ?? '' ?></input>
                    <?php if (isset($errors['course_name'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['course_name'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="places" class="block text-sm font-medium leading-6 text-gray-900">Places</label>
                <div class="mt-2">
                    <input type="text" name="places" id="places" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['places'] ?? '' ?></input>
                    <?php if (isset($errors['places'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['places'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="sm:col-span-4">
                <label for="subjects" class="block text-sm font-medium leading-6 text-gray-900">Subjects</label>
                <label for="subjects" class="block text-sm font-medium leading-6 text-gray-900">Long Press CTRL and click with mouse</label>
                <div class="mt-2">
                    <select id="subjects" name="subjects[]" multiple size="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php 
                            foreach ($subjects as $subject) {
                                echo "<option value='" . $subject['id'] . "'>" . $subject['subject_name'] . "</option>";
                            }
                        ?>
                    </select>
                    <!-- <input id="subjects" name="subjects" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['subjects'] ?? '' ?></input> -->
                    <?php if (isset($errors['subjects'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['subjects'] ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="px-4 py-3 text-right sm:px-6">
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save
                </button>
            </div>
        </div>
        </div>  
    </form>
</main>

<?php require base_path('views/partials/footer.php') ?>