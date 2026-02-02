<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navbar.php'; ?>


<?php use \Thomas\PhpBlog\Services\Authorization ?>

<?php use \Thomas\PhpBlog\Config\Flash ?>


<main class="grow p-10 flex-col items-start justify-start text-left">
    <?php if ($flash = Flash::getValueAndDelete('notification')):
        $isDanger = ($flash['type'] ?? 'success') === 'danger';
        $bgClass = $isDanger ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';
        ?>
        <div class="px-4 py-3 mb-4 border rounded relative <?= $bgClass ?>" role="alert">
            <strong class="font-bold">
                <?= $isDanger ? 'Whoops!' : 'Success!' ?>
            </strong>
            <span class="block sm:inline"><?= htmlspecialchars($flash['message'] ?? '') ?></span>
        </div>
    <?php endif; ?>
    <div class="flex flex-col gap-y-6 items-start justify-between mr-6">
        <h1 class="text-white text-4xl font-bold">Welcome to the Blog</h1>
        <p class="text-white text-2xs">
            This blog is a demo application as an example for the php blog exercise proposed
            <br>
            in the first year at Jobtrek IT training.
        </p>
        <p class="text-white text-2xs font">
            This blog is built with basic PHP techniques. No Object Oriented Programming or Frameworks. Plain old php,
            some functions and an autoloader. The SQLite database is directly accessed by PDO.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 pb-20">
        <?php foreach ($posts as $post): ?>
            <div class="block max-w-sm p-6 border-2 rounded-md border-[#1e293b] bg-[#0f172a] shadow-xl mt-20">
                <a href="#">
                    <img class="rounded-sm mb-4" src="/uploads/<?= $post['image'] ?>" alt="Blog Post" />
                </a>

                <a href="/post/<?= $post['id'] ?>">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white wrap-anywhere">
                        <?= $post['title'] ?>
                    </h5>
                </a>

                <p class="mb-6 text-slate-400 text-sm leading-relaxed wrap-anywhere">
                    <?= $post['content'] ?>
                </p>

                <div class="flex justify-start gap-3">
                    <a href="/post/<?= $post['id'] ?>"
                        class="inline-flex items-center bg-[#60a5fa] text-white px-5 py-2.5 rounded font-semibold transition hover:bg-blue-500">
                        See post
                    </a>

                    <?php if (Authorization::canAccessPost($post['id']) || Authorization::isLoggedinAsadmin()): ?>
                        <a href="/edit/<?= $post['id'] ?>">
                            <img class="w-10 h-10 ml-5" src="/assets/Gear.png" alt="Edit">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>



<?php require_once __DIR__ . '/../partials/footer.php'; ?>