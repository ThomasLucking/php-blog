<?php

$error = $error ?? [];


if (isset($error['cover_photo'])) {
    $inputColors = 'border-red-400 bg-red-900/20 text-red-400 placeholder:text-red-300';
} else {
    $inputColors = 'border-[#1e293b] bg-slate-800 text-white placeholder:text-slate-500';
}

?>



<main class="grow flex flex-col m-6 ">
    <form action="/update/<?= $post['id'] ?>" method="POST" enctype="multipart/form-data"
        class="flex flex-col gap-4 w-full">
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-white">Post title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>"
                class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full p-3.5 shadow-sm placeholder:text-slate-500 outline-none transition">
        </div>

        <div class="grow">
            <label for="content" class="block mb-2 text-sm font-medium text-white">Post content</label>
            <textarea id="content" name="content" rows="15" placeholder="Start writing your masterpiece..."
                class="bg-slate-800 border border-[#1e293b] text-white text-sm rounded-md focus:ring-[#60a5fa] focus:border-[#60a5fa] block w-full p-3.5 shadow-sm placeholder:text-slate-500 outline-none transition resize-y"><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="cover_photo" class="block mb-2 text-sm font-medium text-white">Cover photo</label>
            <input type="file" id="cover_photo" name="cover_photo" accept="image/*"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 bg-slate-800 border border-[#1e293b] rounded-md">
        </div>

        <div>
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-white">Category</label>
                <select name="category_id" id="category_id"
                    class="block w-full text-sm text-white bg-slate-800 border border-[#1e293b] rounded-md p-3.5 outline-none focus:ring-[#60a5fa] focus:border-[#60a5fa]">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <div class="space-y-3">
            <label class="block text-sm font-medium text-white text-opacity-90">Post Availability</label>
            <div class="flex flex-col gap-2">
                <div class="flex items-center">
                    <input id="availability-public" type="radio" value="public" name="availability"
                        class="w-4 h-4 text-blue-600 bg-slate-700 border-slate-600 focus:ring-blue-500 focus:ring-offset-slate-800 focus:ring-2">
                    <label for="availability-public" class="ms-2 text-sm font-medium text-slate-300">Public</label>
                </div>
                <div class="flex items-center">
                    <input id="availability-private" type="radio" value="private" name="availability"
                        class="w-4 h-4 text-blue-600 bg-slate-700 border-slate-600 focus:ring-blue-500 focus:ring-offset-slate-800 focus:ring-2">
                    <label for="availability-private" class="ms-2 text-sm font-medium text-slate-300">Private</label>
                </div>
                <div class="flex items-center">
                    <input id="availability-personal" type="radio" value="personal" name="availability"
                        class="w-4 h-4 text-blue-600 bg-slate-700 border-slate-600 focus:ring-blue-500 focus:ring-offset-slate-800 focus:ring-2">
                    <label for="availability-personal" class="ms-2 text-sm font-medium text-slate-300">Personal</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit"
                class="inline-block bg-blue-600 text-white text-sm font-bold rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 px-8 py-3 shadow-md outline-none transition-all active:scale-95">
                Save and Publish
            </button>
        </div>
    </form>
</main>