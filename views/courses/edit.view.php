<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form method="POST" action="/course_editing">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= $course['id'] ?>">

                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                            <div>
                                <label
                                    for="course_name"
                                    class="block text-sm font-medium text-gray-700"
                                >course</label>

                                <div class="mt-1">
                                    <textarea
                                        id="course_name"
                                        name="course_name"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Here's an idea for a note..."
                                    ><?= $course['course_name'] ?></textarea>

                                    <?php if (isset($errors['course_name'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['course_name'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-1">
                                    <label class="block text-sm font-medium text-gray-700">Places</label>
                                    <textarea
                                        id="places"
                                        name="places"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="Here's an idea for a note..."
                                    ><?= $course['places'] ?></textarea>

                                    <?php if (isset($errors['places'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['places'] ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-1">
                                    <label class="block text-sm font-medium text-gray-700">Long Press CTRL and click with mouse</label>
                                    <select id="subjects" name="subjects[]" multiple size="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <?php 
                                            foreach ($allSubjects as $subject) {
                                                $selected = (in_array($subject['id'], $subjects)) ? 'selected' : '';
                                                echo "<option value='" . $subject['id'] . "' $selected>" . $subject['subject_name'] . "</option>";
                                            }
                                        ?>
                                    </select>

                                    <?php if (isset($errors['subjects'])) : ?>
                                        <p class="text-red-500 text-xs mt-2"><?= $errors['subjects'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                            <button type="button" class="text-red-500 mr-auto" onclick="document.querySelector('#delete-form').submit()">Delete</button>
                            <a
                                href="/courses"
                                class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Update
                            </button>
                        </div>
                    </div>
                </form>

                <form id="delete-form" class="hidden" method="POST" action="/courses">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $course['id'] ?>">
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?> 