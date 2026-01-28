<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>


<div
    class=" m-6 flex-col items-center justify-center p-6 border-2 rounded-md border-[#1e293b] bg-[#0f172a] shadow-xl mt-20">
    <div class="flex items-center justify-center">
        <a href="#">
            <img class="rounded-sm mb-4 w-xl" src="/uploads/<?= $post['image'] ?>" alt="Blog Post" />
        </a>
    </div>
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
            <?= $post['title'] ?>
        </h5>
    </a>
    <p class="mb-6 text-slate-400 text-sm leading-relaxed">
        <?= $post['content'] ?>
    </p>
    <div class="flex items-center">
        <a href="/"
            class="inline-flex items-center bg-[#60a5fa] text-white px-5 py-2.5 rounded font-semibold transition hover:bg-blue-500">
            Go back
        </a>
        <a href="/edit/<?= $post['id'] ?>">
            <img class="w-10 h-10 ml-5" src="/assets/Gear.png">
        </a>
    </div>


</div>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>